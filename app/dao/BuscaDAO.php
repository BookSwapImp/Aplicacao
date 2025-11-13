<?php
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/Anuncio.php");
require_once(__DIR__ . "/../model/Usuario.php");

class BuscaDAO{
    private PDO $conn;
    private Usuario $usuario;
    private Anuncio $anuncio;

    public function __construct()
    {
        $this->conn = Connection::getConn();
    }

    public function buscaOnlyUser(string $busca, Usuario $an): array
    {
        $sql = "SELECT * FROM usuarios WHERE nome LIKE :busca AND BINARY id != :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue("busca", "%" . $busca . "%");
        $stm->bindValue("id", $an->getId());
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBuscaUser($result);
    }

    public function buscaOnlyAnuncio(string $busca,usuario $an ): array
    {
        $sql = "SELECT * FROM anuncios WHERE nome_livro LIKE :busca AND status = 'ativo' AND BINARY anuncios.usuarios_id != :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue("busca", "%" . $busca . "%");
        
        $stm->bindValue("id", $an->getId());
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapBuscaAnuncio($result);
    }

    public function busca(string $busca, Usuario $usuario): array
    {
        $dados = array();
        $dados = array_merge($dados, $this->buscaOnlyAnuncio($busca,$usuario));
        $dados = array_merge($dados, $this->buscaOnlyUser($busca,$usuario));
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
