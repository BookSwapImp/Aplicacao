
-- -----------------------------------------------------
-- Table `bookswap`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS .`usuarios` (
  `id` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefone` INT NULL DEFAULT NULL,
  `cpf` INT NOT NULL,
  `rg` INT,
  `tipo` ENUM('admin', 'comum') NOT NULL,
  `status` ENUM('ativo', 'inativo') NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `anuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS .`anuncios` (
  `id` INT NOT NULL,
  `usuarios_id` INT NOT NULL,
  `nome_livro` VARCHAR(55) NOT NULL,
  `valor_anuncio` FLOAT NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `data_publicacao` DATETIME NOT NULL,
  `avaliacao` VARCHAR(255) NULL DEFAULT NULL,
  `nota` VARCHAR(45) NULL DEFAULT NULL,
  `status` ENUM('ativo', 'inativo', 'finalizado') NOT NULL,
  `estado_con` ENUM('mal', 'medio', 'bom') NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `usuarios_id` (`usuarios_id` ASC) VISIBLE,
  CONSTRAINT `anuncios_ibfk_1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES.`usuarios` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `compra` (
  `id` INT NOT NULL,
  `usuarios_id` INT NOT NULL,
  `anuncios_id` INT NOT NULL,
  `valor_pago` FLOAT NOT NULL,
  `data_pagamento` DATETIME NOT NULL,
  `codigo-transacao` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `compra_ibfk_1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `usuarios` (`id`),
  CONSTRAINT `compra_ibfk_2`
    FOREIGN KEY (`anuncios_id`)
    REFERENCES `anuncios` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `denuncia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `denuncia` (
  `id` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `anuncios_id` INT NOT NULL,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`id`),
 CONSTRAINT `denuncia_ibfk_1`
    FOREIGN KEY (`anuncio_id`)
    REFERENCES `anuncios` (`id`),
  CONSTRAINT `denuncia_ibfk_2`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES.`usuarios` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` INT NOT NULL,
  `usuarios_id` INT NOT NULL,
  `rua` VARCHAR(60) NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `cep` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `enderecos_ibfk_1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES.`usuarios` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `troca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `troca` (
  `id` INT NOT NULL,
  `anuncios_id_1` INT NOT NULL,
  `anuncios_id_2` INT NOT NULL,
  `data_troca` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `troca_ibfk_1`
   FOREIGN KEY (`anuncio_id_1`)
    REFERENCES `anuncios` (`id`),
  CONSTRAINT `troca_ibfk_2`
   FOREIGN KEY (`anuncio_id_2`)
    REFERENCES `anuncios` (`id`),)
    
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
