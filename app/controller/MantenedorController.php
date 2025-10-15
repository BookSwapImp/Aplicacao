<?php
require_once(__DIR__ . "/Controller.php");

require_once(__DIR__ . '/../model/enum/UsuarioPapel.php');

require_once(__DIR__ . '/../dao/UsuarioDAO.php');
require_once(__DIR__ . '/../dao/AnuncioDAO.php');


class MantenedorController extends Controller
{
    private Usuario $usuario;
    private UsuarioDAO $usuarioDAO;
    private AnuncioDAO $anuncioDAO;

    
    public function __construct()
    {
        if (!$this->usuarioEstaLogado())
            return;

        $this->usuarioDAO = new UsuarioDAO();
        $this->anuncioDAO = new AnuncioDAO();
        
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

        $dados['numeroLivros'] = $this->anuncioDAO->quantidadeAnuncios();
        $dados['numeroUsuarios'] = $this->usuarioDAO->quantidadeUsuarios();
        
        $this->loadView("mantenedor/usuariosMantenedor.php", $dados);
    }
}

new MantenedorController();
