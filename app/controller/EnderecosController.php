<?php
require_once(__DIR__ . '/../controller/Controller.php');
require_once(__DIR__ . '/../model/Endereco.php');
require_once(__DIR__ . '/../dao/EnderecoDAO.php');
require_once(__DIR__ . '/../dao/UsuarioDAO.php');
require_once(__DIR__ . '/../service/EnderecoService.php');

class EnderecosController extends Controller {
    private $enderecoDAO;
    private $enderecoService;
    private $usuarioDao;
    
    public function __construct() {
        if(! $this->usuarioEstaLogado())
            return;
        $this->enderecoDAO = new EnderecoDAO();
        $this->enderecoService = new EnderecoService();
        $this->usuarioDao = new UsuarioDAO();
        
        $this->handleAction();
    }
    
    protected function procurarUsuarioId(){
        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $usuario = $this->usuarioDao->findById($idUsuarioLogado);
        return $usuario;
    }
    protected function procurarEnderecoId(int $id){
        return $this->enderecoDAO->findByUsuarioId($id);
    }
    protected function listarEnderecosUserId(int $id){
        return $this->enderecoDAO->findByUsuarioId($id);
    }
    protected function cadastroEnderecoPage(){
        $dados['usuario'] = $this->procurarUsuarioId();
        $this->loadView("cadastro/cadastroEndereco.php", $dados);
    }
    protected function enderecoPage(){
        $dados['usuario'] = $this->procurarUsuarioId();
        // findByUsuarioId retorna linhas associativas para a view
        $dados['enderecos'] = $this->listarEnderecosUserId($dados['usuario']->getId());
        $this->loadView("enderecos/endereco.php", $dados);
    }

  
    protected function cadastroEnderecoOn()  {
                // Receber dados do formulário com estrutura correta
                $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
                $rua = isset($_POST['rua']) ? trim($_POST['rua']) : null;
                $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : null;
                $cep = isset($_POST['cep']) ? trim($_POST['cep']) : null;
                $estado = isset($_POST['estado']) ? trim($_POST['estado']) : null;
                $numb = isset($_POST['numb']) ? (int)trim($_POST['numb']) : null;
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
                    header("Location: " . BASEURL . "/controller/MenuController.php?action=meusLivrosPage");
                    exit;
                } else {
                    // Retornar com erros
                    $dados['usuario'] = $this->procurarUsuarioId();
                    $msgErro = implode("<br>", $erros);
                    $this->loadView("cadastro/cadastroEndereco.php", $dados, $msgErro);
                }
            }
    protected function editarEnderecosPage() {
    $dados['usuario'] = $this->procurarUsuarioId();
    $this->loadView("enderecos/editarEnderecos.php", $dados);
    }
}
new EnderecosController();