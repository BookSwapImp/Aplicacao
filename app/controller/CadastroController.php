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
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;
        $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;
        $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : null;
        $confSenha = isset($_POST['conf_senha']) ? trim($_POST['conf_senha']) : null;// para verificar a senha
        $dados= null;
        $msg=null;

       // $this->loadView("login/login.php", $dados, $msg);
     }
}

new CadastroController();