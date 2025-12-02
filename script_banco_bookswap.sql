-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: bookswap
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anuncios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuarios_id` int NOT NULL,
  `nome_livro` varchar(55) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `data_publicacao` datetime NOT NULL,
  `status` enum('ativo','inativo','finalizado') NOT NULL,
  `estado_con` enum('mal','medio','bom') NOT NULL,
  `imagem_livro` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anuncios_ibfk_1` (`usuarios_id`),
  CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios`
--

LOCK TABLES `anuncios` WRITE;
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` VALUES (18,1,'the making of prince of persia','Relato da criação de prince of persia','2025-09-10 15:54:40','ativo','bom','arquivo_68c183207a565_1757512480.png');
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avaliacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuarios_id` int NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `nota` int NOT NULL,
  `usuarios_id_denunciado` int NOT NULL,
  `anuncios_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enderecos_ibfk_10` (`usuarios_id`),
  KEY `fk_avaliacao_usuarios1` (`usuarios_id_denunciado`),
  KEY `fk_avaliacao_anuncios1` (`anuncios_id`),
  CONSTRAINT `enderecos_ibfk_10` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_avaliacao_anuncios1` FOREIGN KEY (`anuncios_id`) REFERENCES `anuncios` (`id`),
  CONSTRAINT `fk_avaliacao_usuarios1` FOREIGN KEY (`usuarios_id_denunciado`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao`
--

LOCK TABLES `avaliacao` WRITE;
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuarios_id` int NOT NULL,
  `anuncios_id` int NOT NULL,
  `valor_pago` float NOT NULL,
  `data_pagamento` datetime NOT NULL,
  `codigo_transacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compra_ibfk_1` (`usuarios_id`),
  KEY `compra_ibfk_2` (`anuncios_id`),
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`anuncios_id`) REFERENCES `anuncios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denuncia`
--

DROP TABLE IF EXISTS `denuncia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `denuncia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `anuncios_id` int DEFAULT NULL,
  `usuarios_reu_id` int NOT NULL,
  `usuario_acusador_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `denuncia_ibfk_1` (`anuncios_id`),
  KEY `fk_denuncia_usuarios_reu` (`usuarios_reu_id`),
  KEY `fk_denuncia_usuarios_acusador` (`usuario_acusador_id`),
  CONSTRAINT `denuncia_ibfk_1` FOREIGN KEY (`anuncios_id`) REFERENCES `anuncios` (`id`),
  CONSTRAINT `denuncia_ibfk_2` FOREIGN KEY (`usuarios_reu_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_denuncia_usuarios_acusador` FOREIGN KEY (`usuario_acusador_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_denuncia_usuarios_reu` FOREIGN KEY (`usuarios_reu_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_usuarios` FOREIGN KEY (`usuario_acusador_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denuncia`
--

LOCK TABLES `denuncia` WRITE;
/*!40000 ALTER TABLE `denuncia` DISABLE KEYS */;
/*!40000 ALTER TABLE `denuncia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enderecos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuarios_id` int NOT NULL,
  `rua` varchar(60) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `numero` int NOT NULL,
  `main` enum('main','normal') DEFAULT 'normal',
  `estado` char(2) NOT NULL,
  `status` enum('inativo','ativo') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enderecos_ibfk_1` (`usuarios_id`),
  CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (8,1,'av.Paraná','Foz do Iguaçu','85868160','Minha casa',4555,'normal','PR',NULL),(11,23,'av.Paraná','Foz do Iguaçu','85868160','Nova Casa',45555,'main','PR',NULL);
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatorio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `Tipo_de_denuncia` enum('anuncio','usuario') NOT NULL,
  `denuncia_id` int NOT NULL,
  `status_denunciado` enum('destivado','liberado') NOT NULL,
  `relatorio_status` enum('ativo','inativo') NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Relatorio_denuncia1` (`denuncia_id`),
  CONSTRAINT `fk_Relatorio_denuncia1` FOREIGN KEY (`denuncia_id`) REFERENCES `denuncia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorio`
--

LOCK TABLES `relatorio` WRITE;
/*!40000 ALTER TABLE `relatorio` DISABLE KEYS */;
/*!40000 ALTER TABLE `relatorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `troca`
--

DROP TABLE IF EXISTS `troca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `troca` (
  `id` int NOT NULL AUTO_INCREMENT,
  `anuncios_id_oferta` int NOT NULL,
  `anuncios_id_solicitador` int NOT NULL,
  `data_troca` datetime NOT NULL,
  `usuarios_id_oferta` int NOT NULL,
  `usuarios_id_solicitador` int NOT NULL,
  `status` enum('ativo','inativo') NOT NULL,
  `sec_code` char(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `troca_ibfk_1` (`anuncios_id_oferta`),
  KEY `troca_ibfk_2` (`anuncios_id_solicitador`),
  KEY `troca_ibfk_3` (`usuarios_id_oferta`),
  KEY `troca_ibfk_4` (`usuarios_id_solicitador`),
  CONSTRAINT `troca_ibfk_1` FOREIGN KEY (`anuncios_id_oferta`) REFERENCES `anuncios` (`id`),
  CONSTRAINT `troca_ibfk_2` FOREIGN KEY (`anuncios_id_solicitador`) REFERENCES `anuncios` (`id`),
  CONSTRAINT `troca_ibfk_3` FOREIGN KEY (`usuarios_id_oferta`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `troca_ibfk_4` FOREIGN KEY (`usuarios_id_solicitador`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `troca`
--

LOCK TABLES `troca` WRITE;
/*!40000 ALTER TABLE `troca` DISABLE KEYS */;
/*!40000 ALTER TABLE `troca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `tipo` enum('USUARIO','ADMINISTRADOR') NOT NULL,
  `status` enum('ativo','inativo') NOT NULL,
  `foto_de_perfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Lionel','root.silva@email.com','$2y$10$9H8nNzW7tM7cGhy6r59gYuKuflEGKzKGOMPv86yUhJbySUNnnY42y','67981883427','94434593021','USUARIO','ativo','arquivo_68a5cec7e90b9_1755696839.png'),(2,'João Root','joao.silva@email.com','$2y$10$k5MaEAVH3jchFAjMBLr2qeH4ZPgmN8Ob4uIYbvh5PQY5PuEOnJ3Mq','','15985363031','ADMINISTRADOR','ativo',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-24 15:17:16
