<?php
require_once(__DIR__ . "/../model/Trocas.php");
require_once(__DIR__ . "/../connection/Connection.php");

class TrocasDAO{
    private $conexao;

    public function __construct() {
        $this->conexao = Connection::getConn();
    }
    public function listByIdUsuario($idUser){
        $sql = 'SELECT * FROM troca WHERE  usuarios_id_oferta = :idUser || usuarios_id_solicitador =:idUser';
        $stm = $this->conexao->prepare($sql);
        $stm->bindValue('idUser', $idUser);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapTrocas($result);
    }
   
    public function listById($id){
        $sql = 'SELECT * FROM troca WHERE id=:id';
        $stm = $this->conexao->prepare($sql);
        $stm->bindValue('id', $id);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->mapTrocas($result);
    }
    public function insertTroca(Trocas $trocas){
        $sql ='INSERT INTO `troca` 
        (`anuncios_id_oferta`,
        `usuarios_id_oferta`,
        `anuncios_id_solicitador`,
        `usuarios_id_solicitador`,
        `data_troca`,
        `status`)
        VALUES
        (:anuncios_id_oferta,
        :usuarios_id_oferta,
        :anuncios_id_solicitador,
        :usuarios_id_solicitador,
        :data_troca,
        :status
        )';
        $stm =$this->conexao->prepare($sql);
        $stm->bindValue('anuncios_id_oferta',$trocas->getAnunciosIdOferta());
        $stm->bindValue('usuarios_id_oferta',$trocas->getUsuariosIdOferta());
        $stm->bindValue('anuncios_id_solicitador',$trocas->getAnunciosIdSolicitador());
        $stm->bindValue('usuarios_id_solicitador',$trocas->getUsuariosIdSolicitador());
        $stm->bindValue('data_troca',$trocas->getDataTroca());
        $stm->bindValue('status',$trocas->getStatus());
        $stm->execute();    
    }
    public function updateTroca(trocas $trocas){
        $sql ='UPDATE trocas SET
        anuncios_id_oferta =:anuncios_id_oferta,
        usuarios_id_oferta =:usuarios_id_oferta,
        anuncios_id_solicitador =:anuncios_id_solicitador,
        usuarios_id_solicitador=:usuarios_id_solicitador,
        data_troca =:data_troca,
        status=:status
        WHERE id=:id';
        $stm =$this->conexao->prepare($sql);
        $stm->bindValue('id',$trocas->getId());
        $stm->bindValue('anuncios_id_oferta',$trocas->getAnunciosIdOferta());
        $stm->bindValue('usuarios_id_oferta',$trocas->getUsuariosIdOferta());
        $stm->bindValue('anuncios_id_solicitador',$trocas->getAnunciosIdSolicitador());
        $stm->bindValue('usuarios_id_solicitador',$trocas->getUsuariosIdSolicitador());
        $stm->bindValue('data_troca',$trocas->getDataTroca());
        $stm->bindValue('status',$trocas->getStatus());
        $stm->execute();    
    }
    public function deleteTrocar(int $id){
        $sql = 'DELETE FROM troca WHERE id = :id';
        $stm = $this->conexao->prepare($sql);
        $stm->bindValue('id',$id);
        $stm->execute();
    }
    private function mapTrocas($result): array {
        $trocas = array();
        foreach($result as $row){
            $troca = new Trocas();
            $troca->setId($row['id']);
            $troca->setAnunciosIdOferta($row['anuncios_id_oferta']);
            $troca->setUsuariosIdOferta($row['usuarios_id_oferta']);
            $troca->setAnunciosIdSolicitador($row['anuncios_id_solicitador']);
            $troca->setUsuariosIdSolicitador($row['usuarios_id_solicitador']);
            $troca->setDataTroca($row['data_troca']);
            $troca->setSecCode($row['sec_code']);
            $troca->setStatus($row['status']);
            array_push($trocas, $troca);
        }
        return $trocas;
    }
    
}