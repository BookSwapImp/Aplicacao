<?php


include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Anuncios.php");
include_once(__DIR__ . "/../model/Usuario.php");

class AnunciosDAO{
     public function listAnuncio() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM anuncios a ORDER BY a.id";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapAnuncios($result);
    }
        public function findAnunciosByUsuariosId(int $usuariosId){
            $conn = Connection::getConn();
            $sql = "SELECT * FROM anuncios an
                    WHERE BINARY an.usuarios_id = ?";
            
            $stm = $conn->prepare($sql);
            $stm->execute([$usuariosId]);
            $result = $stm->fetchAll();
            $livros = $this->mapAnuncios($result);
            
            return $livros;
    }
        public function findAnuncioByAnuncioId(int $anuncioId){
                        $conn = Connection::getConn();
            $sql = "SELECT * FROM anuncios an
                    WHERE BINARY an.id = ?";
            
            $stm = $conn->prepare($sql);
            $stm->execute([$anuncioId]);
            $result = $stm->fetchAll();
            $livros = $this->mapAnuncios($result);
            
            return $livros;
        }

     private function mapAnuncios($result){
        $livros = array();
        foreach ($result as $reg) {
            $livro = new Livro();
            $usuario = new Usuario();
            $usuario->setId($reg['usuarios_id']);
            $livro->setId($reg['id']);
            $livro->setUsuarioId( $usuario);
            $livro->setNomeLivro( $reg['nome_livro']);
            $livro->setImagemLivro($reg['imagem_livro']);
            $livro->setValorAnuncio($reg['valor_anuncio']);
            $livro->setDescricao($reg['descricao']);
            $livro->setDataPublicacao(new DateTime($reg['data_publicacao']));
            $livro->setEstadoCon($reg['estado_con']);
            $livro->setStatus($reg['status']);
            array_push($livros, $livro);
        }
        return $livros;
    }
    public function insertAnuncios(Livro $livro) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO `anuncios` (
                    `usuarios_id`,
                    `nome_livro`,
                    `imagem_livro`,
                    `valor_anuncio`,
                    `descricao`,
                    `data_publicacao`,
                    `status`,
                    `estado_con`
                ) VALUES (
                    :usuarios_id,
                    :nome_livro,
                    :imagem_livro,
                    :valor_anuncio,
                    :descricao,
                    :data_publicacao,
                    :status,
                    :estado_con
                )";

        $stm = $conn->prepare($sql);
        $stm->bindValue("usuarios_id", $livro->getUsuarioId());
        $stm->bindValue("nome_livro", $livro->getNomeLivro());
        $stm->bindValue("imagem_livro", $livro->getImagemLivro());
        $stm->bindValue("valor_anuncio", $livro->getValorAnuncio());
        $stm->bindValue("descricao", $livro->getDescricao());
        $stm->bindValue("data_publicacao", $livro->getDataPublicacao());
        $stm->bindValue("status", $livro->getStatus());
        $stm->bindValue("estado_con", $livro->getEstadoCon());

        $stm->execute();
        }


}
?>