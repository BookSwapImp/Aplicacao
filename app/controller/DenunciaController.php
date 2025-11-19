<?php
require_once(__DIR__."/Controller.php");
require_once(__DIR__ . "/../model/Denuncia.php");
require_once(__DIR__ . "/../model/Anuncio.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/DenunciaDAO.php");
require_once(__DIR__ . "/../dao/AnuncioDAO.php");


class DenunciaController extends Controller{
    private DenunciaDAO $denunciaDAO;
    private AnuncioDAO $anuncioDAO;


    public function __construct()
    {
        if(! $this->usuarioEstaLogado())
            return;
        $this->denunciaDAO = new DenunciaDAO();
        $this->anuncioDAO = new AnuncioDAO();
        $this->handleAction();
    }

    protected function loadDenunciaForm()
    {   
        $dados = [];
        if(isset($_GET['anuncio_id']) && isset($_GET['usuario_reu_id']) && isset($_GET['usuario_acusador_id'])){
            $dados['anuncio_id'] = (int)trim($_GET['anuncio_id']);
            $dados['usuario_reu_id'] = (int)trim($_GET['usuario_reu_id']);
            $dados['usuario_acusador_id'] = (int)trim($_GET['usuario_acusador_id']);
            return $this->loadView('denuncia/formDenuncia.php', $dados);
        }

        return header('location: '.BASEURL.'/controller/HomeController.php?action=Home');
    }

    protected function createDenuncia()
    {
        $denuncia = new Denuncia();
        $anuncio  = new Anuncio();

        $anuncioId= trim($_POST['anuncio_id'])? (int)trim($_POST['anuncio_id']): null;
        $usuarioReuId= trim($_POST['usuario_reu_id'])? (int)trim($_POST['usuario_reu_id']): null;
        $usuarioAcusadorId= trim($_POST['usuario_acusador_id'])? (int)trim($_POST['usuario_acusador_id']): null;
        
        if($usuarioAcusadorId === $usuarioReuId)
            return header('location: '.BASEURL.'/controller/HomeController.php?action=Home');
        
        $anuncio = $this->anuncioDAO->findAnuncioByAnuncioId($anuncioId);

        
        $idReuAux= new Usuario();
        $idAcusadorAux= new Usuario();
        $idAcusadorAux->setId($usuarioAcusadorId);
        $idReuAux->setId($usuarioReuId);

        $denuncia->setAnuncio($anuncio);
        
        $denuncia->setUsuarioReu($idReuAux);
        $denuncia->setUsuarioAcusador($idAcusadorAux);
        $denuncia->setDescricao(trim($_POST['descricao'])? trim($_POST['descricao']): '');

        $this->denunciaDAO->createDenuncia($denuncia);
        return header('location: '.BASEURL.'/controller/HomeController.php?action=Home');
    }

    public function denuncias()
    {

        $mgsErro = '';
        $dados['denuncias'] = $this->denunciaDAO->getAllDenuncias();

        if(empty($dados)) 
            $mgsErro = 'Nenhuma denúncia encontrada.';
        
        return $this->loadView('denuncia/listarDenuncias.php', $dados);
    }
  
}

new DenunciaController();
