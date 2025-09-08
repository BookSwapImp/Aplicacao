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
            array_push($trocas, $troca);
        }
        return $trocas;
    }
    
}
$td = new TrocasDAO();
$result = $td->listByIdUsuario(1);