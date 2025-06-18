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
    public function cadastroPage() {
        echo'teste';                
        $this->loadView("cadastro/cadastro.php", []);
    }
     /* Método para Cadastrar um usuário a partir dos dados informados no formulário */
     protected function cadastrar(){
        $this->loadView("cadastro/cadastro.php", []);
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null; 
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;
        $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;
        $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : null;
        $confSenha = isset($_POST['conf_senha']) ? trim($_POST['conf_senha']) : null;// para verificar a senha
        $erros= $this->cadastroService->validarCampos($nome,$email,$senha,$confSenha,$cpf,$telefone);        
        $msg = implode("<br>", $erros);
        
        $dados["nome"] = $nome;
        $dados["email"] = $email;
        $dados["telefone"] = $telefone;
        $dados["cpf"] = $cpf;
       
        // Redireciona ou carrega tela de sucesso/login
            if (empty($erros)) {
                // Criar objeto Usuario com os dados
                $usuario = new Usuario();
                $usuario->setNome($nome);
                $usuario->setEmail($email);
                $usuario->setSenha($senha);
                $usuario->setTelefone($telefone);
                $usuario->setCpf($cpf);
                $usuario->setTipo("usuario");   
                $usuario->setStatus("ativo");  

                // Inserir no banco
                $this->usuarioDao->insert($usuario);
                $this->loadView("cadastro/cadastro.php", $dados , $msg);
                return;
            }
    }
    

}   
new CadastroController();