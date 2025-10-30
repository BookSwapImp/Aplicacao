<?php

require_once(__DIR__."/Controller.php");
require_once(__DIR__."/../dao/AnuncioDAO.php");
require_once(__DIR__."/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../util/config.php");


class BuscaController extends Controller{
    private $anuncioDAO;
    private $usuarioDAO;
    private $buscaDAO;
    public function __construct()
    {
        $this->anuncioDAO = new AnuncioDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->buscaDAO = new BuscaDAO();

    }
    protected function Teste(){
        $dados=array(); $msgErro='';
        return $this->loadView("busca/busca.php",$dados,$msgErro);
    }
    protected function InputBusca() {
    $busca = isset($_GET['busca']) ? trim($_GET['busca']) : null;
    $select = isset($_GET['select']) ? trim($_GET['select']) : null;

    if (empty($busca)) {
        $dados = [];
        $msgErro = 'Nenhum termo de busca fornecido.';
        return $this->loadView("busca/busca.php", $dados, $msgErro);
    }

    switch ($select) {
        case 'anun':
            $dados = $this->buscaDAO->buscaOnlyAnuncio($busca);
            break;
        case 'users':
            $dados = $this->buscaDAO->buscaOnlyUser($busca);
            break;
        default:
            $dados = $this->buscaDAO->busca($busca);
            break;
    }

    if (empty($dados)) {
        $msgErro = 'Nenhum resultado encontrado.';
    }

    $this->loadView("busca/busca.php", $dados, $msgErro ?? '');
}
}