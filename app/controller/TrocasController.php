<?php
require_once(__DIR__ . '/../controller/Controller.php');
require_once(__DIR__.'/../model/Trocas.php'); 
require_once(__DIR__.'/../dao/AnunciosDAO.php');
require_once(__DIR__.'/../dao/UsuarioDAO.php');  
require_once(__DIR__.'/../dao/TrocasDAO.php'); 
class TrocasController extends Controller{
    private Usuario $usuario;
    private UsuarioDAO $usuarioDAO;
    private Anuncios $anuncios;
    private AnunciosDAO $anunciosDAO;
    private Trocas $Trocas;
    private $TrocasDAO;
    public function __construct(){
        if(! $this->usuarioEstaLogado())
        return;
        $this->Trocas = new Trocas();
        $this->TrocasDAO = new TrocasDAO();
        $this->anunciosDAO= new AnunciosDAO();
        $this->handleAction(); 
    }
  

    protected function trocasPages(){
        $dados = array();
        $dados['Trocas'] = $this->TrocasDAO->listByIdUsuario($this->getIdUsuarioLogado());
        $this->loadView('trocas/trocas.php',$dados );
    }
     protected function trocasIntoPage(){
        $dados = array();
        $dados['AnuncioOferta'] = $this->anunciosDAO->findAnuncioByAnuncioId($_GET['idAnuncio']);;
        $dados['AnunciosSolicitador']= $this->anunciosDAO->findAnunciosByUsuariosId($this->getIdUsuarioLogado());
        $this->loadView('trocas/trocasInto.php',$dados); 
    }
    protected function trocaInto(){
        $idAnOferta=isset($_POST['idAnOferta'])?(int)trim($_POST['idAnOferta']): null;
        $idAnSolicitador = isset($_POST['idAnSolicitador'])?(int)trim($_POST['idAnSolicitador']): null;
        if (!empty($idAnOferta)||$idAnOferta!=null ||!empty($idAnSolicitador) ||$idAnSolicitador!=null ) {
            $anuncioOferta = $this->anunciosDAO->findAnuncioByAnuncioId($idAnOferta);
            $anuncioSolicitador = $this->anunciosDAO->findAnuncioByAnuncioId($idAnSolicitador);
            $this->Trocas->setAnunciosIdOferta($anuncioOferta->getId());
            $this->Trocas->setAnunciosIdSolicitador($anuncioSolicitador->getId());
            $this->Trocas->setUsuariosIdOferta($anuncioOferta->getUsuarioId());
            $this->Trocas->setAnunciosIdOferta($anuncioSolicitador->getUsuarioId()); 
            $this->Trocas->setSecCode($this->gerarSecCode());
            $this->Trocas->setStatus('inativo');
            $this->TrocasDAO->insertTroca($this->Trocas);
            
        }
            return $this->trocasPages();
    }
    protected function trocasActive(){
        $idTroca = isset($_POST['idTroca'])?(int)trim($_POST['idTroca']) : null;
        if(!empty($idTrocs)||$idTroca!=null){
            $this->Trocas->setId($idTroca);
            $this->Trocas->setStatus('ativa');
            if($this->Trocas->getUsuariosIdOferta() === $this->getIdUsuarioLogado()) 
                $this->TrocasDAO->updateTroca($this->Trocas);
        }
        return $this->trocasPages();
    }
    protected function trocasConclution($codeSec){
       $idTroca = isset($_POST['idTroca'])?(int)trim($_POST['idTroca']) : null;

    }
   
    private function gerarSecCode():string{
        $caracteres = 'ABCDEFGHIJKlMNOPQRSTUWXYZabcdefghijkmopqrstuwxyz1234567890';
        $codeSec = '';
        for ($i = 0; $i < 6; $i++) 
            $codeSec .= $caracteres[mt_rand(0, strlen($caracteres) - 1)];
        return $codeSec;
    }
    
}
$new = new TrocasController();
