<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../model/Anuncios.php");
require_once(__DIR__ . "/../dao/AnunciosDAO.php");
require_once(__DIR__ . "/../service/ArquivoService.php");


class MeusLivrosController extends Controller {

    private UsuarioDAO $usuarioDao;
    private Anuncios $anuncios;
    private AnunciosDAO $anunciosDao;
    private ArquivoService $arquivoService;

    public function __construct() {
        if(! $this->usuarioEstaLogado())
            return;
        $this->usuarioDao = new UsuarioDAO();
        $this->anuncios = new Anuncios();
        $this->anunciosDao = new AnunciosDAO();
        $this->arquivoService = new ArquivoService();

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
    
    protected function alterarLivro(){
        // Implementação do método para alterar livro
    }
    
    protected function deletarLivro(){
        $idLivro = isset($_GET['idLivro']) ? (int)trim($_GET['idLivro']):null;
       //this->anunciosDao->excluirAnuncios($idLivro);
        $this->arquivoService->excluirArquivo($idLivro);
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
        $status = isset($_POST['status']) ? trim($_POST['status']) : 'ativo';
        
        // Obter ID do usuário logado
        $idUsuario = $this->getIdUsuarioLogado();
        
        // Validar campos (implementar validação adequada)
        $erros = [];
        if (!$nomeLivro) $erros[] = "Nome do livro é obrigatório";
        if (!$descricao) $erros[] = "Descrição é obrigatória";
        if (!$estadoCon) $erros[] = "Estado de conservação é obrigatório";
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
            $anuncio = new Anuncios();
            $anuncio->setUsuarioId($idUsuario);
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