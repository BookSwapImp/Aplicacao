<?php

require_once(__DIR__ . "/../model/Denuncia.php");
require_once(__DIR__ . "/../model/Anuncio.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../dao/AnuncioDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");



class DenunciaDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getConn();
    }
    public function createDenuncia(Denuncia $denuncia): bool
    {
        $sql = "INSERT INTO denuncia (descricao, anuncios_id, usuarios_reu_id, usuario_acusador_id) 
                VALUES (:descricao, :anuncios_id, :usuarios_reu_id, :usuario_acusador_id)";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":descricao", $denuncia->getDescricao());
        $stm->bindValue(":anuncios_id", $denuncia->getAnuncio() ? $denuncia->getAnuncio()->getId() : null, PDO::PARAM_INT);
        $stm->bindValue(":usuarios_reu_id", $denuncia->getUsuarioReu() ? $denuncia->getUsuarioReu()->getId() : null, PDO::PARAM_INT);
        $stm->bindValue(":usuario_acusador_id", $denuncia->getUsuarioAcusador() ? $denuncia->getUsuarioAcusador()->getId() : null, PDO::PARAM_INT);

        return $stm->execute();
    }
    public function getAllDenuncias(): array
    {
        try {
            $sql = "SELECT * FROM denuncia";

            $stm = $this->conn->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            $denuncias = $this->mapDenuncias($result);

            return $denuncias;

        } catch (Exception $e) {
            throw new Exception("Erro ao buscar denúncias: " . $e->getMessage());
        }
    }
    public function deleteDenuncia(int $id): bool
    {
        $sql = "DELETE FROM denuncia WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        return $stm->execute();
    }
    public function deleteDenunciasByUsuarioId(int $usuarioId): bool
    {
        $sql = "DELETE FROM denuncia WHERE usuarios_reu_id = :usuarioId";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":usuarioId", $usuarioId, PDO::PARAM_INT);
        return $stm->execute();
    }
    public function deleteDenunciasByAnuncioId(int $anuncioId): bool
    {
        $sql = "DELETE FROM denuncia WHERE anuncios_id = :anuncioId";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":anuncioId", $anuncioId, PDO::PARAM_INT);
        return $stm->execute();
    }
    public function mapDenuncias(array $result): array
    {
        $anuncioDAO = new AnuncioDAO();
        $usuarioDAO = new UsuarioDAO();

        $denuncias = array();
        foreach ($result as $reg) {
            $denuncia = new Denuncia();
            $anuncio = $anuncioDAO->findAnuncioByAnuncioId($reg['anuncios_id']);
            $usuarioReu = $usuarioDAO->findById($reg['usuarios_reu_id']);
            $usuarioAcusador = $usuarioDAO->findById($reg['usuario_acusador_id']);

            $denuncia->setId($reg['id']);

            $denuncia->setAnuncio($anuncio);
            
            $denuncia->setUsuarioReu( $usuarioReu);
            $denuncia->setUsuarioAcusador($usuarioAcusador);
            $denuncia->setDescricao($reg['descricao']);
            // Map Anuncio and Usuario objects if necessary
            array_push($denuncias, $denuncia);
        }
        return $denuncias;
    }
    
}
