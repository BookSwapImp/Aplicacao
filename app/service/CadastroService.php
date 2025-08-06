<?php
# Nome do arquivo: CadastroService.php
# Objetivo: Classe de serviço para cadastro e login de usuários

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");


class CadastroService {
        private $usuarioDAO;
        function __construct() {
        $this->usuarioDAO = new UsuarioDAO;
    }
  
    // Valida os campos obrigatórios de um usuário
    public function validarCampos(?string $nome, ?string $email, ?string $senha,?string $confSenha,?string $cpf, ?string $telefone) {
        $arrayMsg = [];
       
        if (!$nome) {
            array_push($arrayMsg, "O campo [Nome] é obrigatório.");
        }   
        
        if (!$email) {
            array_push($arrayMsg, "O campo [Email] é obrigatório.");
        }  
        //verifica o formato do email
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($arrayMsg, "O campo [Email] está em formato inválido.");
        }
        else {  // verifica se o email já existe no banco
            $usuarioExistente = $this->usuarioDAO->findByEmail($email);
            if ($usuarioExistente !== null) {
                array_push($arrayMsg, "O Email já está cadastrado no sistema.");
            }
        }
        
        if (!$senha) {
            array_push($arrayMsg, "O campo [Senha] é obrigatório.");
        }
        elseif(!$confSenha){
            array_push($arrayMsg, "Você deve verificar sua senha! No campo [Verificar senha].");            
        }
        elseif($senha !== $confSenha){
            array_push($arrayMsg, "O campo [Verificar senha] deve estar igual a senha");
        }
        
        // Validação de telefone brasileiro
        if ($telefone) {
            $erros = $this->validarTelefoneBrasileiro($telefone);
            if (!empty($erros)) {
                $arrayMsg = array_merge($arrayMsg, $erros);
            } else {
                // Verifica se o telefone já está cadastrado
                $telefoneLimpo = preg_replace('/[^0-9]/', '', $telefone);
                $telefoneInt = (int)$telefoneLimpo;
                if (!$this->usuarioDAO->findByTelefone($telefoneInt)) {
                    array_push($arrayMsg, "Este telefone já está cadastrado no sistema.");
                }
            }
        }

        if (!$cpf) {
            array_push($arrayMsg, "O campo [CPF] é obrigatório.");
        }
        //Validar Cpf
        else {
            $cpf = preg_replace('/[^0-9]/', '', $cpf);

            if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
                array_push($arrayMsg, "O CPF é inválido.");
            } else {
                for ($t = 9; $t < 11; $t++) {
                    $d = 0;
                    for ($c = 0; $c < $t; $c++) {
                        $d += $cpf[$c] * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cpf[$c] != $d) {
                        array_push($arrayMsg, "O CPF é inválido.");
                        break;
                    }
                }
                
                // Verifica se o CPF já está cadastrado
                if (strlen($cpf) == 11) {
                    $cpfInt = (int)$cpf;
                    if (!$this->usuarioDAO->findByCpf($cpfInt)) {
                        array_push($arrayMsg, "Este CPF já está cadastrado no sistema.");
                    }
                }
            }
        }
         
        return $arrayMsg;    
    }
    
    // Método auxiliar para validar telefone brasileiro
    private function validarTelefoneBrasileiro(string $telefone): array {
        $erros = [];
        
        // Remove todos os caracteres não numéricos
        $telefoneLimpo = preg_replace('/[^0-9]/', '', $telefone);
        
        // Verifica se tem 10 ou 11 dígitos (com DDD)
        if (strlen($telefoneLimpo) < 10 || strlen($telefoneLimpo) > 11) {
            $erros[] = "O telefone deve ter 10 ou 11 dígitos (com DDD).";
            return $erros;
        }
        
        // Verifica DDD válido (11 a 99)
        $ddd = substr($telefoneLimpo, 0, 2);
        if ($ddd < 11 || $ddd > 99) {
            $erros[] = "DDD inválido.";
            return $erros;
        }
        
        // Verifica formato para celular (11 dígitos, 9º dígito = 9)
        if (strlen($telefoneLimpo) == 11) {
            if ($telefoneLimpo[2] != '9') {
                $erros[] = "Celular deve começar com 9 após o DDD.";
            }
        }
        // Verifica formato para fixo (10 dígitos)
        elseif (strlen($telefoneLimpo) == 10) {
            if (!in_array($telefoneLimpo[2], ['2','3','4','5','6','7','8','9'])) {
                $erros[] = "Telefone fixo deve ter formato válido.";
            }
        }
        
        return $erros;
    }
    
}