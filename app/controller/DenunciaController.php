<?php
require_once(__DIR__."/Controller.php");
require_once(__DIR__ . "/../model/Denuncia.php");
require_once(__DIR__ . "/../dao/DenunciaDAO.php");

class DenunciaController extends Controller{
    private DenunciaDAO $denunciaDAO;

    public function __construct()
    {
        if(! $this->usuarioEstaLogado())
            return;
        $this->denunciaDAO = new DenunciaDAO();
    }

    public function createDenuncia(Denuncia $denuncia)
    {
        $anuncioId= trim($_POST['anuncio_id'])? (int)trim($_POST['anuncio_id']): null;
        $usuarioReuId= trim($_POST['usuario_reu_id'])? (int)trim($_POST['usuario_reu_id']): null;
        $usuarioAcusadorId= trim($_POST['usuario_acusador_id'])? (int)trim($_POST['usuario_acusador_id']): null;
        if($usuarioAcusadorId=== $usuarioReuId)
            return header('location: '.BASEURL.'/controller/HomeController.php?action=Home');
        $denuncia->setAnuncio($anuncioId);
        $denuncia->setUsuarioReu($usuarioReuId);
        $denuncia->setUsuarioAcusador($usuarioAcusadorId);

        return $this->denunciaDAO->createDenuncia($denuncia);
    }

    public function getAllDenuncias(): array
    {
        return $this->denunciaDAO->getAllDenuncias();
    }
}
