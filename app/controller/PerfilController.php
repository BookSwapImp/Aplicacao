<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../service/EditarService.php");
require_once(__DIR__ . "/../dao/AnuncioDAO.php");
class PerfilController extends Controller {

    private UsuarioDAO $usuarioDao;
    private AnuncioDAO $anuncioDAO;
    private UsuarioService $usuarioService;
    private ArquivoService $arquivoService;
    private EditarService $editarService;

    public function __construct() {
        if(! $this->usuarioEstaLogado())
            return;

        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        $this->arquivoService = new ArquivoService();
        $this->editarService = new EditarService();

        $this->handleAction();    
    }

    protected function procurarUsuarioId(){
        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $usuario = $this->usuarioDao->findById($idUsuarioLogado);
        return $usuario;
    }

    protected function perfilPage() {
       $dados['usuario'] = $this->procurarUsuarioId();
        $this->loadView("perfil/perfil.php", $dados);
    }
    protected function otherUserPerfilPage(){
        $idProfile = isset($_GET['id']) ? (int)trim($_GET['id']): null;
        if($idProfile === $this->getIdUsuarioLogado() || $idProfile === null) 
           return header('location: '.BASEURL.'/controller/HomeController.php?action=Home');
        $this->anuncioDAO = new AnuncioDAO();
        $dados['usuario'] = $this->usuarioDao->findById($idProfile);

        if (empty($dados['usuario'])) 
            return header('location: '.BASEURL.'/controller/HomeController.php?action=Home');

        $dados['livros'] = $this->anuncioDAO->findAnunciosByUsuariosIdAtivos($idProfile);
        
        $this->loadView("perfil/otherUserPerfil.php", $dados);
    }

    protected function editarPerfilPage(){
        $dados['usuario'] = $this->procurarUsuarioId();
        $this->loadView("perfil/editarPerfil.php", $dados);
    }

    protected function atualizarPerfil(){
        // Receber dados do formulário com estrutura correta
        $imagem = isset($_FILES['foto_perfil']) ? $_FILES['foto_perfil'] : null;
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $cpf = isset($_POST['cpf']) ? (int)trim($_POST['cpf']) : null;
        $telefone = isset($_POST['telefone']) ? (int)trim($_POST['telefone']) : null;
        
        // Obter ID do usuário logado
        $idUsuario = $this->getIdUsuarioLogado();
        
        // Validar campos obrigatórios (sem foto)
        $erros =
        
        $erros = $this->editarService->validarCampos(  $this->getIdUsuarioLogado(),$cpf, $telefone);

        // Validar foto apenas se foi enviada
        $errosFoto = [];
        if ($imagem && $imagem['error'] !== UPLOAD_ERR_NO_FILE) {
            $errosFoto = $this->arquivoService->validarArquivo($imagem);
        }
        
        $erros = array_merge($erros, $errosFoto);

        if(empty($erros)) {
            // Atualizar perfil do usuário
            $usuario = new Usuario();
            $usuario->setId($idUsuario);
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setCpf($cpf);
            $usuario->setStatus('ativo');
            $usuario->setTelefone($telefone);

            // Se foi enviada nova foto, salva e apaga a anterior
            if ($imagem && $imagem['error'] === UPLOAD_ERR_OK) {
                $arquivoService = new ArquivoService();
                $novoNomeFoto = $arquivoService->salvarArquivo($imagem);
                // Apaga foto anterior se existir
                $fotoAntiga = $this->procurarUsuarioId()->getFotoDePerfil();
                if ($fotoAntiga && $fotoAntiga !== 'basePfp.jpeg') {
                    $arquivoService->excluirArquivo($fotoAntiga);
                }
                $usuario->setFotoDePerfil($novoNomeFoto);
            } else {
                // Manter foto existente quando nenhuma nova foto é enviada
                $fotoAtual = $this->procurarUsuarioId()->getFotoDePerfil();
                $usuario->setFotoDePerfil($fotoAtual);
            }

            // Atualizar usuário
            $this->usuarioDao->update($usuario);

            // Redirecionar para página de sucesso
            header("Location: " . BASEURL . "/controller/PerfilController.php?action=perfilPage");
            exit;
        } else {
            // Retornar com erros
            $dados['usuario'] = $this->procurarUsuarioId();
            $msgErro = implode("<br>", $erros);
            $this->loadView("perfil/editarPerfil.php", $dados, $msgErro);
        }
    }

    private function saveFotoUser($foto) {
        $foto = $_FILES["foto_perfil"];
        $erros = $this->usuarioService->validarFotoPerfil($foto);
        if(!$erros) {
            $arquivoService = new ArquivoService();
            $novoNomeFoto = $arquivoService->salvarArquivo($foto);
            // Apaga foto anterior se existir
            $fotoAntiga = $this->procurarUsuarioId()->getFotoDePerfil();
            if ($fotoAntiga && $fotoAntiga !== 'basePfp.jpeg') {
                $arquivoService->excluirArquivo($fotoAntiga);
            }
            // Atualizar registro do usuário com novo nome da foto
            $usuario = $this->procurarUsuarioId();
            $usuario->setFotoDePerfil($novoNomeFoto);
            $this->usuarioDao->update($usuario);
           // exit;
        }
        $dados['usuario'] = $this->procurarUsuarioId();
        $msgErro = implode("<br>", $erros);
        $this->loadView("perfil/perfil.php", $dados, $msgErro); 
    }
}

new PerfilController();