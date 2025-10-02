<?php
require_once(__DIR__ . '/../controller/Controller.php');
require_once(__DIR__.'/../model/Trocas.php'); 
require_once(__DIR__.'/../model/enum/Status.php'); 
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
        $trocas = $this->TrocasDAO->listByIdUsuario($this->getIdUsuarioLogado());

        $ofertas = array();
        $solicitacao = array();
      //  São os $dados["oferta"]  $dados["solicitador"]
        foreach($trocas as $tr){
            $usuarioOfertaId = $tr->getUsuariosIdOferta()->getId();
            $usuarioSolicitador = $tr->getUsuariosIdSolicitador()->getId();
            $atividade = $tr->getStatus();
            //$ trocas esta enviando do anuncio solicitador pis e a oferta do anuncioado
            if($usuarioOfertaId == $this->getIdUsuarioLogado()) {
                $anuncio = $this->anunciosDAO->findAnuncioByAnuncioId($tr->getAnunciosIdSolicitador()->getId());
                if($atividade == Status::ATIVO)
                    $anuncio->setStatusTroca(true);
                else
                    $anuncio->setStatusTroca(false);
                array_push($ofertas, $anuncio); 
            }
            if($usuarioSolicitador ==$this->getIdUsuarioLogado()){
                $anuncio = $this->anunciosDAO->findAnuncioByAnuncioId($tr->getAnunciosIdOferta()->getId());   
                if($atividade == Status::ATIVO)
                    $anuncio->setStatusTroca(true);
                else
                    $anuncio->setStatusTroca(false);
                array_push($solicitacao, $anuncio);
            }
        } 
        $dados["ofertas"] = $ofertas;

        $dados["solicitacao"] = $solicitacao;

        $this->loadView('trocas/trocas.php',$dados );
    }
     protected function trocasIntoPage(){
        $dados = array();
        $dados['AnuncioOferta'] = $this->anunciosDAO->findAnuncioByAnuncioId($_GET['idAnuncio']);
        
        $this->verificaIdUser($dados['AnuncioOferta']);
        $dados['AnunciosSolicitador']= $this->anunciosDAO->findAnunciosByUsuariosId($this->getIdUsuarioLogado());
        $this->loadView('trocas/trocasInto.php',$dados); 
    }
    protected function trocaInto(){
        $idAnOferta=isset($_POST['idAnOferta'])?(int)trim($_POST['idAnOferta']): null;
        $idAnSolicitador = isset($_POST['idAnSolicitador'])?(int)trim($_POST['idAnSolicitador']): null;
        if (!empty($idAnOferta) && !empty($idAnSolicitador)  ) {
            $anuncioOferta = $this->anunciosDAO->findAnuncioByAnuncioId($idAnOferta);
            $this->verificaIdUser(  $anuncioOferta);
            $anuncioAux = new Anuncios();
            $anuncioSolicitador = $this->anunciosDAO->findAnuncioByAnuncioId($idAnSolicitador);
            $anuncioAux->setId($anuncioSolicitador->getId());
            $this->Trocas->setAnunciosIdOferta( $anuncioAux);
            $anuncioAux->setId($anuncioOferta->getId());
            $this->Trocas->setAnunciosIdSolicitador($anuncioAux);
            $this->Trocas->setUsuariosIdOferta($anuncioOferta->getUsuarioId());
            $this->Trocas->setUsuariosIdSolicitador($anuncioSolicitador->getUsuarioId());
            $this->Trocas->setSecCode($this->gerarSecCode());
            $this->Trocas->setStatus('inativo');
            $this->Trocas->setDataTroca(new DateTime());
            $this->TrocasDAO->insertTroca($this->Trocas); // Reset ID for potential future use
            
        }
        else{
            echo 'trocasInto Falhou';
            if(empty($idAnOferta)){
                echo'idAnOferta is empty';
            }
            if(empty($idAnSolicitador)){
                echo'idAnOferta is empty';  
            }
        }
    
         //  print($anuncioSolicitador);    
       return $this->trocasPages();
    }
    protected function trocasActive(){
        $idTroca = isset($_POST['idTroca'])?(int)trim($_POST['idTroca']) : null;
        if(!empty($idTroca)||$idTroca!=null){
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
   
    private function verificaAtivo(){

    }
    private function verificaIdUser(Anuncios $ans){
        if($ans->getUsuarioIdInt() === $this->getIdUsuarioLogado())
            header("location:" . HOME_PAGE);
    }
}
$new = new TrocasController();
