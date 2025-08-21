<?php


include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Anuncios.php");
include_once(__DIR__ . "/../model/Usuario.php");

// Verificar se a classe Anuncios foi carregada
if (!class_exists('Anuncios')) {
    die("Erro: Classe Anuncios não foi encontrada. Verifique se o arquivo Anuncios.php está correto.");
}

class AnunciosDAO{
     public function listAnuncio() {
        $conn = Connection::getConn();
        $sql = "SELECT * FROM anuncios a WHERE status = 'ativo' ORDER BY a.id";
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
            $anuncio = $this->mapAnuncios($result);
            
            return $anuncio;
    }
        public function findAnuncioByAnuncioId(int $anuncioId){
            $conn = Connection::getConn();
            $sql = "SELECT * FROM anuncios an
                    WHERE BINARY an.id = ?";
            
            $stm = $conn->prepare($sql);
            $stm->execute([$anuncioId]);
            $result = $stm->fetchAll();
            $anuncios = $this->mapAnuncios($result);
            
            if(count($anuncios) == 1)
                return $anuncios[0];
            elseif(count($anuncios) == 0)
                return null;

            die("AnunciosDAO.findAnuncioByAnuncioId()" . 
                " - Erro: mais de um anúncio encontrado.");
        }

     private function mapAnuncios($result){
        $anuncios = array();
        foreach ($result as $reg) {
            $anuncio = new Anuncios();
            $usuario = new Usuario();
           // $usuario->setId($reg['usuarios_id']);
            $anuncio->setId($reg['id']);
            $anuncio->setUsuarioId( $usuario->setId($reg['usuarios_id']));
            $anuncio->setNomeLivro( $reg['nome_livro']);
            $anuncio->setImagemLivro($reg['imagem_livro']);
            $anuncio->setDescricao($reg['descricao']);
            $anuncio->setDataPublicacao(new DateTime($reg['data_publicacao']));
            $anuncio->setEstadoCon($reg['estado_con']);
            $anuncio->setStatus($reg['status']);
            array_push($anuncios, $anuncio);
        }
        return $anuncios;
    }
    public function excluirAnuncios(int $idLivro) {
        $conn = Connection::getConn();
        $sql = "DELETE FROM anuncios WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$idLivro]);
    }
    public function insertAnuncios(Anuncios $anuncio) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO `anuncios` (
                    `usuarios_id`,
                    `nome_livro`,
                    `imagem_livro`,
                    `descricao`,
                    `data_publicacao`,
                    `status`,
                    `estado_con`
                ) VALUES (
                    :usuarios_id,
                    :nome_livro,
                    :imagem_livro,
                    :descricao,
                    :data_publicacao,
                    :status,
                    :estado_con
                )";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("usuarios_id", $anuncio->getUsuarioIdInt());
        $stm->bindValue("nome_livro", $anuncio->getNomeLivro());
        $stm->bindValue("imagem_livro", $anuncio->getImagemLivro());
        $stm->bindValue("descricao", $anuncio->getDescricao());
        
        // Format DateTime for SQL
        $dataPublicacao = $anuncio->getDataPublicacao();
        $stm->bindValue("data_publicacao", $dataPublicacao->format('Y-m-d H:i:s'));
      
        
        $stm->bindValue("status", $anuncio->getStatus());
        $stm->bindValue("estado_con", $anuncio->getEstadoCon());

        $stm->execute();
        }
    public function updateAnuncios(Anuncios $anuncio) {
        $conn = Connection::getConn();
          $sql = "UPDATE anuncios SET
                    usuarios_id  = :usuarios_id,
                    nome_livro = :nome_livro,
                    imagem_livro = :imagem_livro,
                    descricao = :descricao,
                    data_publicacao = :data_publicacao,
                    estado_con = :estado_con,
                    status = 'ativo'
                WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("usuarios_id", $anuncio->getUsuarioIdInt());
        $stm->bindValue("nome_livro", $anuncio->getNomeLivro());
        $stm->bindValue("imagem_livro", $anuncio->getImagemLivro());
        $stm->bindValue("descricao", $anuncio->getDescricao());
        $stm->bindValue("data_publicacao", $anuncio->getDataPublicacao()->format('Y-m-d H:i:s'));
        $stm->bindValue("estado_con", $anuncio->getEstadoCon());
        $stm->bindValue("id", $anuncio->getId());

        $stm->execute();
    }
}
?>