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
                $oferta = array('anuncio' => $anuncio, 'trocaId' => $tr->getId());
                array_push($ofertas, $oferta);
            }
            if($usuarioSolicitador ==$this->getIdUsuarioLogado()){
                $anuncio = $this->anunciosDAO->findAnuncioByAnuncioId($tr->getAnunciosIdOferta()->getId());
                if($atividade == Status::ATIVO){
                    $anuncio->setStatusTroca(true);
                    $solicit = array('anuncio' => $anuncio, 'trocaId' => $tr->getId(), 'secCode' => $tr->getSecCode());
                }else{
                    $anuncio->setStatusTroca(false);
                    $solicit = array('anuncio' => $anuncio, 'trocaId' => $tr->getId());
                }
                array_push($solicitacao, $solicit);
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
            $anuncioAuxSolict = new Anuncios();$anuncioAuxOferta = new Anuncios();
            $anuncioSolicitador = $this->anunciosDAO->findAnuncioByAnuncioId($idAnSolicitador);
            $anuncioAuxSolict->setId($anuncioSolicitador->getId());
            $this->Trocas->setAnunciosIdOferta( $anuncioAuxOferta);
            $anuncioAuxOferta->setId($anuncioOferta->getId());
            $this->Trocas->setAnunciosIdSolicitador($anuncioAuxSolict);
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
        $idTroca = isset($_POST['idTroca']) ? (int)trim($_POST['idTroca']) : null;
        if (!empty($idTroca)) {
            $troca = $this->TrocasDAO->findByIdTroca($idTroca);
            if (!empty($troca)) {
                $trocaObj = $troca[0];
                if ($trocaObj->getUsuariosIdOferta()->getId() == $this->getIdUsuarioLogado()) {
                    $trocaObj->setStatus(Status::ATIVO);
                    $this->TrocasDAO->updateTroca($trocaObj);
                }
            }
        }
        return $this->trocasPages();
    }
    private function deleteTrade(int $idTroca){
        if (empty($idTroca))
            $idTroca= isset($_POST['idTroca'])? (int)trim($_POST['idTroca']): null; 
       $troca = $this->TrocasDAO->findByIdTroca($idTroca);
       $trocaObj = $troca[0];
       $idSolict =  $trocaObj->getUsuariosIdOferta();
       $idOfert = $trocaObj->getUsuariosIdSolicitador()->getId();
       if ($idSolict === $this->getIdUsuarioLogado() || $idOfert ===$this->getIdUsuarioLogado()) {
           $this->TrocasDAO->deleteTrocas($trocaObj->getId()); 
       }
       return $this->trocasPages();
    }
    protected function inputCodeSec(){

       $secCode = isset($_POST['codeSec'])? trim($_POST['codeSec']) : null; 
       $idTroca = isset($_POST['idTroca'])?(int)trim($_POST['idTroca']) : null;
       if (!empty($secCode) && !empty($idTroca)){
         $troca =$this->TrocasDAO->findByIdTroca($idTroca); $trocaObj=$troca[0];
       if ($trocaObj->getUsuariosIdOferta()->getId() === $this->getIdUsuarioLogado()) {    
        // print_r($trocaObj->getSecCode()); echo' '; print_r($secCode);exit;
        if(!empty($trocaObj) && $trocaObj->getSecCode() === $secCode){
            $valid = $this->exgangeAnuncios($idTroca);
           print_r($valid);exit;
            if($valid === true) 
                $this->TrocasDAO->deleteTrocas($idTroca);
            }
          }
        }
        else{
            echo'erro'; exit;
        }
        return $this->trocasPages();
    }
    
    private function exgangeAnuncios(Int $idTroca){
     $troca= $this->TrocasDAO->findByIdTroca($idTroca);$trocaObj = $troca[0];
     $idAuxUserSolicitador = $trocaObj->getUsuariosIdSolicitador()->getId();
     $idAuxUserOferta = $trocaObj->getUsuariosIdSolicitador()->getId();
     $idAuxAnSolicitador = $trocaObj->getAnunciosIdSolicitador()->getId();
     $idAuxAnOferta = $trocaObj->getAnunciosIdOferta()->getId();
     $auxAnOferta = $this->anunciosDAO->findAnuncioByAnuncioId($idAuxAnOferta);
     $auxAnSolicitador = $this->anunciosDAO->findAnuncioByAnuncioId($idAuxAnSolicitador);
     if (!empty($auxAnSolicitador())&&!empty($auxAnOferta())) {
        $newAnSolicitador = $auxAnSolicitador[0]; 
        $newAnOferta = $auxAnOferta[0];
        $newAnSolicitador->setUsuariosId()->setId($idAuxUserOferta);
        $newAnOferta->setUsuariosId()->setId($idAuxAnSolicitador);
        $newAnSolicitador->setStatus();
        $anArray =[$newAnSolicitador,$newAnOferta];
        for ($i=0; $i < 1; $i++) { 
            $this->TrocasDAO->updateTroca($anArray[$i]);
        }
        return true;
     }
     return false;
    }
   
    private function verificaAtivo(){

    }
    private function verificaIdUser(Anuncios $ans){
        if($ans->getUsuarioIdInt() === $this->getIdUsuarioLogado())
            header("location:" . HOME_PAGE);
    }
}
$new = new TrocasController();
