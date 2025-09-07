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
        $dados['enderecos'] = $this->listarEnderecosUserId($this->getIdUsuarioLogado()); 
       
        //print_r($dados['enderecos']);
     
        $this->loadView("enderecos/endereco.php", $dados);
    }
    protected function editarEnderecosPage() {
    $dados['usuario'] = $this->procurarUsuarioId();
    $id = isset($_POST['id']) ? (int)$_POST['id'] : (isset($_GET['id']) ? (int)$_GET['id'] : 0);
    if($id > 0){
        $dados['endereco'] = $this->enderecoDAO->findById($id);
    }
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
             
                // Obter ID do usuário logado
                $idUsuario = $this->getIdUsuarioLogado();
                $endereco = $this->enderecoDAO->findMainEnderecosExist($idUsuario);
                if($endereco === null){
                    $main = 'main';
                } else {
                    $main = 'normal';
                }
                // Validar campos
                $erros = $this->enderecoService->validarCampos($rua, $cidade, $cep, $estado, $numb);
                $limite = $this->listarEnderecosUserId($idUsuario);
                if(count($limite) >= 3) {
                    $erros[] = "Limite de 3 endereços atingido.";
                }
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
                    header("Location: " . BASEURL . "/controller/EnderecosController.php?action=EnderecosPage");
                    exit;
                } else {
                    // Retornar com erros
                    $dados['usuario'] = $this->procurarUsuarioId();
                    $msgErro = implode("<br>", $erros);
                    $this->loadView("cadastro/cadastroEndereco.php", $dados, $msgErro);
                }
            }
    protected function editarEnderecosOn()  {
                // Receber dados do formulário com estrutura correta
                $id = isset($_POST['id']) ? (int)trim($_POST['id']) : 0;
                $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
                $rua = isset($_POST['rua']) ? trim($_POST['rua']) : null;
                $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : null;
                $cep = isset($_POST['cep']) ? trim($_POST['cep']) : null;
                $estado = isset($_POST['estado']) ? trim($_POST['estado']) : null;
                $numb = isset($_POST['numb']) ? (int)trim($_POST['numb']) : null;
                $main = isset($_POST['main']) ? trim($_POST['main']) : null;
             
                // Obter ID do usuário logado
                $idUsuario = $this->getIdUsuarioLogado();
                
                // Validar campos
                $erros = $this->enderecoService->validarCampos($rua, $cidade, $cep, $estado, $numb);
                
                if(empty($erros)) {
                    // Criar objeto Endereco
                    $endereco = new Endereco();
                    $endereco->setId($id);
                    $endereco->setNome($nome);
                    $endereco->setUsuariosId($idUsuario);
                    $endereco->setRua($rua);
                    $endereco->setCidade($cidade);
                    $endereco->setCep($cep);
                    $endereco->setEstado($estado);
                    $endereco->setNumb($numb);
                    if($main === 'main'){
                        $this->enderecoDAO->unsetMainEnderecos($idUsuario);
                        $endereco->setMain('main');
                    }else {
                        $endereco->setMain('normal');
                    }
                    
                    // Salvar endereço
                   $this->enderecoDAO->updateEndereco($endereco);
                    
                    // Redirecionar para página de sucesso
                    header("Location: " . BASEURL . "/controller/EnderecosController.php?action=enderecoPage");
                    exit;
                } else {
                    // Retornar com erros
                    $dados['usuario'] = $this->procurarUsuarioId();
                    $msgErro = implode("<br>", $erros);
                    $this->loadView("enderecos/enderecoEditar.php", $dados, $msgErro);
                }
            }
    protected function DeletarEnderecos(){

        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $this->enderecoDAO->deleteEndereco($id);
        $this->enderecoPage();
    }
            
    
}
new EnderecosController();