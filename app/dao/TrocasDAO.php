<?php
require_once(__DIR__ . "/../model/Trocas.php");
require_once(__DIR__ . "/../model/Anuncios.php");
require_once(__DIR__ . "/../model/Usuario.php");
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
        // Trocas model stores related Anuncios and Usuario objects. Extract primitive ids/strings before binding.
        $anunciosOferta = $trocas->getAnunciosIdOferta();
        $anunciosSolicitador = $trocas->getAnunciosIdSolicitador();
        $usuariosOferta = $trocas->getUsuariosIdOferta();
        $usuariosSolicitador = $trocas->getUsuariosIdSolicitador();

        $anunciosOfertaId = $anunciosOferta->getId();
        $anunciosSolicitadorId = $anunciosSolicitador->getId();
        $usuariosOfertaId =  $usuariosOferta->getId();         
        $usuariosSolicitadorId = $usuariosSolicitador->getId();

        // data_troca may be a DateTime object; convert to string if necessary
        $dataTroca = $trocas->getDataTroca();
        if ($dataTroca instanceof DateTime) {
            $dataTrocaStr = $dataTroca->format('Y-m-d H:i:s');
        } else {
            $dataTrocaStr = $dataTroca; // could be null or already a string
        }

        $stm->bindValue('anuncios_id_oferta',   $anunciosOfertaId, PDO::PARAM_INT);
        $stm->bindValue('usuarios_id_oferta',    $usuariosOfertaId, PDO::PARAM_INT);
        $stm->bindValue('anuncios_id_solicitador',$anunciosSolicitadorId, PDO::PARAM_INT);
        $stm->bindValue('usuarios_id_solicitador',$usuariosSolicitadorId, PDO::PARAM_INT);
        $stm->bindValue('data_troca',$dataTrocaStr, PDO::PARAM_STR);
        $stm->bindValue('status',$trocas->getStatus(), PDO::PARAM_STR);
        $stm->execute();    
    }
    public function updateTroca(trocas $trocas){
        $sql ='UPDATE troca SET
        anuncios_id_oferta =:anuncios_id_oferta,
        usuarios_id_oferta =:usuarios_id_oferta,
        anuncios_id_solicitador =:anuncios_id_solicitador,
        usuarios_id_solicitador=:usuarios_id_solicitador,
        data_troca =:data_troca,
        status=:status
        WHERE id=:id';
        $stm =$this->conexao->prepare($sql);
        $stm->bindValue('id',$trocas->getId());
        // Extract primitive ids like in insert
        $anunciosOfertaId = $trocas->getAnunciosIdOferta();
        $anunciosSolicitadorId = $trocas->getAnunciosIdSolicitador();
        $usuariosOfertaId = $trocas->getUsuariosIdOferta();
        $usuariosSolicitadorId = $trocas->getUsuariosIdSolicitador();

        $dataTroca = $trocas->getDataTroca();
        $dataTrocaStr = $dataTroca instanceof DateTime ? $dataTroca->format('Y-m-d H:i:s') : $dataTroca;

        $stm->bindValue('anuncios_id_oferta',$anunciosOfertaId, PDO::PARAM_INT);
        $stm->bindValue('usuarios_id_oferta',$usuariosOfertaId, PDO::PARAM_INT);
        $stm->bindValue('anuncios_id_solicitador',$anunciosSolicitadorId, PDO::PARAM_INT);
        $stm->bindValue('usuarios_id_solicitador',$usuariosSolicitadorId, PDO::PARAM_INT);
        $stm->bindValue('data_troca',$dataTrocaStr, PDO::PARAM_STR);
        $stm->bindValue('status',$trocas->getStatus(), PDO::PARAM_STR);
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
            // Restore original mapping: set raw values (ids/strings) on the Trocas object
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