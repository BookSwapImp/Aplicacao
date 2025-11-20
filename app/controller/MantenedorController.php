<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . '/../model/enum/UsuarioPapel.php');
require_once(__DIR__ . '/../model/enum/Status.php');
require_once(__DIR__ . '/../dao/UsuarioDAO.php');
require_once(__DIR__ . '/../dao/AnuncioDAO.php');
require_once(__DIR__ . '/../dao/TrocasDAO.php');
require_once(__DIR__ . '/../dao/DenunciaDAO.php');
require_once(__DIR__ . '/../service/ArquivoService.php');



class MantenedorController extends Controller
{
    private Usuario $usuario;
    private UsuarioDAO $usuarioDAO;
    private AnuncioDAO $anuncioDAO;
    private TrocasDAO $TrocasDAO;
    private DenunciaDAO $denunciaDAO;

    
    public function __construct()
    {
        if (!$this->usuarioEstaLogado())
            return;
        if ($this->getStatusUsuarioLogado() === Status::INATIVO || $this->getStatusUsuarioLogado() === null)
            return;
        
        $this->usuarioDAO = new UsuarioDAO();
        $this->anuncioDAO = new AnuncioDAO();
        $this->TrocasDAO = new TrocasDAO();
        $this->denunciaDAO = new DenunciaDAO();
        
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

        $denunciaDAO = new DenunciaDAO();
        $dados['denuncias'] = $denunciaDAO->getAllDenuncias();
        //$dados['denuncias'] = $this->denunciasDAO->listAllDenuncias(); ;;

        $dados['numeroAnuncios'] = $this->anuncioDAO->quantidadeAnuncios();

        $this->loadView("mantenedor/denunciasMantenedor.php", $dados);
    }

    protected function banirUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_id'])) {
            $usuarioId = (int) $_POST['usuario_id'];
            $denunciaId = (int) $_POST['denuncia_id'];

            // Buscar todos os anúncios do usuário
            $anuncios = $this->anuncioDAO->findAnunciosByUsuariosId($usuarioId);

            // Excluir fotos dos anúncios
            $arquivoService = new ArquivoService();
            foreach ($anuncios as $anuncio) {
                if ($anuncio->getImagemLivro()) {
                    $arquivoService->excluirArquivo($anuncio->getImagemLivro());
                }
            }

            // Excluir todos os anúncios
            foreach ($anuncios as $anuncio) {
                $this->anuncioDAO->excluirAnuncios($anuncio->getId());
            }

            // Deixar a conta inativa
            $usuario = $this->usuarioDAO->findById($usuarioId);
            if ($usuario) {
                $usuario->setStatus('inativo');
                $this->usuarioDAO->update($usuario);
                $this->denunciaDAO->deleteDenuncia($denunciaId);
            }

            // Redirecionar de volta com mensagem
            header("Location: " . BASEURL . "/controller/MantenedorController.php?action=denuncias&msg=Usuario banido com sucesso");
            exit;
        }
    }
    protected function removerDenuncia()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['denuncia_id'])) 
             $denunciaId = (int) $_POST['denuncia_id'];
        
            // Excluir a denúncia
            $this->denunciaDAO->deleteDenuncia($denunciaId);

            // Redirecionar de volta com mensagem
            header("Location: " . BASEURL . "/controller/MantenedorController.php?action=denuncias&msg=Denúncia removida com sucesso");
            exit;
        }
    }

    

new MantenedorController();
