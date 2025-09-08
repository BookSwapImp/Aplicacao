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
    public function findMainEnderecosExist(int $usuarioId) {
        $sql = "SELECT * FROM enderecos WHERE usuarios_id = :usuarios_id AND main = 'main'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':usuarios_id', $usuarioId);
        $stmt->execute();
        
        $result = $stmt->fetchAll();
        if ($result) {
            $enderecos = $this->mapEnderecos($result);
            return $enderecos[0]; // Retorna o primeiro endereço principal encontrado
        }
        return null; // Retorna null se nenhum endereço principal for encontrado
    }
    public function unsetMainEnderecos(int $usuarioId){
        $sql = "UPDATE enderecos SET main = 'normal' WHERE main ='main' AND usuarios_id = :usuarios_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':usuarios_id', $usuarioId);
        return $stmt->execute();
    }
    public function updateEndereco(Endereco $endereco){
        $sql = "UPDATE enderecos 
                SET nome = :nome, 
                    rua = :rua, 
                    cidade = :cidade, 
                    estado = :estado, 
                    cep = :cep, 
                    numero = :numero,
                    main = :main
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome', $endereco->getNome());
        $stmt->bindValue(':rua', $endereco->getRua());
        $stmt->bindValue(':cidade', $endereco->getCidade());
        $stmt->bindValue(':estado', $endereco->getEstado());
        $stmt->bindValue(':cep', $endereco->getCep());
        $stmt->bindValue(':numero', $endereco->getNumb());
        $stmt->bindValue(':main', $endereco->getMain());
        $stmt->bindValue(':id', $endereco->getId());
        
        return $stmt->execute();
    }

    /**
     * Insere um novo endereço no banco de dados
     */
    public function insertEndereco(Endereco $endereco){
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
    public function mapEnderecos(array $result){
        $enderecos =array();
        foreach ($result as $reg) {    
            $endereco = new Endereco();
            $endereco->setId($reg['id']);
            $endereco->setNome($reg['nome']);
            $endereco->setUsuariosId($reg['usuarios_id']);
            $endereco->setRua($reg['rua']);
            $endereco->setCidade($reg['cidade']);
            $endereco->setEstado($reg['estado']);
            $endereco->setCep($reg['cep']);
            $endereco->setNumb($reg['numero']);
            $endereco->setMain($reg['main']);
            $enderecos[] = $endereco;
        }
        return $enderecos;
    }
    public function deleteEndereco(int $id){
        $sql = "DELETE FROM enderecos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    /**
     * Busca um endereço por ID
     */
    public function findById(int $id) {
        $sql = "SELECT * FROM enderecos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $result = $stmt->fetchAll();
        if ($result) {
            $enderecos = $this->mapEnderecos($result);
            return $enderecos[0]; // Retorna o endereço encontrado
        }
        return null; // Retorna null se nenhum endereço for encontrado
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
$dao = new EnderecoDAO();
echo $dao->findMainEnderecosExist(1);