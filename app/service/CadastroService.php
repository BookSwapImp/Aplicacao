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

            }  //verifica o formato  do email
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($arrayMsg, "O campo [Email] está em formato inválido.");
                }
               /* else {  // verifica se o email já existe no banco
                    $usuarioExistente = $this->usuarioDAO->findByEmail($email);
                    if ($usuarioExistente !== null) {
                        array_push($arrayMsg, "O Email já está cadastrado no sistema.");
                    }*/
    if (!$senha) {
            array_push($arrayMsg, "O campo [Senha] é obrigatório.");
            }
            elseif(!$confSenha){
                    array_push($arrayMsg, "Você deve verificar sua senha! No campo [Verificar senha].");            
                }
                elseif($senha!==$confSenha){
                    array_push($arrayMsg, "O campo [Verificar senha] deve estar igual a senha");
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
            }
           
        }
         return $arrayMsg;    
    }
    
}
