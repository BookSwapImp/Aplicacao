<?php

require_once(__DIR__."/dao/AnunciosDAO.php");
/*
$teste = new testeDAO();
$teste->listLivros();

$teste2 = new LivroDAO();
$teste->listLivros();
*/
$usuarios_id = 2;
$teste = new AnunciosDAO();
$anuncio = $teste->findAnuncioByAnuncioId($usuarios_id);
print_r($anuncio);
