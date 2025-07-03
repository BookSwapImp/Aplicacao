<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/LivroDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");

class MeusLivrosController extends Controller {

    private UsuarioDAO $usuarioDao;
    private LivroDAO $livroDao;
    private UsuarioService $usuarioService;
    private ArquivoService $arquivoService;

    public function __construct() {
        if(! $this->usuarioEstaLogado())
            return;

        $this->usuarioDao = new UsuarioDAO();
        $this->livroDao = new LivroDAO();
        $this->usuarioService = new UsuarioService();
        $this->arquivoService = new ArquivoService();

        $this->handleAction();    
    }

    protected function view() {
        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $usuario = $this->usuarioDao->findById($idUsuarioLogado);
        $dados['usuario'] = $usuario;
        $livros = $this->livroDao->findLivroByUsuariosId($idUsuarioLogado);
        $dados['livros'] = $livros;
        
        $this->loadView("meusLivros/perfil.php", $dados); 
    }
    protected function cadastroLivroPage(){
        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $usuario = $this->usuarioDao->findById($idUsuarioLogado);
        $dados['usuario'] = $usuario;
        $this->loadView("cadastro/cadastroLivro.php",$dados);
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

        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $usuario = $this->usuarioDao->findById($idUsuarioLogado);
        $dados['usuario'] = $usuario;

        $msgErro = implode("<br>", $erros);

        $this->loadView("meusLivros/perfil.php", $dados, $msgErro); 
    }

}

new MeusLivrosController();