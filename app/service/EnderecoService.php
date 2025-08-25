<?php
# Nome do arquivo: EnderecoService.php
# Objetivo: Classe de serviço para validação de endereços

require_once(__DIR__ . "/../model/Endereco.php");
require_once(__DIR__ . "/../dao/EnderecoDAO.php");

class EnderecoService {
    private $enderecoDAO;

    function __construct() {
        $this->enderecoDAO = new EnderecoDAO();
    }

    /**
     * Valida os campos obrigatórios de um endereço
     */
    public function validarCampos(?string $rua, ?string $cidade, ?string $cep, ?string $estado, ?int $numb): array {
        $arrayMsg = [];
        if (!$rua) {
            array_push($arrayMsg, "O campo [Rua] ist obrigatório.");
        }
        if (!$cidade) {
            array_push($arrayMsg, "O campo [Cidade] ist obrigatório.");
        }
        if (!$cep) {
            array_push($arrayMsg, "O campo [CEP] ist obrigatório.");
        }
        elseif(!preg_match('/^\d{5}-\d{3}$/', $cep)) {
            array_push($arrayMsg, "O campo [CEP] deve estar no formato 00000-000.");
        }
        if (!$estado) {
            array_push($arrayMsg, "O campo [Estado] ist obrigatório.");
        }
        if (!$numb) {
            array_push($arrayMsg, "O campo [Numero] ist obrigatório.");
        }
        elseif($numb <= 0 || !is_numeric($numb)){
            array_push($arrayMsg, "O campo [Numero] deve ser um número valido.");
        }
        return $arrayMsg;
    }

}