<?php
require_once(__DIR__ . '/../controller/Controller.php');
require_once(__DIR__ . '/../model/Endereco.php');
require_once(__DIR__ . '/../dao/EnderecoDAO.php');
require_once(__DIR__ . '/../dao/UsuarioDAO.php');
require_once(__DIR__ . '/../service/EnderecoService.php');

class EnderecosController extends Controller {
    private $endereco;
    private $enderecoDAO;
    private $enderecoService;
    private $usuarioDao;
    
    public function __construct() {
        if(! $this->usuarioEstaLogado())
            return;
        $this->endereco = new Endereco();
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
                $mainAux = isset($_POST['main'])? isset($_POST['main']): null;
             
                // Obter ID do usuário logado
                $idUsuario = $this->getIdUsuarioLogado();
                $enderecos = $this->enderecoDAO->findEnderecosExist($idUsuario);
                $this->endereco->setId($idUsuario);
                $this->endereco->setNome($nome);
                $this->endereco->setUsuariosId($idUsuario);
                $this->endereco->setRua($rua);
                $this->endereco->setCidade($cidade);
                $this->endereco->setCep($cep);
                $this->endereco->setEstado($estado);
                $this->endereco->setNumb($numb);
                $this->endereco->setMain($mainAux);
                // Obter ID do usuário logado
                $idUsuario = $this->getIdUsuarioLogado();
                // Validar campos

                $erros = $this->enderecoService->validarCampos($this->endereco);
                $limite = $this->listarEnderecosUserId($idUsuario);
                $validarMain = $this->enderecoService->ValidarMain($this->endereco);
                if(count($limite) >= 3) {
                    $erros[] = "Limite de 3 endereços atingido.";
                }
                if(empty($erros) || boolval($validarMain) ) {
                    // Criar objeto Endereco
                    // Salvar endereço
                    if ($validarMain === null && $this->endereco->getMain() === 'normal') {
                        $this->endereco->setMain('main');
                    }
                     $this->enderecoDAO->insertEndereco($this->endereco);
                    
                    // Redirecionar para página de sucesso
                    $this->enderecoPage();
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
                $mainAux = isset($_POST['main']) ? trim($_POST['main']) : null;
               
                $this->endereco->setId($id);
                $this->endereco->setNome($nome);
                $this->endereco->setRua($rua);
                $this->endereco->setCidade($cidade);
                $this->endereco->setCep($cep);
                $this->endereco->setEstado($estado);
                $this->endereco->setNumb($numb);
                $this->endereco->setMain($mainAux);
                // Obter ID do usuário logado
                $idUsuario = $this->getIdUsuarioLogado();
                $this->endereco->setUsuariosId($idUsuario);
                // Validar campos

                $erros = $this->enderecoService->validarCampos($this->endereco);
             
                if(empty($erros)) {
                   
                    $this->enderecoDAO->updateEndereco($this->endereco);
                    $validarMain = $this->enderecoService->ValidarMain($this->endereco);
                
                    if ($validarMain === null && $this->endereco->getMain() === 'normal') {
                        $this->endereco->setMain('main');
                        $this->enderecoDAO->updateEndereco($this->endereco);
                    }
                    elseif($validarMain === true && $this->endereco->getMain()==='main'){
                        $this->enderecoDAO->unsetMainEnderecos($this->endereco->getUsuariosId());
                        $this->enderecoDAO->updateEndereco($this->endereco);
                    }
                    else
                        print_r($validarMain);

                    // Redirecionar para página de sucesso
                   $this->enderecoPage();
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