<?php
require_once(__DIR__ . '/../controller/Controller.php');
require_once(__DIR__.'/../model/Trocas.php'); 
require_once(__DIR__.'/../dao/AnunciosDAO.php');
require_once(__DIR__.'/../dao/UsuarioDAO.php');  
require_once(__DIR__.'/../dao/TrocasDAO.php'); 
class TrocasController extends Controller{
    private Usuario $usuario;
    private UsuarioDAO $usuarioDao;
    private Anuncios $anuncios;
    private AnunciosDAO $anunciosDao;
    private Trocas $Trocas;
    private $TrocasDAO;
    public function __construct(){
        $this->Trocas = new Trocas();
        $this->TrocasDAO = new TrocasDAO();
        $this->anunciosDao= new AnunciosDAO();
        $this->handleAction(); 
    }
    

    protected function trocasPages(){
        $dados = array();
        $dados['Trocas'] = $this->TrocasDAO->listByIdUsuario($this->getIdUsuarioLogado());
        $this->loadView('trocas/trocas.php',$dados);
    }
    public function trocasInto(){
        $dados = array();
        $dados['AnuncioOferta'] = $this->anunciosDao->findAnuncioByAnuncioId($_GET['idAnuncio']);;
        $dados['AnunciosSolicitador']= $this->anunciosDao->findAnunciosByUsuariosId($this->getIdUsuarioLogado());
        $this->loadView('trocas/trocasInto.php',$dados); 
    }
    private function TesteGerarSecCode():string{
        $caracteres = 'ABCDEFGHIJKlMNOPQRSTUWXYZabcdefghijkmopqrstuwxyz1234567890';
        $codeSec = '';
        for ($i = 0; $i < 6; $i++) 
            $codeSec .= $caracteres[mt_rand(0, strlen($caracteres) - 1)];
        return $codeSec;
    }
    
}
$new = new TrocasController();
$new->trocasInto();
