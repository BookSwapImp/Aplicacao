
-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha`VARCHAR(255) NOT NULL,
  `foto_de_perfil` VARCHAR(255) DEFAULT NULL,
  `telefone` VARCHAR(15) DEFAULT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `tipo` ENUM('USUARIO', 'ADMINISTRADOR') NOT NULL,
  `status` ENUM('ativo', 'inativo') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `anuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarios_id` INT NOT NULL,
  `nome_livro` VARCHAR(55) NOT NULL,
  `imagem_livro` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `data_publicacao` DATETIME NOT NULL,
 `status` ENUM('ativo', 'inativo', 'finalizado') NOT NULL,
  `estado_con` ENUM('mal', 'medio', 'bom') NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `anuncios_ibfk_1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `usuarios` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `compra` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarios_id` INT NOT NULL,
  `anuncios_id` INT NOT NULL,
  `valor_pago` FLOAT NOT NULL,
  `data_pagamento` DATETIME NOT NULL,
  `codigo_transacao` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `compra_ibfk_1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `usuarios` (`id`),
  CONSTRAINT `compra_ibfk_2`
    FOREIGN KEY (`anuncios_id`)
    REFERENCES `anuncios` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `denuncia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `denuncia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,
  `anuncios_id` INT NOT NULL,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `denuncia_ibfk_1`
    FOREIGN KEY (`anuncios_id`)
    REFERENCES `anuncios` (`id`),
  CONSTRAINT `denuncia_ibfk_2`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `usuarios` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `usuarios_id` INT NOT NULL,
  `rua` VARCHAR(60) NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `cep` VARCHAR(9) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `numb` INT(10) NOT NULL,
  `main` ENUM('main','normal'),

  PRIMARY KEY (`id`),
  CONSTRAINT `enderecos_ibfk_1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `usuarios` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `troca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `troca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `anuncios_id_1` INT NOT NULL,
  `anuncios_id_2` INT NOT NULL,
  `data_troca` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `troca_ibfk_1`
    FOREIGN KEY (`anuncios_id_1`)
    REFERENCES `anuncios` (`id`),
  CONSTRAINT `troca_ibfk_2`
    FOREIGN KEY (`anuncios_id_2`)
    REFERENCES `anuncios` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- -----------------------------------------------------
-- Table `avaliacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarios_id` INT NOT NULL,
  `descricao` VARCHAR(60) NOT NULL,
  `nota` INT(2) NOT NULL,
  `usuarios_id_denunciado` INT NOT NULL,
  `anuncios_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `enderecos_ibfk_10`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_avaliacao_usuarios1`
    FOREIGN KEY (`usuarios_id_denunciado`)
    REFERENCES `usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avaliacao_anuncios1`
    FOREIGN KEY (`anuncios_id`)
    REFERENCES `anuncios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `Relatorio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Relatorio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,
  `Tipo_de_denuncia` ENUM("anuncio", "usuario") NOT NULL,
  `denuncia_id` INT NOT NULL,
  `status_denunciado` ENUM("destivado", "liberado") NOT NULL,
  `relatorio_status` ENUM('ativo', 'inativo') NOT NULL,
  `data` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
   CONSTRAINT `fk_Relatorio_denuncia1`
    FOREIGN KEY (`denuncia_id`)
    REFERENCES `denuncia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;




-- Desativar checagem de chaves estrangeiras temporariamente
SET FOREIGN_KEY_CHECKS = 0;
