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
        echo'teste';                
        $this->loadView("cadastro/cadastro.php", []);
    }
     /* Método para Cadastrar um usuário a partir dos dados informados no formulário */
     protected function cadastrar(){
         echo'cadatro';
         
        $this->loadView("cadastro/cadastro.php", []);
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null; 
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;
        $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : null;
        $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : null;
        $confSenha = isset($_POST['conf_senha']) ? trim($_POST['conf_senha']) : null;// para verificar a senha
        $erros=[];
        $msg=[];
        $errosRetornados = $this->cadastroService->validarCampos($nome, $email, $senha, $confSenha, $cpf, $telefone);

        // Se $errosRetornados não for um array (ou seja, se for false ou null), use um array vazio.
        $erros = is_array($errosRetornados) ? $errosRetornados : [];
        $msg = implode("<br>", $erros);

        $dados["nome"] = $nome;
        $dados["email"] = $email;
        $dados["telefone"] = $telefone;
        $dados["cpf"] = $cpf;

        if (empty($erros)) {
            // Se não há erros de validação
            echo 'cadastro enviado';
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

        // A linha abaixo passa $msg, mas se não há erros, $msg será vazia.
            $this->loadView("cadastro/cadastro_sucesso.php", $dados,$msg); // Exemplo de view de sucesso
             header("location: " . LOGIN_PAGE);
            return;
        } else {
        $this->loadView("cadastro/cadastro.php", $dados,$msg); // Recarrega a tela de cadastro com os erros
            return;
        }
        
    
   } 
}  
new CadastroController();
