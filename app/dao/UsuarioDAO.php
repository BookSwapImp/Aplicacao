<?php
#Nome do arquivo: UsuarioDAO.php
#Objetivo: classe DAO para o model de Usuario

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u ORDER BY u.nome";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }
    
   

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
               " WHERE u.id = ?";
        $stm = $conn->prepare($sql);    
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
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
               " WHERE BINARY u.email = ?";
        $stm = $conn->prepare($sql);    
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
        $conn = Connection::getConn();
        $sql = "SELECT * FROM usuarios u".
            "WHERE BINARY u.telefone = :telefone";
            $stm = $conn->prepare($sql);
            $stm->execute([$telefone]);
            $result = $stm->fetchAll();
            $usuarios = $this->mapUsuarios($result);
            if(count($usuarios) == 1){
                return false;
            }
            elseif(count($usuarios) == 0)
                return true;

            die("UsuarioDAO.findByTelefone()" . 
            " - Erro.");
    }
      /*/public function findByEmail(string $email){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM usuarios WHERE BINARY email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dados = $stmt->fetch();
            $usuario = new Usuario();
            $usuario->setId($dados['id']);
            $usuario->setNome($dados['nome']);
            $usuario->setEmail($dados['email']);
            return $usuario;
        }

        return null;
        }*/
    public function findByCpf(int $cpf){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM usuarios u".
            "WHERE BINARY u.cpf = ?";
            $stm = $conn->prepare($sql);
            $stm->execute([$cpf]);
            $result = $stm->fetchAll();
            $usuarios = $this->mapUsuarios($result);
            if(count($usuarios) == 1){
                return false;
            }
            elseif(count($usuarios) == 0)
                return true;

            die("UsuarioDAO.findByCpf()" . 
            " - Erro.");
    }

    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $conn = Connection::getConn();

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

        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("cpf",$usuario->getCpf());
        $stm->bindValue("senha", $senhaCripto);
        $stm->bindValue("tipo", $usuario->getTipo());
        $stm->bindValue("status", $usuario->getStatus());
        
        if (empty($usuario->getTelefone())) {
             $stm->bindValue("telefone", 'null()');
        }
        else{
             $stm->bindValue("telefone", $usuario->getTelefone());
        }

        $stm->execute();
    }
  

    //Método para atualizar um Usuario
    public function update(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET nome = :nome, email = :email," . 
               " senha = :senha ".   
               " WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("Email", $usuario->getEmail());
        $stm->bindValue("senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM usuarios WHERE id= :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

     //Método para alterar a foto de perfil de um usuário
    /* public function updateFotoPerfil(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET foto_perfil = ? WHERE id_usuario = ?";

        $stm = $conn->prepare($sql);
        $stm->execute(array($usuario->getFotoPerfil(), $usuario->getId()));
    } */ 

    //Método para retornar a quantidade de usuários salvos na base
    public function quantidadeUsuarios() {
        $conn = Connection::getConn();

        $sql = "SELECT COUNT(*) AS qtd_usuarios FROM usuarios";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["qtd_usuarios"];
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    private function mapUsuarios($result) {
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
           // $usuario->setFotoPerfil($reg['foto_perfil']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }
   

}