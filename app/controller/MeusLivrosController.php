<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/Anuncios.php");
require_once(__DIR__ . "/../dao/AnunciosDAO.php");
require_once(__DIR__ . "/../service/CadastroLivroService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");


class MeusLivrosController extends Controller {
    private Usuario $usuario;
    private UsuarioDAO $usuarioDao;
    private Anuncios $anuncios;
    private AnunciosDAO $anunciosDao;
    private CadastroLivroService $cadastroLivroService;
    private ArquivoService $arquivoService;

    public function __construct() {
        if(! $this->usuarioEstaLogado())
            return;
        $this->usuario = new Usuario();
        $this->usuarioDao = new UsuarioDAO();
        $this->anuncios = new Anuncios();
        $this->anunciosDao = new AnunciosDAO();
        $this->arquivoService = new ArquivoService();
        $this->cadastroLivroService = new CadastroLivroService();

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
    protected function procurarAnuncioIdAnuncio($id){
        $anuncios = $this->anunciosDao->findAnuncioByAnuncioId($id);
        return $anuncios;
    }

    protected function meusLivrosPage() {
        $dados['usuario'] = $this->procurarUsuarioId();
        $dados['anuncios'] = $this->procurarAnunciosId();
        $this->loadView("meusLivros/meusLivros.php", $dados); 
    }
    protected function editarLivroPage() {
        $idLivro = isset($_GET['idLivro']) ? (int)trim($_GET['idLivro']) : null;
       $livro = $this->procurarAnuncioIdAnuncio($idLivro);
      $dados = [
    'idLivro' => $livro->getId(),
    'usuarioLivro' => $livro->getUsuarioId()->getId(),
    'imagemLivro' => $livro->getImagemLivro(),
    'nomeLivro' => $livro->getNomeLivro(),
    'descricao' => $livro->getDescricao(),
    'estadoCon' => $livro->getEstadoCon(),
    'status' => $livro->getStatus()
];
        $this->loadView("meusLivros/editarLivros.php", $dados);
    }

    protected function editarLivro(){
        // Receber dados do formulário
        $idLivro = isset($_POST['id_livro']) ? (int)trim($_POST['id_livro']) : null;
        $id = $this->getIdUsuarioLogado();
        $nomeLivro = isset($_POST['nome_livro']) ? trim($_POST['nome_livro']) : null;
        $imagemLivro = isset($_FILES['imagem_livro']) ? $_FILES['imagem_livro'] : null;
        $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : null;
        $estadoCon = isset($_POST['estado_con']) ? trim($_POST['estado_con']) : null;
        $statusInput = isset($_POST['status']) ? trim($_POST['status']) : null;
        $status = ($statusInput === 'publico') ? 'ativo' : 'inativo';
        
        // Validar campos
        $this->anuncios->setId($idLivro);
        $this->anuncios->setUsuarioId($this->usuario->setId($id));
        $this->anuncios->setNomeLivro($nomeLivro);
        $this->anuncios->setDescricao($descricao);
        $this->anuncios->setEstadoCon($estadoCon);
        $erros = $this->cadastroLivroService->validarCampos($this->anuncios);

        // Só valida a imagem se uma nova foi enviada (opcional)
        if ($imagemLivro && $imagemLivro['size'] > 0) {
            $errosArquivo = $this->arquivoService->validarArquivo($imagemLivro);
            if (!empty($errosArquivo)) {
                $erros = array_merge($erros, $errosArquivo);
            }
        }
        
        if(empty($erros)) {
            // Buscar o anúncio existente
            $anuncioExistente = $this->procurarAnuncioIdAnuncio($idLivro);
            
            if ($anuncioExistente) {
                // Atualizar os dados do anúncio
                $anuncioExistente->setNomeLivro($nomeLivro);
                $anuncioExistente->setDescricao($descricao);
                $anuncioExistente->setEstadoCon($estadoCon);
                $anuncioExistente->setStatus($status);
                
                // Processar nova imagem se enviada
                if ($imagemLivro && $imagemLivro['error'] === UPLOAD_ERR_OK) {
                    // Salvar nova imagem
                    $nomeImagem = $this->arquivoService->salvarArquivo($imagemLivro);
                    
                    // Apagar imagem antiga se existir
                    $fotoAntiga = $anuncioExistente->getImagemLivro();
                    if ($fotoAntiga && $fotoAntiga !== 'basePfp.jpeg') {
                        $this->arquivoService->excluirArquivo($fotoAntiga);
                    }
                    
                    // Atualizar com nova imagem
                    $anuncioExistente->setImagemLivro($nomeImagem);
                }
                
                // Salvar alterações
                $this->anunciosDao->updateAnuncios($anuncioExistente);
                
                // Redirecionar para página de sucesso
                header("Location: " . BASEURL . "/controller/MeusLivrosController.php?action=meusLivrosPage");
                exit;
            } else {
                $erros[] = "Livro não encontrado";
            }
        }
        
        // Se chegou aqui, houve erros
        $dados['usuario'] = $this->procurarUsuarioId();
        $dados['livro'] = $this->procurarAnuncioIdAnuncio($idLivro);
        $msgErro = implode("<br>", $erros);
        $this->loadView("meusLivros/editarLivros.php", $dados, $msgErro);
    }
    
    protected function deletarLivro(){
        $idLivro = isset($_GET['idLivro']) ? (int)trim($_GET['idLivro']):null;
        $this->arquivoService->excluirArquivo($idLivro);
        $this->anunciosDao->excluirAnuncios($idLivro);
        header("Location: " . BASEURL . "/controller/MeusLivrosController.php?action=meusLivrosPage");
        exit;
    }
    
    protected function cadastroLivroPage(){
        $dados['usuario'] = $this->procurarUsuarioId();
        $this->loadView("cadastro/cadastroLivros.php",$dados);
    }
    
    protected function saveLivro() {
        // Receber dados do formulário
        $nomeLivro = isset($_POST['nome_livro']) ? trim($_POST['nome_livro']) : null;
        $imagemLivro = isset($_FILES['imagem_livro']) ? $_FILES['imagem_livro'] : null;
        $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : null;
        $estadoCon = isset($_POST['estado_con']) ? trim($_POST['estado_con']) : null;
        $status = 'ativo';
        
        // Obter ID do usuário logado
        
        $idUsuario = $this->getIdUsuarioLogado();
        
        // Validar campos (implementar validação adequada)
        $erros = [];
  
        $this->anuncios->setId(null);
        $this->anuncios->setUsuarioId($this->usuario->setId($idUsuario));
        $this->anuncios->setNomeLivro($nomeLivro);
        $this->anuncios->setDescricao($descricao);
        $this->anuncios->setEstadoCon($estadoCon);
        $this->anuncios->setStatus($status);
        $erros = $this->cadastroLivroService->validarCampos($this->anuncios);
        $errosArquivo = $this->arquivoService->validarArquivo($imagemLivro);
        if (!empty($errosArquivo)) {
            $erros = array_merge($erros, $errosArquivo);
        }
          
        if(empty($erros)) {
            // Salvar imagem
            $nomeImagem = null;
            if ($imagemLivro && $imagemLivro['error'] === UPLOAD_ERR_OK) {
                $nomeImagem = $this->arquivoService->salvarArquivo($imagemLivro);
            }
            
            // Criar objeto Anuncio
            $usuario = new Usuario();
            $usuario->setId($idUsuario);
            $anuncio = new Anuncios();
            $anuncio->setUsuarioId($usuario);
            $anuncio->setNomeLivro($nomeLivro);
            $anuncio->setImagemLivro($nomeImagem);
            $anuncio->setDescricao($descricao);
            $anuncio->setDataPublicacao(new DateTime());
            $anuncio->setStatus($status);
            $anuncio->setEstadoCon($estadoCon);
            
            // Salvar anúncio
            $this->anunciosDao->insertAnuncios($anuncio);

            // Redirecionar para página de sucesso
            header("Location: " . BASEURL . "/controller/MeusLivrosController.php?action=meusLivrosPage");
            exit;
        } else {
            // Retornar com erros
            $dados['usuario'] = $this->procurarUsuarioId();
            $msgErro = implode("<br>", $erros);
            $this->loadView("cadastro/cadastroLivros.php", $dados, $msgErro);
        }
    }
    private function saveFotoLivro(?array $imagemLivro) {
        if ($imagemLivro === null && isset($_FILES['imagem_livro'])) {
            $imagemLivro = $_FILES['imagem_livro'];
        }

        $erros = $this->arquivoService->validarArquivo($imagemLivro);

        if(empty($erros)) {
            $arquivoService = new ArquivoService();
            $novoNomeFoto = $arquivoService->salvarArquivo($imagemLivro);
            // Apaga foto anterior se existir
            $anuncios = $this->procurarAnunciosId();
            if (!empty($anuncios) && is_array($anuncios) && isset($anuncios[0])) {
                $anuncio = $anuncios[0];
                $fotoAntiga = $anuncio->getImagemLivro();
                if ($fotoAntiga && $fotoAntiga !== 'basePfp.jpeg') {
                    $arquivoService->excluirArquivo($fotoAntiga);
                }
                // Atualizar registro do usuário com novo nome da foto
                $anuncio->setImagemLivro($novoNomeFoto);
             // $this->anunciosDao->update($anuncio);
            }
           // exit;
        }
        $dados['usuario'] = $this->procurarUsuarioId();
        $msgErro = implode("<br>", $erros);
        $this->loadView("cadastro/cadastroLivros.php", $dados, $msgErro); 
    }

}

new MeusLivrosController();