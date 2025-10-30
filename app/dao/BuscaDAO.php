<?php
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/Anuncio.php");
require_once(__DIR__ . "/../model/Usuario.php");

class BuscaDAO{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getConn();
    }

    public function buscaOnlyUser(string $busca): array
    {
        $sql = "SELECT * FROM usuarios WHERE nome LIKE :busca";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue("busca", "%" . $busca . "%");
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBuscaUser($result);
    }

    public function buscaOnlyAnuncio(string $busca): array
    {
        $sql = "SELECT * FROM anuncios WHERE nome_livro LIKE :busca AND status = 'ativo'";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue("busca", "%" . $busca . "%");
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBuscaAnuncio($result);
    }

    public function busca(string $busca): array
    {
        $dados = array();
        $dados = array_merge($dados, $this->buscaOnlyAnuncio($busca));
        $dados = array_merge($dados, $this->buscaOnlyUser($busca));
        return $dados;
    }

    private function mapBuscaUser(array $result): array
    {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id']);
            $usuario->setNome($reg['nome']);
            $usuario->setEmail($reg['email']);
            $usuario->setTelefone($reg['telefone']);
            $usuario->setCpf($reg['cpf']);
            $usuario->setSenha($reg['senha']);
            $usuario->setTipo($reg['tipo']);
            $usuario->setStatus($reg['status']);
            $usuario->setFotoDePerfil($reg['foto_de_perfil']);
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    private function mapBuscaAnuncio(array $result): array
    {
        $anuncios = array();
        foreach ($result as $reg) {
            $anuncio = new Anuncio();
            $usuario = new Usuario();
            $anuncio->setId($reg['id']);
            $usuario->setId($reg['usuarios_id']); $anuncio->setUsuarioId($usuario);
            $anuncio->setNomeLivro($reg['nome_livro']);
            $anuncio->setImagemLivro($reg['imagem_livro']);
            $anuncio->setDescricao($reg['descricao']);
            $anuncio->setDataPublicacao(new DateTime($reg['data_publicacao']));
            $anuncio->setEstadoCon($reg['estado_con']);
            $anuncio->setStatus($reg['status']);
            array_push($anuncios, $anuncio);
        }
        return $anuncios;
    }

}
$DAoCu = new BuscaDAO();
 $cuu = $DAoCu->busca('pequeno');
 print_r($cuu);
