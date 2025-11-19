<?php
# Nome do arquivo: EnderecoService.php
# Objetivo: Classe de serviço para validação de endereços

require_once(__DIR__ . "/../model/Endereco.php");
require_once(__DIR__ . "/../dao/EnderecoDAO.php");

class EnderecoService {
    private $endereco;
    private $enderecoDAO;

    function __construct() {
        $this->endereco = new Endereco ();
        $this->enderecoDAO = new EnderecoDAO();
    }

    /**
     * Valida os campos obrigatórios de um endereço
     */
    public function validarCampos(Endereco $end) {
        $arrayMsg = [];
        if (empty($end->getRua()))
            array_push($arrayMsg, "O campo [Rua] é obrigatório.");
        if (empty($end->getCidade()))
            array_push($arrayMsg, "O campo [Cidade] é obrigatório.");
        if (empty($end->getCep()))
            array_push($arrayMsg, "O campo [CEP] é obrigatório.");
        elseif(!preg_match('/^\d{8}$/', $end->getCep()))
            array_push($arrayMsg, "O campo [CEP] deve conter apenas 8 dígitos numéricos.");
        if (empty($end->getEstado()))
            array_push($arrayMsg, "O campo [Estado] é obrigatório.");
        if (empty($end->getNumb()))
            array_push($arrayMsg, "O campo [Numero] é obrigatório.");
        elseif($end->getNumb() <= 0 || !is_numeric($end->getNumb()))
            array_push($arrayMsg, "O campo [Numero] deve ser um número válido.");
        if(empty($end->getMain()))
            array_push($arrayMsg, "Selecione se ele normal, ou seu principal endereço");
        return $arrayMsg;
    }
    public function ValidarMain(Endereco $end){
        $arrayMsg = [];
        $enderecoExist = $this->enderecoDAO->findEnderecosExist($end->getUsuariosId());
        if (empty($end))
            array_push($arrayMsg, "Selecione se ele nomal, ou seu principal endereço");
        elseif($enderecoExist === true){
            $enderecoMainExist = $this->enderecoDAO->findEnderecosSetMainExist($end->getUsuariosId());
            if($enderecoMainExist === true & $end->getMain() === 'main'):
                return true;
            elseif($enderecoMainExist === null):
                return null;
            else:
                array_push($arrayMsg, "erro no sistema validaMain");
            endif;
        }
        else {
            
        }
        return $arrayMsg;
    }

}