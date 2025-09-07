<?php
require_once(__DIR__ . "/../model/Trocas.php");
require_once(__DIR__ . "/Conexao.php");

class TrocasDAO{
    private $conexao;

    public function __construct() {
        $this->conexao = Connection::getConn();
    }
    private function mapTrocas(){

    }
}