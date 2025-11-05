<?php

require_once(__DIR__ . "/../model/Denuncia.php");
require_once(__DIR__ . "/../model/Anuncio.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../connection/Connection.php");

class DenunciaDAO {
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getConn();
    }
    Public function createDenuncia(Denuncia $denuncia): bool {
        $sql = "INSERT INTO denuncia (descricao, anuncios_id, usuarios_reu_id, usuario_acusador_id) 
                VALUES (:descricao, :anuncios_id, :usuarios_reu_id, :usuario_acusador_id)";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":descricao", $denuncia->getDescricao());
        $stm->bindValue(":anuncios_id", $denuncia->getAnuncio() ? $denuncia->getAnuncio()->getId() : null, PDO::PARAM_INT);
        $stm->bindValue(":usuarios_reu_id", $denuncia->getUsuarioReu() ? $denuncia->getUsuarioReu()->getId() : null, PDO::PARAM_INT);
        $stm->bindValue(":usuario_acusador_id", $denuncia->getUsuarioAcusador() ? $denuncia->getUsuarioAcusador()->getId() : null, PDO::PARAM_INT);

        return $stm->execute();
    }
    public function getAllDenuncias(): array {
        $sql = "SELECT * FROM denuncia";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        $denuncias = $this->mapDenuncias($result);
        return $denuncias;
    }
    public function deleteDenuncia(int $id): bool
    {
        $sql = "DELETE FROM denuncia WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        return $stm->execute();
    }
    public function mapDenuncias(array $result): array
    {
        $denuncias = array();
        foreach ($result as $reg) {
            $denuncia = new Denuncia();
            $anuncio = new Anuncio();
            $usuarioReu = new Usuario();
            $usuarioAcusador = new Usuario();
            $denuncia->setId($reg['id']);
            $denuncia->setAnuncio($anuncio->setId($reg['anuncios_id']));
            $denuncia->setUsuarioReu($usuarioReu->setId($reg['usuarios_reu_id']));
            $denuncia->setUsuarioAcusador($usuarioAcusador->setId($reg['usuario_acusador_id']));
            $denuncia->setDescricao($reg['descricao']);
            // Map Anuncio and Usuario objects if necessary
            array_push($denuncias, $denuncia);
        }
        return $denuncias;
    }
}