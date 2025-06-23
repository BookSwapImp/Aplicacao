<?php
include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Livro.php");

class LivrosDAO{
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
}
?>