
<?php

include_once(__DIR__ . "/connection/Connection.php");

class testeDAO{
     public function listLivros() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM anuncios a ORDER BY a.id";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        $mapped = $this->mapLivros($result);
        print_r($mapped);
        return $mapped;
    }
     private function mapLivros($result){
        $livros = array();
        foreach ($result as $reg) {
            $idUSer = $reg['usuarios_id'];
            $id= $reg['id'];

            $nomeLivro = $reg['nome_livro'];
            $imagemLivro =$reg['imagem_livro'];
            $valorAnuncio =$reg['valor_anuncio'];
            $descricao=$reg['descricao'];
            $dataPublicacao = new DateTime($reg['data_publicacao']);
            $estadoCon = $reg['estado_con'];
            $status=$reg['status'];
            array_push($livros, [
                'idUsuario' => $idUSer,
                'id' => $id,
                'nomeLivro' => $nomeLivro,
                'imagemLivro' => $imagemLivro,
                'valorAnuncio' => $valorAnuncio,
                'descricao' => $descricao,
                'dataPublicacao' => $dataPublicacao->format('Y-m-d'),
                'estadoConservacao' => $estadoCon,
                'status' => $status
            ]);

        }
        return $livros;
    }
}