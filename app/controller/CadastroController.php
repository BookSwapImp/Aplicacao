<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../service/CadastroService.php");

class CadastroController extends Controller{
    private UsuarioDAO $usuarioDao;
    private CadastroService $cadastroService;

    function __construct(){
        $this->usuarioDao = new UsuarioDAO();
        $this->cadastroService = new CadastroService(); 
        $this->handleAction(); 
    }
    protected function cadastroPage() {
        $this->loadView("cadastro/cadastro.php", []);
    }
     /* Método para Cadastrar um usuário a partir dos dados informados no formulário */
     protected function cadastroon(){
        $this->loadView("cadastro/cadastro.php", []);
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null; 
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;
        $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;
        $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : null;
        $confSenha = isset($_POST['conf_senha']) ? trim($_POST['conf_senha']) : null;// para verificar a senha
        $usuarioAux = array($nome,$email,$senha,$telefone,$cpf);
        $erros= $this->cadastroService->validarCampos($nome,$email,$senha,$confSenha,$cpf,$telefone);        $msg = implode("<br>", $erros);
        if(empty($erros)) {
            //Valida o login a partir do banco de dados
            $usuario = $this->usuarioDao->insert($nome,$email,$senha,$cpf,$telefone);
           if($usuario) {
                //Se encontrou o usuário, salva a sessão e redireciona para a HOME do sistema
                $this->cadastroService->salvarUsuarioSessao($usuario);

                header("location: " . HOME_PAGE);
                exit;
            } else {
                $erros = ["Login ou senha informados são inválidos!"];
            }
        }
        $dados= null;
      

       // $this->loadView("login/login.php", $dados, $msg);
     }
}

new CadastroController();