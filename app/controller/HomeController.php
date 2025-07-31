<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/AnunciosDAO.php");
require_once(__DIR__ . "/../util/config.php");

class HomeController extends Controller {

    private UsuarioDAO $usuarioDAO;
    private AnunciosDAO $anunciosDAO;

    public function __construct() {
        //Verificar se o usuário está logado
        if(! $this->usuarioEstaLogado())
            return;

        $this->usuarioDAO = new UsuarioDAO();
        $this->anunciosDAO = new AnunciosDAO();

        //Tratar a ação solicitada no parâmetro "action"
        $this->handleAction();
    }
       protected function home(string $msgErro = "", string $msgSucesso = "") {
        $dados = $this->anunciosDAO->listAnuncio();

        $this->loadView("home/home.php", $dados,  $msgErro, $msgSucesso);
    }
       protected function anuncio(string $msgErro = "", string $msgSucesso = ""){
        $anuncio = $this->anunciosDAO->findAnuncioByAnuncioId($_GET['id']);
        $dados = ['anuncio' => $anuncio];
        $this->loadView("home/anuncio.php", $dados,  $msgErro, $msgSucesso);
    }
    
}

//Criar o objeto do controller
new HomeController();