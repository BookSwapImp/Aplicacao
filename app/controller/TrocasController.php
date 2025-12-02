<?php
require_once(__DIR__ . '/../controller/Controller.php');
require_once(__DIR__.'/../model/Trocas.php'); 
require_once(__DIR__.'/../model/enum/UsuarioPapel.php'); 
require_once(__DIR__.'/../model/enum/Status.php'); 
require_once(__DIR__.'/../dao/AnuncioDAO.php');
require_once(__DIR__.'/../dao/UsuarioDAO.php');  
require_once(__DIR__.'/../dao/TrocasDAO.php'); 
class TrocasController extends Controller{
    private Usuario $usuario;
    private UsuarioDAO $usuarioDAO;
    private Anuncio $anuncio;
    private AnuncioDAO $anuncioDAO;
    private Trocas $Trocas;
  
    private $TrocasDAO;
    public function __construct(){
        if(! $this->usuarioEstaLogado())
        return;
        if ($this->getStatusUsuarioLogado() === Status::INATIVO || $this->getStatusUsuarioLogado() === null)
        return;
         if ($this->getTipoUsuarioLogado() ===  UsuarioPapel::ADMINISTRADOR || $this->getTipoUsuarioLogado() === null)
        return;
    
        $this->Trocas = new Trocas();
        $this->TrocasDAO = new TrocasDAO();
        $this->anuncioDAO= new AnuncioDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->handleAction(); 
    }
  

    protected function trocasPages($msgErro = ""){
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
                $anuncio = $this->anuncioDAO->findAnuncioByAnuncioId($tr->getAnunciosIdSolicitador()->getId());
                $usuarioData = $this->usuarioDAO->findById($usuarioSolicitador);
                if($atividade == Status::ATIVO)
                    $anuncio->setStatusTroca(true);
                else
                    $anuncio->setStatusTroca(false);
                $oferta = array('anuncio' => $anuncio, 'trocaId' => $tr->getId() , 'OtherUserData' => $usuarioData);
                array_push($ofertas, $oferta);
            }
            if($usuarioSolicitador ==$this->getIdUsuarioLogado()){
                $anuncio = $this->anuncioDAO->findAnuncioByAnuncioId($tr->getAnunciosIdOferta()->getId());
                $usuarioOtherData = $this->usuarioDAO->findById($usuarioOfertaId);
                if($atividade == Status::ATIVO){
                    $anuncio->setStatusTroca(true);
                    $solicit = array('anuncio' => $anuncio, 'trocaId' => $tr->getId(), 'secCode' => $tr->getSecCode(),'OtherUserData' => $usuarioOtherData);
                }else{
                    $anuncio->setStatusTroca(false);
                    $solicit = array('anuncio' => $anuncio, 'trocaId' => $tr->getId(),'OtherUserData' => $usuarioOtherData);
                }
                array_push($solicitacao, $solicit);
            }
        } 
        $dados["ofertas"] = $ofertas;

        $dados["solicitacao"] = $solicitacao;

        $this->loadView('trocas/trocas.php',$dados, $msgErro );
    }
     protected function trocasIntoPage($msgErro = ""){
        $dados = array();
        $dados['AnuncioOferta'] = $this->anuncioDAO->findAnuncioByAnuncioId($_GET['idAnuncio']);
        
        $this->verificaIdUser($dados['AnuncioOferta']);
        $dados['AnunciosSolicitador']= $this->anuncioDAO->findAnunciosByUsuariosId($this->getIdUsuarioLogado());
        $this->loadView('trocas/trocasInto.php',$dados , $msgErro); 
    }
    protected function trocaInto(){
        $idAnOferta=isset($_POST['idAnOferta'])?(int)trim($_POST['idAnOferta']): null;
        $idAnSolicitador = isset($_POST['idAnSolicitador'])?(int)trim($_POST['idAnSolicitador']): null; 
        if (!empty($idAnOferta) && !empty($idAnSolicitador)) {
            $valid = $this->TrocasDAO->findTrocasExistByIdAnu($idAnOferta,$idAnSolicitador);
            if ($valid === true)
               {$msgErro="Seu Livro ja tem uma troca existente com este anuncio"; 
                return header("Location: " . BASEURL."/controller/HomeController.php?action=home");}//$this->trocasIntoPage($msgErro)
            $anuncioOferta = $this->anuncioDAO->findAnuncioByAnuncioId($idAnOferta);
            $anuncioAuxSolict = new Anuncio();$anuncioAuxOferta = new Anuncio();
            $anuncioSolicitador = $this->anuncioDAO->findAnuncioByAnuncioId($idAnSolicitador);
            $anuncioAuxSolict->setId($anuncioSolicitador->getId());
            $this->Trocas->setAnunciosIdOferta($anuncioAuxOferta);
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

                    // Enviar WhatsApp para o outro usuário
                    $usuarioSolicitador = $trocaObj->getUsuariosIdSolicitador();
                    //$telefone = $usuarioSolicitador->getTelefone();
                    $mensagem = "Olá! Sua troca foi ativada. Acesse o sistema para mais detalhes.";
                   // $this->enviarWhatsApp($telefone, $mensagem);
                }
            }
        }
        return $this->trocasPages();
    }
      protected function buttonDeleteTrade(){
       $idTroca= isset($_POST['idTroca'])? (int)trim($_POST['idTroca']): null;
       if(!empty($idTroca)){
       $troca = $this->TrocasDAO->findByIdTroca($idTroca);
       $trocaObj = $troca[0];
       $idSolict =  $trocaObj->getUsuariosIdOferta();
       $idSolict =  $trocaObj->getUsuariosIdOferta()->getId();
       $idOfert = $trocaObj->getUsuariosIdSolicitador()->getId();
       if ($idSolict === $this->getIdUsuarioLogado() || $idOfert ===$this->getIdUsuarioLogado()) {
           $this->TrocasDAO->deleteTroca($trocaObj->getId()); 
         $id = $trocaObj->getId();
        $this->TrocasDAO->deleteTroca($id);
            }
        }
       return $this->trocasPages();
    }
    protected function inputCodeSec(){

       $secCode = isset($_POST['codeSec'])? trim($_POST['codeSec']) : null; 
       $idTroca = isset($_POST['idTroca'])?(int)trim($_POST['idTroca']) : null;
       if (!empty($secCode) && !empty($idTroca)){
         $troca =$this->TrocasDAO->findByIdTroca($idTroca); 
         $trocaObj=$troca[0];
       if ($trocaObj->getUsuariosIdOferta()->getId() === $this->getIdUsuarioLogado()) {    
         $idAnDeleteSolict = $trocaObj->getAnunciosIdSolicitador()->getId();
         $idAnDeleteOfert = $trocaObj->getAnunciosIdOferta()->getId();
        if(!empty($trocaObj) && $trocaObj->getSecCode() === $secCode){
            $valid = $this->exgangeAnuncios($idTroca);
        
            if($valid === true){ 
                $this->TrocasDAO->deleteTroca($idTroca);
                $this->TrocasDAO->deleteTrocaByIdAn($idAnDeleteSolict);
                $this->TrocasDAO->deleteTrocaByIdAn( $idAnDeleteOfert);
                return header('Location: '. BASEURL."/controller/MeusLivrosController.php?action=meusLivrosPage");
                 
               }
             }
           }
        }
         $msgErro = "Código de segurança inválido";
         return $this->trocasPages($msgErro);
    }
    
    private function exgangeAnuncios(Int $idTroca){
     $troca= $this->TrocasDAO->findByIdTroca($idTroca);$trocaObj = $troca[0];
     $idAuxUserSolicitador = $trocaObj->getUsuariosIdSolicitador()->getId();
     $idAuxUserOferta = $trocaObj->getUsuariosIdOferta()->getId();
     $idAuxAnSolicitador = $trocaObj->getAnunciosIdSolicitador()->getId();
     $idAuxAnOferta = $trocaObj->getAnunciosIdOferta()->getId();
     $auxAnOferta = $this->anuncioDAO->findAnuncioByAnuncioId( $idAuxAnOferta );
     $auxAnSolicitador = $this->anuncioDAO->findAnuncioByAnuncioId($idAuxAnSolicitador);
     if (!empty($auxAnSolicitador) && !empty($auxAnOferta)) {
        $newIdUserSolicit = new Usuario(); 
        $newIdUserOfert = new Usuario();
        $newIdUserSolicit->setId($idAuxUserOferta);
        $newIdUserOfert->setId($idAuxUserSolicitador);
        $newAnSolicitador = $auxAnSolicitador;  
        $newAnOferta = $auxAnOferta;
        $newAnSolicitador->setUsuarioId($newIdUserSolicit);
        $newAnOferta->setUsuarioId($newIdUserOfert);
        $anArray = [$newAnSolicitador, $newAnOferta];
        for ($i=0; $i < 2; $i++) { 
            $this->anuncioDAO->updateAnuncios($anArray[$i]);
        }
        return true;
     }
     return false;
    }
   
 
    private function verificaIdUser(Anuncio $ans){
        if($ans->getUsuarioIdInt() === $this->getIdUsuarioLogado())
            header("location:" . HOME_PAGE);
    }

    private function enviarWhatsApp($telefone, $mensagem) {
        // Formatar telefone para WhatsApp (remover formatação)
        $telefoneLimpo = preg_replace('/[^0-9]/', '', $telefone);

        // URL do WhatsApp API (usando wa.me para link direto)
        $url = "https://wa.me/" . $telefoneLimpo . "?text=" . urlencode($mensagem);

        // Usar curl para abrir o link (simula clique no link WhatsApp)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);

        // Nota: Isso abre o link, mas o envio real depende do usuário clicar em "Enviar" no WhatsApp Web ou app.
        // Para envio automático, seria necessário uma API como Twilio ou similar, mas aqui usamos o link direto.
    }
}
$new = new TrocasController();
