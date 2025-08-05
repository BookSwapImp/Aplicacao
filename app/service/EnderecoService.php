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
  
    // Valida os campos obrigatórios de um endereço
    public function validarCampos(?string $rua, ?string $cidade, ?string $cep, ?string $estado) {
        $arrayMsg = [];
       
        if (!$rua) {
            array_push($arrayMsg, "O campo [Rua] é obrigatório.");
        }   
        
        if (!$cidade) {
            array_push($arrayMsg, "O campo [Cidade] é obrigatório.");
        }
        
        if (!$cep) {
            array_push($arrayMsg, "O campo [CEP] é obrigatório.");
        }
        // Validação de CEP brasileiro
        else {
            $erros = $this->validarCepBrasileiro($cep);
            if (!empty($erros)) {
                $arrayMsg = array_merge($arrayMsg, $erros);
            }
        }
        
        if (!$estado) {
            array_push($arrayMsg, "O campo [Estado] é obrigatório.");
        }
        // Validação de estado brasileiro
        else {
            $estadosValidos = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];
            if (!in_array($estado, $estadosValidos)) {
                array_push($arrayMsg, "Estado inválido.");
            }
        }
         
        return $arrayMsg;    
    }
    
    // Método auxiliar para validar CEP brasileiro
    private function validarCepBrasileiro(string $cep): array {
        $erros = [];
        
        // Remove todos os caracteres não numéricos
        $cepLimpo = preg_replace('/[^0-9]/', '', $cep);
        
        // Verifica se tem 8 dígitos
        if (strlen($cepLimpo) != 8) {
            $erros[] = "O CEP deve ter 8 dígitos.";
            return $erros;
        }
        
        // Verifica se não são todos os mesmos números
        if (preg_match('/(\d)\1{7}/', $cepLimpo)) {
            $erros[] = "CEP inválido.";
        }
        
        return $erros;
    }
    
    // Método para formatar CEP
    public function formatarCep(string $cep): string {
        $cepLimpo = preg_replace('/[^0-9]/', '', $cep);
        return substr($cepLimpo, 0, 5) . '-' . substr($cepLimpo, 5, 3);
    }
}

