<?php

require_once(__DIR__."/dao/LivroDAO.php");
/*
$teste = new testeDAO();
$teste->listLivros();

$teste2 = new LivroDAO();
$teste->listLivros();
*/
$usuarios_id = 1;
$teste = new LivroDAO();
$teste->findLivroByUsuariosId($usuarios_id);

