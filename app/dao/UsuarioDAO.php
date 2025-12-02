<?php
#Nome do arquivo: UsuarioDAO.php
#Objetivo: classe DAO para o model de Usuario

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO {
    private $conn;
    public function __construct(){
        $this->conn = Connection::getConn();
       
    }
   
    //Método para listar os usuaários a partir da base de dados
    public function list( int $limit = null) {

        if(!is_null($limit)) {
            $sql = "SELECT * FROM usuarios u ORDER BY u.nome LIMIT $limit";
        } else {
            $sql = "SELECT * FROM usuarios u ORDER BY u.nome";
        }
     
        $stm = $this->conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }
    
   

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
    
        $sql = "SELECT * FROM usuarios u" .
               " WHERE u.id = ?";
        $stm = $this->conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }


    //Método para buscar um usuário por seu login e senha
    public function findByLoginSenha(string $login, string $senha) {
      $sql = "SELECT * FROM usuarios u" .
               " WHERE BINARY u.email = ?";
        $stm = $this->conn->prepare($sql);    
        $stm->execute([$login]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1) {
            //Tratamento para senha criptografada
            if(password_verify($senha, $usuarios[0]->getSenha()))
                return $usuarios[0];
            else
                return null;
        } elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByLoginSenha()" . 
            " - Erro: mais de um usuário encontrado.");
    }
    public function findByTelefone(int $telefone){
        $sql = "SELECT * FROM usuarios u " .
            "WHERE BINARY u.telefone = ?";
        $stm = $this->conn->prepare($sql);
        $stm->execute([$telefone]);
        $result = $stm->fetchAll();
        $usuarios = $this->mapUsuarios($result);
        
        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByTelefone()" . 
            " - Erro: mais de um usuário encontrado.");
    }
    public function findByEmail(string $email){
      $sql = "SELECT * FROM usuarios u " .
            "WHERE BINARY u.email = ?";
        $stm = $this->conn->prepare($sql);
        $stm->execute(params: [$email]);
        $result = $stm->fetchAll();
        $usuarios = $this->mapUsuarios($result);
        
        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByEmail()" . 
            " - Erro: mais de um usuário encontrado.");
    }
    public function findByCpf(int $cpf){
       $sql = "SELECT * FROM usuarios u " .
            "WHERE BINARY u.cpf = ?";
        $stm = $this->conn->prepare($sql);
        $stm->execute([$cpf]);
        $result = $stm->fetchAll();
        $usuarios = $this->mapUsuarios($result);
        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByCpf()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $sql = "INSERT INTO `usuarios`( `nome`, `email`,`senha`, `telefone`, `cpf`, `tipo`, `status`) 
                                    VALUES (
                                    :nome, 
                                    :email,
                                    :senha, 
                                    :telefone, 
                                    :cpf, 
                                    :tipo, 
                                    :status
                                    );";
        
        $senhaCripto = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        $stm = $this->conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("cpf",$usuario->getCpf());
        $stm->bindValue("senha", $senhaCripto);
        $stm->bindValue("tipo", $usuario->getTipo());
        $stm->bindValue("status", $usuario->getStatus());
        
        if (empty($usuario->getTelefone())) {
             $stm->bindValue("telefone", null);
        }
        else{
             $stm->bindValue("telefone", $usuario->getTelefone());
        }

        $stm->execute();
    }
  

    //Método para atualizar um Usuario
    public function update(Usuario $usuario) {

        $sql = "UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, foto_de_perfil = :foto_de_perfil, status=:status" .
               " WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("cpf", $usuario->getCpf());
        $stm->bindValue("telefone", $usuario->getTelefone());
        $stm->bindValue("id", $usuario->getId());
        $stm->bindValue('status',$usuario->getStatus());
        $stm->bindValue("foto_de_perfil", $usuario->getFotoDePerfil());
        return $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
     
        $sql = "DELETE FROM usuarios WHERE id= :id";
        
        $stm = $this->conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

     //Método para alterar a foto de perfil de um usuário
     public function updateFotoPerfil(Usuario $usuario) {
     
        $sql = "UPDATE usuarios SET foto_de_perfil = ? WHERE id= ?";

        $stm = $this->conn->prepare($sql);
        $stm->execute(array($usuario->getFotoDePerfil(), $usuario->getId()));
    }  

    //Método para retornar a quantidade de usuários salvos na base
    public function quantidadeUsuarios() {

        $sql = "SELECT COUNT(*) AS qtd_usuarios FROM usuarios";

        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["qtd_usuarios"];
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    private function mapUsuarios($result):array {
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
   

}
