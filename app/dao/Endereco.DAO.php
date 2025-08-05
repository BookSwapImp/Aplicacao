<?php
require_once(__DIR__."/../model/Endereco.php");
    class EnderecoDAO{
        public function findEnderecoByUsuarioId($id){
            $conn = Connection::getConn();
            $sql = "SELECT * FROM enderecos WHERE id_usuario = :id";
            $stm = $conn->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            return $this->mapEnderecos($result);
        }
        public function updateEndereco(Endereco $endereco){
            $conn = Connection::getConn();
            $sql = "UPDATE enderecos SET nome = :nome, rua = :rua, cidade = :cidade, estado = :estado, cep = :cep, id_usuario = :id_usuario WHERE id = :id";
            $stm = $conn->prepare($sql);
            $stm->bindValue("nome", $endereco->getNome());
            $stm->bindValue("rua", $endereco->getRua());
            $stm->bindValue("cidade", $endereco->getCidade());
            $stm->bindValue("estado", $endereco->getEstado());
            $stm->bindValue("cep", $endereco->getCep());
            $stm->bindValue("id_usuario", $endereco->getIdUsuario());
            $stm->bindValue("id", $endereco->getId());
            $stm->execute();
        }
        public function insertEndereco(Endereco $endereco){
            $conn = Connection::getConn();
            $sql = "INSERT INTO enderecos (nome, rua, cidade, estado, cep, id_usuario) VALUES (:nome, :rua, :cidade, :estado, :cep, :id_usuario)";
            $stm = $conn->prepare($sql);
            $stm->bindValue("nome", $endereco->getNome());
            $stm->bindValue("rua", $endereco->getRua());
            $stm->bindValue("cidade", $endereco->getCidade());
            $stm->bindValue("estado", $endereco->getEstado());
            $stm->bindValue("cep", $endereco->getCep());
            $stm->bindValue("id_usuario", $endereco->getIdUsuario());
            $stm->execute();
            return $endereco;
        }
     
        private function mapEnderecos($result){
            $enderecos = array();
            foreach($enderecos as $result){
                $endereco = new Endereco();
                $endereco->setId($result['id']);
                $endereco->setNome($result['nome']);
                $endereco->setRua($result['rua']);
                $endereco->setCidade($result['cidade']);
                $endereco->setEstado($result['estado']);
                $endereco->setCep($result['cep']);  
                $endereco->setIdUsuario($result['id_usuario']);
                array_push($enderecos, $endereco);
            }
            return $enderecos;
        }
    }
?>