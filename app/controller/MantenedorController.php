<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . '/../model/enum/UsuarioPapel.php');

require_once(__DIR__ . '/../dao/UsuarioDAO.php');
require_once(__DIR__ . '/../dao/AnuncioDAO.php');
require_once(__DIR__ . '/../dao/TrocasDAO.php');



class MantenedorController extends Controller
{
    private Usuario $usuario;
    private UsuarioDAO $usuarioDAO;
    private AnuncioDAO $anuncioDAO;
    private TrocasDAO $TrocasDAO;

    
    public function __construct()
    {
        if (!$this->usuarioEstaLogado())
            return;
        
        $this->usuarioDAO = new UsuarioDAO();
        $this->anuncioDAO = new AnuncioDAO();
        $this->TrocasDAO = new TrocasDAO();
        
        $userType = $this->usuarioDAO->findById($this->getIdUsuarioLogado());

        if ($userType->getTipo() !==  UsuarioPapel::ADMINISTRADOR)
            header("location: " . LOGIN_PAGE);
        
        $this->usuario = new Usuario();

        //Tratar a ação solicitada no parâmetro "action"
        $this->handleAction();
    }

    protected function home()
    {
        $dados = array();

        $dados['usuarios'] = $this->usuarioDAO->list(5);
        // $dados['denuncias'] = $this->denunciasDAO->listAllDenuncias(); ;;

        $dados['numeroLivros'] = $this->anuncioDAO->quantidadeAnuncios();
        $dados['numeroUsuarios'] = $this->usuarioDAO->quantidadeUsuarios();
        
        $this->loadView("mantenedor/homeMantenedor.php", $dados);
    }

    protected function usuarios()
    {
        $dados = array();

        $dados['usuarios'] = $this->usuarioDAO->list();
        // $dados['denuncias'] = $this->denunciasDAO->listAllDenuncias(); ;;

        $dados['numeroAnuncios'] = $this->anuncioDAO->quantidadeAnuncios();
        $dados['numeroUsuarios'] = $this->usuarioDAO->quantidadeUsuarios();
        
        $this->loadView("mantenedor/usuariosMantenedor.php", $dados);
    }

    protected function anuncios()
    {
        $dados = array();

        $dados['anuncios'] = $this->anuncioDAO->listAnuncio();
        // $dados['denuncias'] = $this->denunciasDAO->listAllDenuncias(); ;;

        $dados['numeroAnuncios'] = $this->anuncioDAO->quantidadeAnuncios();
        
        $this->loadView("mantenedor/anunciosMantenedor.php", $dados);
    }

    // --   FINALIZAR FUNÇÕES APÓS CRIAÇÃO DAS PÁGINAS -- //

     protected function trocas()
    {
        $dados = array();

        $dados['trocas'] = $this->TrocasDAO->list();
        // $dados['denuncias'] = $this->denunciasDAO->listAllDenuncias(); ;;

        $dados['numeroAnuncios'] = $this->anuncioDAO->quantidadeAnuncios();
        
        $this->loadView("mantenedor/anunciosMantenedor.php", $dados);
    }

    protected function denuncias()
    {
        $dados = array();

        $dados['anuncios'] = $this->anuncioDAO->listAnuncio();
        //$dados['denuncias'] = $this->denunciasDAO->listAllDenuncias(); ;;

        $dados['numeroAnuncios'] = $this->anuncioDAO->quantidadeAnuncios();
        
        $this->loadView("mantenedor/anunciosMantenedor.php", $dados);
    }

    
}

new MantenedorController();
