<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/AnunciosDAO.php");
require_once(__DIR__."/../dao/EnderecoDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");
require_once(__DIR__."/../service/EnderecoService.php");


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
        $this->enderecoDAO = new EnderecoDAO();

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
    protected function atualizarPerfil(){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['nova_senha'];

    //$this->loadView("meusLivros/editarPerfil.php", $dados);
        
    }

    protected function saveFoto() {
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
                // Receber dados do formulário com estrutura correta
                $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
                $rua = isset($_POST['rua']) ? trim($_POST['rua']) : null;
                $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : null;
                $cep = isset($_POST['cep']) ? trim($_POST['cep']) : null;
                $estado = isset($_POST['estado']) ? trim($_POST['estado']) : null;
                $numb = isset($_POST['numb']) ? (int)trim($_POST['numb']) : null;
                $complemento = isset($_POST['complemento']) ? trim($_POST['complemento']) : null;
                $main = isset($_POST['main']) ? trim($_POST['main']) : 'normal';
                
                // Obter ID do usuário logado
                $idUsuario = $this->getIdUsuarioLogado();
                
                // Validar campos
                $erros = $this->enderecoService->validarCampos($rua, $cidade, $cep, $estado, $numb);
                
                if(empty($erros)) {
                    // Criar objeto Endereco
                    $endereco = new Endereco();
                    $endereco->setNome($nome);
                    $endereco->setUsuariosId($idUsuario);
                    $endereco->setRua($rua);
                    $endereco->setCidade($cidade);
                    $endereco->setCep($cep);
                    $endereco->setEstado($estado);
                    $endereco->setNumb($numb);
                    $endereco->setMain($main);
                    
                    // Salvar endereço
                   $this->enderecoDAO->insertEndereco($endereco);
                    
                    // Redirecionar para página de sucesso
                    header("Location: " . BASEURL . "/controller/MeusLivrosController.php?action=meusLivrosPage");
                    exit;
                } else {
                    // Retornar com erros
                    $dados['usuario'] = $this->procurarUsuarioId();
                    $msgErro = implode("<br>", $erros);
                    $this->loadView("cadastro/cadastroEndereco.php", $dados, $msgErro);
                }
            }

}

new MeusLivrosController();