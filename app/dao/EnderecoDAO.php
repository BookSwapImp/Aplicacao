<?php
# Nome do arquivo: EnderecoDAO.php
# Objetivo: Classe de acesso a dados para endereços

require_once(__DIR__ . "/../model/Endereco.php");
require_once(__DIR__ . "/../connection/Connection.php");

class EnderecoDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getConn();
    }
    public function findMainEnderecos (int $id){
        $sql = "SELECT * FROM enderecos WHERE id=:id AND main = 'main' ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $result =$stmt->fetchAll();
        return $this->mapEnderecos($result);
    }

    /**
     * Insere um novo endereço no banco de dados
     */
    public function insertEndereco(Endereco $endereco): bool {
        $sql = "INSERT INTO enderecos (nome, usuarios_id, rua, cidade, estado, cep, numero, main) 
                VALUES (:nome, 
                :usuarios_id, 
                :rua, 
                :cidade, 
                :estado, 
                :cep, 
                :numero, 
                :main)";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome', $endereco->getNome());
        $stmt->bindValue(':usuarios_id', $endereco->getUsuariosId());
        $stmt->bindValue(':rua', $endereco->getRua());
        $stmt->bindValue(':cidade', $endereco->getCidade());
        $stmt->bindValue(':estado', $endereco->getEstado());
        $stmt->bindValue(':cep', $endereco->getCep());
        $stmt->bindValue(':numero', $endereco->getNumb());
        $stmt->bindValue(':main', $endereco->getMain());
        
        return $stmt->execute();
    }
    public function mapEnderecos($result){
        $enderecos =array();
        foreach ($result as $row) {    
            $endereco = new Endereco();
            $endereco->setId($row['id']);
            $endereco->setNome($row['nome']);
            $endereco->setUsuariosId($row['usuarios_id']);
            $endereco->setRua($row['rua']);
            $endereco->setCidade($row['cidade']);
            $endereco->setEstado($row['estado']);
            $endereco->setCep($row['cep']);
            $endereco->setNumb($row['numero']);
            $endereco->setMain($row['main']);
            $enderecos = $endereco;
        }
        return $enderecos;
    }
    public function deleteEndereco(int $id){
        $sql = "DELETE FROM enderecos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);

        $result =$stmt->execute();
        return $this->mapEnderecos($result);
    }

    /**
     * Busca todos os endereços de um usuário
     */
    public function findByUsuarioId(int $usuarioId) {
        $sql = "SELECT * FROM enderecos WHERE usuarios_id = :usuarios_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':usuarios_id', $usuarioId);
        $stmt->execute();
        return $this->mapEnderecos($stmt->fetchAll());
    }
    
}