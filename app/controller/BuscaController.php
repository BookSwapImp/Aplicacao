<?php

require_once(__DIR__."/Controller.php");
require_once(__DIR__."/../dao/AnuncioDAO.php");
require_once(__DIR__."/../dao/BuscaDAO.php");
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
        $this->handleAction();

    }

    protected function InputBusca() {
    $busca = isset($_GET['busca']) ? trim($_GET['busca']) : null;
    $select = isset($_GET['select']) ? trim($_GET['select']) : null;
    
    if (empty($busca)) {
        $dados = [];
        $msgErro = 'Nenhum termo de busca fornecido.';
        return $this->loadView("busca/busca.php", $dados, $msgErro);
    }
    
    $usuario = $this->usuarioDAO->findById($this->getIdUsuarioLogado());
    if (empty($usuario)) {
        $usuario = new Usuario();
        $usuario->setId(0);
    }
    switch ($select) {
        case 'anun':
            $dados = $this->buscaDAO->buscaOnlyAnuncio($busca, $usuario);
            break;
        case 'users':
            $dados = $this->buscaDAO->buscaOnlyUser($busca, $usuario);
            break;
        default:
            $dados = $this->buscaDAO->busca($busca, $usuario);
            break;
    }

    if (empty($dados)) {
        $msgErro = 'Nenhum resultado encontrado.';
    }

    $this->loadView("busca/busca.php", $dados, $msgErro ?? '');
 }
}
new BuscaController();