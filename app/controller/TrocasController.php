<?php
require_once(__DIR__.'Controller');
require_once(__DIR__.'/../model/Trocas.php');
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
    
}