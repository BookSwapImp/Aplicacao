

LOCK TABLES `anuncios` WRITE;
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` VALUES (2,2,'Ilíada','Livro novo','2025-07-05 14:41:29','ativo','bom','iliada.png'),(12,1,'O Pequeno Livro','O pequeno livro, Marcelo Cipis','2025-08-18 01:04:45','ativo','bom','arquivo_68a5cce03b241_1755696352.jpeg'),(13,22,'Song of Saya','comic baseada em saya no uta','2025-08-20 22:38:26','ativo','medio','arquivo_68a632426c47f_1755722306.jpg');
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (8,1,'av.Paraná','Foz do Iguaçu','85868160','Nova Casa',45555,'main','AC');
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Lionel','root.silva@email.com','$2y$10$9H8nNzW7tM7cGhy6r59gYuKuflEGKzKGOMPv86yUhJbySUNnnY42y','67981883427','94434593021','USUARIO','ativo','arquivo_68a5cec7e90b9_1755696839.png'),(2,'João Root da Silva','joao.silva@email.com','$2y$10$k5MaEAVH3jchFAjMBLr2qeH4ZPgmN8Ob4uIYbvh5PQY5PuEOnJ3Mq','','15985363031','USUARIO','ativo',NULL),(3,'Vitin','Vitin@email.com','$2y$10$F9f926/f2nN48SjG9TaXseuh3NkFoD0O.5axioMDsRoO0OmmvwrAG','459999999','99949494944','USUARIO','ativo',NULL),(4,'kauana silva dos reis','kauanaareis@hotmail.com','$2y$10$Po7VYc6RmGw4Vggp1qkTSetx5197Dpug16LZ8x4i4xWb0cUiM4COS','4576893369','03647599704','USUARIO','ativo',NULL),(10,'janin','janin@email.com','$2y$10$uyidV3ZdgPjLEojDmDQ3TOtGq6xqH2uiqH7i3pEeDE/qsIH.zGT4m','11999998888','12345678909','USUARIO','ativo',NULL),(11,'Toma Jack','toma.jack@email.com','$2y$10$5tLppVRIODRIuNy.yaIOceiQKAi3AHf82/i2YY7fS3VWQXt5HrpY2','459999699969','12345678909','USUARIO','ativo',NULL),(12,'janin','janin@email.com','$2y$10$1da0rSrFoUrXmWvuFl6l9OZ3wQNpXd9V.mvaGmVMYp2BR4Ttu9zdO','4596996999','12345678909','USUARIO','ativo',NULL),(13,'Toma Jack','bayerVaiMamarDomingo@gmial.com','$2y$10$oj5aNoajwDmPf7X1WWJ9TuK/S.2Fj8TY2WosJ4tWTVvIUFqhr1/Gi','null()','12345678909','USUARIO','ativo',NULL),(14,'Toma Jack','hattricDoBH@gmial.com','$2y$10$PzJ6qkuWgtOiDcFDMYeT5uKbK9ZblMlJgKQk9ks8gPXYmdx/300nS','45666666666','12345678909','USUARIO','ativo',NULL),(15,'natan','natan@email.com','$2y$10$0eEDWtP5WDKQqXVJ2IKxkOA2M3Wa3Z7pyRSL7MZnt7BqAzBP62KOu','null()','12345678909','USUARIO','ativo',NULL),(16,'Toma Jack','mnzim@email.com','$2y$10$XPYcAcDCoxlqOlQv2X07qOBo04YeY9mFrmCKlAzAZVfXonbJ7wfYC','459999','12345678909','USUARIO','ativo',NULL),(17,'json','json.silva@email.com','$2y$10$9H8nNzW7tM7cGhy6r59gYuKuflEGKzKGOMPv86yUhJbySUNnnY42y','12345678901','123456789','ADMINISTRADOR','ativo',NULL),(20,'Lionel','joao@email.com','$2y$10$ciMCgdsgQTUI2TbYOBL1au6tMbfoE1WP7G5kFdUXAeo5Qc8IkbmGW',NULL,'12769996908','USUARIO','ativo',NULL),(21,'Adrian José','adrianJose@gmail.com','$2y$10$kCs5RzdkmdLA4VkjnrOtde1c3YFFTXqRuTmLZ07kE6SOOlD5MgUqy',NULL,'02005955981','USUARIO','ativo','arquivo_689dee52c49a9_1755180626.png'),(22,'Aberto Phonix','alberto@email.com','$2y$10$1c/WbCVZr1G23eep97942u73inS.VIys6BrsACtL33dayt0sH1zei','','066.304.500-27','USUARIO','ativo','arquivo_68a5d0d09a8f1_1755697360.jpg');
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

-- Dump completed on 2025-09-07 22:42:43
