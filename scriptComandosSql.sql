SELECT * FROM avaliacao;
DROP TABLE bookswap;
CREATE DATABASE bookswap;
USE bookswap;

DROP TABLE IF EXISTS `troca`;
DROP TABLE IF EXISTS `enderecos`;
DROP TABLE IF EXISTS `denuncia`;
DROP TABLE IF EXISTS `compra`;
DROP TABLE IF EXISTS `anuncios`;
DROP TABLE IF EXISTS `usuarios`;

-- Reativar checagem de chaves estrangeiras

INSERT INTO `usuarios` (
  `nome`, 
  `email`,`senha`,` foto_de_perfil`,  
  `telefone`, 
  `cpf`, 
  `tipo`, 
  `status`
) VALUES (
  'root', 
  'root.silva@email.com',
  '$2y$10$9H8nNzW7tM7cGhy6r59gYuKuflEGKzKGOMPv86yUhJbySUNnnY42y', /*root*/
  'NULL', 
  12345678901, 
  123456789, 
  'USUARIO', 
  'ativo'
);
INSERT INTO `anuncios` (
    `usuarios_id`,
    `nome_livro`,
    `imagem_livro`,
    `descricao`,
    `data_publicacao`,
    `status`,
    `estado_con`
) VALUES (
    1,
    'Dom Casmurro',
    'https://images.tcdn.com.br/img/img_prod/1043052/dom_casmurro_12019_1_c24baa33081e8405255ef17ea4c377c1.jpg',
    'Livro em bom estado',
    NOW(),
    'ativo',
    'bom'
),
(
    2,
    'Ilíada',
    'https://m.media-amazon.com/images/I/81iCk4r43AL._UF1000,1000_QL80_.jpg',
    'Livro novo',
    NOW(),
    'ativo',
    'bom'
);
INSERT INTO `anuncios` (
    `usuarios_id`,
    `nome_livro`,
    `imagem_livro`,
    `descricao`,
    `data_publicacao`,
    `status`,
    `estado_con`
) VALUES (
     2,
    'Ilíada',
    'https://m.media-amazon.com/images/I/81iCk4r43AL._UF1000,1000_QL80_.jpg',
    'Livro novo',
    NOW(),
    'ativo',
    'bom'
);




ALTER TABLE usuarios ADD COLUMN foto_perfil VARCHAR(255);
