
-- -----------------------------------------------------
-- Table `bookswap`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS .`usuarios` (
  `ID` INT NOT NULL,
  `NOME` VARCHAR(45) NOT NULL,
  `EMAIL` VARCHAR(45) NOT NULL,
  `TELEFONE` INT NULL DEFAULT NULL,
  `CPF` INT NOT NULL,
  `RG` INT NULL DEFAULT NULL,
  `TIPO` ENUM('ADMIN', 'COMUM') NOT NULL,
  `STATUS` ENUM('ATIVO', 'INATIVO') NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `anuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS .`anuncios` (
  `ID` INT NOT NULL,
  `USUARIOS_ID` INT NOT NULL,
  `NOME_LIVRO` VARCHAR(55) NOT NULL,
  `VALOR_ANUNCIO` FLOAT NOT NULL,
  `DESCRICAO` VARCHAR(45) NOT NULL,
  `DATA_PUBLICACAO` DATETIME NOT NULL,
  `AVALIACAO` VARCHAR(255) NULL DEFAULT NULL,
  `NOTA` VARCHAR(45) NULL DEFAULT NULL,
  `STATUS` ENUM('ATIVO', 'INATIVO', 'FINALIZADO') NOT NULL,
  `ESTADO_CON` ENUM('MAL', 'MEDIO', 'BOM') NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `USUARIOS_ID` (`USUARIOS_ID` ASC) VISIBLE,
  CONSTRAINT `anuncios_ibfk_1`
    FOREIGN KEY (`USUARIOS_ID`)
    REFERENCES.`usuarios` (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `compra` (
  `ID` INT NOT NULL,
  `USUARIOS_ID` INT NOT NULL,
  `ANUNCIOS_ID` INT NOT NULL,
  `VALOR_PAGO` FLOAT NOT NULL,
  `DATA_PAGAMENTO` DATETIME NOT NULL,
  `CODIGOTRANSACAO` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  INDEX `USUARIOS_ID` (`USUARIOS_ID` ASC) VISIBLE,
  INDEX `ANUNCIOS_ID` (`ANUNCIOS_ID` ASC) VISIBLE,
  CONSTRAINT `compra_ibfk_1`
    FOREIGN KEY (`USUARIOS_ID`)
    REFERENCES `usuarios` (`ID`),
  CONSTRAINT `compra_ibfk_2`
    FOREIGN KEY (`ANUNCIOS_ID`)
    REFERENCES `anuncios` (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `denuncia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `denuncia` (
  `ID` INT NOT NULL,
  `DESCRICAO` VARCHAR(255) NOT NULL,
  `ANUNCIOS_ID` INT NOT NULL,
  `USUARIOS_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `ANUNCIOS_ID` (`ANUNCIOS_ID` ASC) VISIBLE,
  INDEX `USUARIOS_ID` (`USUARIOS_ID` ASC) VISIBLE,
  CONSTRAINT `denuncia_ibfk_1`
    FOREIGN KEY (`ANUNCIOS_ID`)
    REFERENCES `anuncios` (`ID`),
  CONSTRAINT `denuncia_ibfk_2`
    FOREIGN KEY (`USUARIOS_ID`)
    REFERENCES.`usuarios` (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `enderecos` (
  `ID` INT NOT NULL,
  `USUARIOS_ID` INT NOT NULL,
  `RUA` VARCHAR(60) NOT NULL,
  `CIDADE` VARCHAR(45) NOT NULL,
  `CEP` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `USUARIOS_ID` (`USUARIOS_ID` ASC) VISIBLE,
  CONSTRAINT `enderecos_ibfk_1`
    FOREIGN KEY (`USUARIOS_ID`)
    REFERENCES `usuarios` (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `troca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `troca` (
  `ID` INT NOT NULL,
  `ANUNCIOS_ID_1` INT NOT NULL,
  `ANUNCIOS_ID_2` INT NOT NULL,
  `DATA_TROCA` DATETIME NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `ANUNCIOS_ID_1` (`ANUNCIOS_ID_1` ASC) VISIBLE,
  INDEX `ANUNCIOS_ID_2` (`ANUNCIOS_ID_2` ASC) VISIBLE,
  CONSTRAINT `troca_ibfk_1`
    FOREIGN KEY (`ANUNCIOS_ID_1`)
    REFERENCES `anuncios` (`ID`),
  CONSTRAINT `troca_ibfk_2`
    FOREIGN KEY (`ANUNCIOS_ID_2`)
    REFERENCES `anuncios` (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
