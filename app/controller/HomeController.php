<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/AnuncioDAO.php");
require_once(__DIR__ . "/../util/config.php");

class HomeController extends Controller
{

    private UsuarioDAO $usuarioDAO;
    private AnuncioDAO $anuncioDAO;

    public function __construct()
    {
        //Verificar se o usuário está logado

        $this->usuarioDAO = new UsuarioDAO();
        $this->anuncioDAO = new AnuncioDAO();

        //Tratar a ação solicitada no parâmetro "action"
        $this->handleAction();
    }

    protected function home(string $msgErro = "", string $msgSucesso = "")
    {
        if ($this->getIdUsuarioLogado())
            $dados = $this->anuncioDAO->listANuncioWithoutAnuncioUser($this->getIdUsuarioLogado());
        else
            $dados = $this->anuncioDAO->listAnuncio();

        $this->loadView("home/home.php", $dados,  $msgErro, $msgSucesso);
    }
    
    protected function anuncio(string $msgErro = "", string $msgSucesso = "")
    {
        $anuncio = $this->anuncioDAO->findAnuncioByAnuncioId($_GET['id']);
        $dados = ['anuncio' => $anuncio];
        $this->loadView("home/anuncio.php", $dados,  $msgErro, $msgSucesso);
    }
}

//Criar o objeto do controller
new HomeController();
