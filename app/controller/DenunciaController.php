<?php
require_once(__DIR__."/Controller.php");
require_once(__DIR__ . "/../model/Denuncia.php");
require_once(__DIR__ . "/../model/Anuncio.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/DenunciaDAO.php");

class DenunciaController extends Controller{
    private DenunciaDAO $denunciaDAO;

    public function __construct()
    {
        if(! $this->usuarioEstaLogado())
            return;
        $this->denunciaDAO = new DenunciaDAO();
    }

    protected function createDenuncia(Denuncia $denuncia)
    {
        $anuncioId= trim($_POST['anuncio_id'])? (int)trim($_POST['anuncio_id']): null;
        $usuarioReuId= trim($_POST['usuario_reu_id'])? (int)trim($_POST['usuario_reu_id']): null;
        $usuarioAcusadorId= trim($_POST['usuario_acusador_id'])? (int)trim($_POST['usuario_acusador_id']): null;
        if($usuarioAcusadorId === $usuarioReuId)
            return header('location: '.BASEURL.'/controller/HomeController.php?action=Home');
        $idReuAux= new Usuario();
        $idAcusadorAux= new Usuario();
        $idAcusadorAux->setId($usuarioAcusadorId);
        $idReuAux->setId($usuarioReuId);
        $denuncia->setAnuncio($anuncioId);
        $denuncia->setUsuarioReu($idReuAux);
        $denuncia->setUsuarioAcusador($idAcusadorAux);

        $this->denunciaDAO->createDenuncia($denuncia);
        return header('location: '.BASEURL.'/controller/HomeController.php?action=Home');
    }

    protected function getAllDenuncias()
    {
        $mgsErro = '';
        $dados = $this->denunciaDAO->getAllDenuncias();
        if(empty($dados)) 
            $mgsErro = 'Nenhuma denúncia encontrada.';
        //return $this->loadView('denuncia/listarDenuncias', $dados);
    }
  
}
