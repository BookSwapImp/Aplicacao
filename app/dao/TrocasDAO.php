<?php
require_once(__DIR__ . "/../model/Trocas.php");
require_once(__DIR__ . "/../model/Anuncio.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../connection/Connection.php");

class TrocasDAO{
    private $conexao;
    private $anunciosOfertaIdObj;
    private $anunciosSolicitadorIdObj;
    private $usuariosOfertaIdObj;
    private $usuariosSolicitadorIdObj;
    

    public function __construct() {
        $this->conexao = Connection::getConn();
    }
    public function findByIdTroca(Int $idTroca){
        $sql= 'SELECT * FROM troca WHERE id = :id ';
        $stm=$this->conexao->prepare($sql);
        $stm->bindValue('id',$idTroca);
        $stm->execute();
        $result = $stm->fetchAll();
       return $this->mapTrocas($result);
    }
    public function findTrocasExistByIdAnu(Int $idOferta ,Int $idSolict){
        $sql = 'SELECT * FROM troca WHERE anuncios_id_oferta = :idOferta AND anuncios_id_solicitador = :idSolict OR anuncios_id_oferta = :idSolict AND anuncios_id_solicitador = :idOferta ';
        $stm = $this->conexao->prepare($sql);
        $stm->bindValue(':idOferta', $idOferta);
        $stm->bindValue(':idSolict', $idSolict);
        $stm->execute();
        $result = $stm->fetchAll();
        if($result)
            return true;
        return false;
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
        `sec_code`,
        `data_troca`,
        `status`)
        VALUES
        (:anuncios_id_oferta,
        :usuarios_id_oferta,
        :anuncios_id_solicitador,
        :usuarios_id_solicitador,
        :sec_code,
        :data_troca,
        :status
        )';
        $stm =$this->conexao->prepare($sql);
        // Trocas model stores related Anuncios and Usuario objects. Extract primitive ids/strings before binding.


        // data_troca may be a DateTime object; convert to string if necessary
        $dataTroca = $trocas->getDataTroca();
        if ($dataTroca instanceof DateTime) {
            $dataTrocaStr = $dataTroca->format('Y-m-d H:i:s');
        } else {
            $dataTrocaStr = $dataTroca; // could be null or already a string
        }
    // Ensure we bind primitive integers: extract id from object or cast numeric values (inline)
    // simpler: prefer numeric values; if not numeric and object present use getId()
    // simple extraction: prefer numeric value, otherwise try getId(); suppress errors if not object
    $anunciosOfertaId = is_numeric($trocas->getAnunciosIdOferta()) ? (int)$trocas->getAnunciosIdOferta() : (int)@ $trocas->getAnunciosIdOferta()->getId();
    $anunciosSolicitadorId = is_numeric($trocas->getAnunciosIdSolicitador()) ? (int)$trocas->getAnunciosIdSolicitador() : (int)@ $trocas->getAnunciosIdSolicitador()->getId();
    $usuariosOfertaId = is_numeric($trocas->getUsuariosIdOferta()) ? (int)$trocas->getUsuariosIdOferta() : (int)@ $trocas->getUsuariosIdOferta()->getId();
    $usuariosSolicitadorId = is_numeric($trocas->getUsuariosIdSolicitador()) ? (int)$trocas->getUsuariosIdSolicitador() : (int)@ $trocas->getUsuariosIdSolicitador()->getId();

        // concise binds using ternary to choose type
        $stm->bindValue('anuncios_id_oferta', $anunciosOfertaId, $anunciosOfertaId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stm->bindValue('usuarios_id_oferta', $usuariosOfertaId, $usuariosOfertaId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stm->bindValue('anuncios_id_solicitador', $anunciosSolicitadorId, $anunciosSolicitadorId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stm->bindValue('usuarios_id_solicitador', $usuariosSolicitadorId, $usuariosSolicitadorId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stm->bindValue('sec_code',$trocas->getSecCode(), PDO::PARAM_STR);
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
    // Extract primitive ids like in insert (inline)
    // simple extraction: prefer numeric value, otherwise try getId(); suppress errors if not object
    $anunciosOfertaId = is_numeric($trocas->getAnunciosIdOferta()) ? (int)$trocas->getAnunciosIdOferta() : (int)@ $trocas->getAnunciosIdOferta()->getId();
    $anunciosSolicitadorId = is_numeric($trocas->getAnunciosIdSolicitador()) ? (int)$trocas->getAnunciosIdSolicitador() : (int)@ $trocas->getAnunciosIdSolicitador()->getId();
    $usuariosOfertaId = is_numeric($trocas->getUsuariosIdOferta()) ? (int)$trocas->getUsuariosIdOferta() : (int)@ $trocas->getUsuariosIdOferta()->getId();
    $usuariosSolicitadorId = is_numeric($trocas->getUsuariosIdSolicitador()) ? (int)$trocas->getUsuariosIdSolicitador() : (int)@ $trocas->getUsuariosIdSolicitador()->getId();

        $dataTroca = $trocas->getDataTroca();
        $dataTrocaStr = $dataTroca instanceof DateTime ? $dataTroca->format('Y-m-d H:i:s') : $dataTroca;

        $stm->bindValue('anuncios_id_oferta',$anunciosOfertaId, $anunciosOfertaId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stm->bindValue('usuarios_id_oferta',$usuariosOfertaId, $usuariosOfertaId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stm->bindValue('anuncios_id_solicitador',$anunciosSolicitadorId, $anunciosSolicitadorId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stm->bindValue('usuarios_id_solicitador',$usuariosSolicitadorId, $usuariosSolicitadorId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stm->bindValue('data_troca',$dataTrocaStr, PDO::PARAM_STR);
        $stm->bindValue('status',$trocas->getStatus(), PDO::PARAM_STR);
        $stm->execute();    
    }
        public function deleteTroca(int $id){
        $sql = 'DELETE FROM troca WHERE id = :id';
        $stm = $this->conexao->prepare($sql);
        $stm->bindValue('id',$id);
        $stm->execute();
    }
    public function deleteTrocaByIdAn(int $id){
          $sql = 'DELETE FROM troca WHERE anuncios_id_solicitador = :id || anuncios_id_oferta = :id' ;
          $stm = $this->conexao->prepare($sql);
          $stm->bindValue('id', $id);
          $stm->execute();
    }
  
    private function mapTrocas($result): array {
        $trocas = array();
        foreach($result as $row){
            $troca = new Trocas();
            $usuariosdOferta = new Usuario();
            $usuariosdSolicitador = new Usuario();
            $anunciosOferta = new Anuncio();
            $anunciosSolicitador = new Anuncio();
            $date = new DateTime($row['data_troca']);
            $anunciosOferta->setId($row['anuncios_id_oferta']);
            $anunciosSolicitador->setId($row['anuncios_id_solicitador']);
            $usuariosdOferta->setId($row['usuarios_id_oferta']);
            $usuariosdSolicitador->setId($row['usuarios_id_solicitador']);
            $troca->setId($row['id']);
            // Restore original mapping: set raw values (ids/strings) on the Trocas object
            $troca->setAnunciosIdOferta($anunciosOferta);
            $troca->setUsuariosIdOferta($usuariosdOferta);
            $troca->setAnunciosIdSolicitador($anunciosSolicitador);
            $troca->setUsuariosIdSolicitador($usuariosdSolicitador);
            $troca->setDataTroca($date);
            $troca->setSecCode($row['sec_code']);
            $troca->setStatus($row['status']);
            array_push($trocas, $troca);
        }
        return $trocas;
    }
    
}