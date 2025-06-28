<?php

require_once("teste.php");
require_once(__DIR__."/dao/LivroDAO.php");

$teste = new testeDAO();
$teste->listLivros();

$teste2 = new LivroDAO();
$teste->listLivros();