<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../service/CadastroService.php");

class CadastroController extends Controller{
    private UsuarioDAO $usuarioDao;
    private CadastroService $cadastroService;

    function __construct(){
        $this->usuarioDao = new UsuarioDAO();
        $this->cadastroService = new CadastroService(); 
        $this->handleAction(); 
    }
     protected function cadastro(){
        $this->loadView("cadastro/cadastro.php", []); 
     }
}