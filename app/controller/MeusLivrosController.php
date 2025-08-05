<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/AnunciosDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");
require_once(__DIR__."/../service/EnderecoService.php");
require_once(__DIR__."/../service/EnderecoDAO.php");

class MeusLivrosController extends Controller {

    private UsuarioDAO $usuarioDao;
    private AnunciosDAO $anunciosDao;
    private UsuarioService $usuarioService;
    private ArquivoService $arquivoService;
    private EnderecoService $enderecoService;
    private EnderecoDAO $enderecoDAO;

    public function __construct() {
        if(! $this->usuarioEstaLogado())
            return;

        $this->usuarioDao = new UsuarioDAO();
        $this->anunciosDao = new AnunciosDAO();
        $this->usuarioService = new UsuarioService();
        $this->arquivoService = new ArquivoService();
        $this->enderecoService = new EnderecoService();

        $this->handleAction();    
    }
    protected function procurarUsuarioId(){
        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $usuario = $this->usuarioDao->findById($idUsuarioLogado);
        return $usuario;
    }
    protected function procurarAnunciosId(){
        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $anuncios = $this->anunciosDao->findAnunciosByUsuariosId($idUsuarioLogado);
        return $anuncios;
    }

    protected function meusLivrosPage() {
        $dados['usuario'] = $this->procurarUsuarioId();
        $dados['anuncios'] = $this->procurarAnunciosId();
        $this->loadView("meusLivros/meusLivros.php", $dados); 
    }

    protected function perfilPage() {
       $dados['usuario'] = $this->procurarUsuarioId();
        $this->loadView("meusLivros/perfil.php", $dados);
    }
    protected function cadastroLivroPage(){
        $dados['usuario'] = $this->procurarUsuarioId();
        $this->loadView("cadastro/cadastroLivros.php",$dados);
    }
    protected function editarPerfilPage(){
        $dados['usuario'] = $this->procurarUsuarioId();
        $this->loadView("meusLivros/editarPerfil.php", $dados);
    }

    protected function save() {
        $foto = $_FILES["foto"];
        
        //Validar se o usuário mandou a foto de perfil
        $erros = $this->usuarioService->validarFotoPerfil($foto);
        if(! $erros) {
            //1- Salvar a foto em um arquivo
            $this->arquivoService->salvarArquivo($foto);
            echo "Arquivo salvo!";
            
            //2- Atualizar o registro do usuário com o nome da foto
            
            exit;
        }

        $dados['usuario'] = $this->procurarUsuarioId();

        $msgErro = implode("<br>", $erros);

        $this->loadView("meusLivros/perfil.php", $dados, $msgErro); 
    }
        protected function cadastroEnderecoPage(){
        $dados['usuario'] = $this->procurarUsuarioId();
        $this->loadView("cadastro/cadastroEndereco.php", $dados);
    }

            protected function cadastroEnderecoOn()  {
                $nome = $_POST['nome'];
                $id = $resolveAmanha;
                $enderosVfc = $this->enderecoService->validarCampos($enderecos);
                if(! $enderosVfc) {
                    $this->enderecoDAO->insertEndereco($enderecos);
                    echo "Endereço salvo!";
                }
                $dados['usuario'] = $this->procurarUsuarioId();
                $msgErro = implode("<br>", $enderosVfc);
                $this->loadView("cadastro/cadastroEndereco.php", $dados, $msgErro);
            }

}

new MeusLivrosController();