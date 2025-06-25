<?php


include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Livro.php");

class LivroDAO{
     public function listLivros() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM livros l ORDER BY l.id";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapLivros($result);
    }
     private function mapLivros($result){
        $livros = array();
        foreach ($result as $reg) {
            $livro = new Livro();
            $livro->setId($reg['id']);
            $livro->setUsuarioId($reg['usuarios_id']);
            $livro->setNomeLivro($reg['nome_livro']);
            $livro->setImagemLivro($reg['imagem_livro']);
            $livro->setValorAnuncio($reg['valor_anuncio']);
            $livro->setDescricao($reg['descricao']);
            $livro->setDataPublicacao($reg['data_publicacao']);
            $livro->setAvaliacao($reg['avaliacao']);
            $livro->setNota($reg['nota']);
            $livro->setEstadoCon($reg['estado_con']);
            array_push($livros, $livro);
        }
        return $livros;
    }
 public function insertLivros(Livro $livro) {
    $conn = Connection::getConn();

    $sql = "INSERT INTO `anuncios` (
                `usuarios_id`,
                `nome_livro`,
                `imagem_livro`,
                `valor_anuncio`,
                `descricao`,
                `data_publicacao`,
                `avaliacao`,
                `nota`,
                `status`,
                `estado_con`
            ) VALUES (
                :usuarios_id,
                :nome_livro,
                :imagem_livro,
                :valor_anuncio,
                :descricao,
                :data_publicacao,
                :avaliacao,
                :nota,
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
    $stm->bindValue("avaliacao", $livro->getAvaliacao());
    $stm->bindValue("nota", $livro->getNota());
    $stm->bindValue("status", $livro->getStatus());
    $stm->bindValue("estado_con", $livro->getEstadoCon());

    $stm->execute();
}

}
?>