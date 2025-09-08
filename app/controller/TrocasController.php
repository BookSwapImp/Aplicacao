<?php
require_once(__DIR__ . '/../controller/Controller.php');
require_once(__DIR__.'/../dao/TrocasDAO.php'); 
class TrocasController extends Controller{
    private Usuario $usuario;
    private UsuarioDAO $usuarioDao;
    private Anuncios $anuncios;
    private AnunciosDAO $anunciosDao;
    private $Trocas;
    private $TrocasDAO;
    public function __construct(){
        $this->Trocas = new Trocas();
        $this->TrocasDAO = new TrocasDAO();
    
        $this->handleAction(); 
    }

    protected function trocasPages(){
        $dados = array();
        $this->loadView('trocas/trocas.php',$dados);
    }
    
}
new TrocasController();