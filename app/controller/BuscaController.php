<?php

require_once(__DIR__."/Controller.php");
require_once(__DIR__."/../dao/AnuncioDAO.php");
require_once(__DIR__."/../dao/UsuarioDAO.php");

class BuscaController extends Controller{
    private $anuncioDAO;
    private $usuarioDAO;
    public function __construct() {
        $this->anuncioDAO = new AnuncioDAO();
        $this->usuarioDAO = new UsuarioDAO();

    }
    protected function ImputBusca(){
        $busca = $_GET['busca'];    
        
    }
}