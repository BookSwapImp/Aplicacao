<?php
# Nome do arquivo: CadastroService.php
# Objetivo: Classe de serviço para cadastro e login de usuários

require_once(__DIR__ . "/../model/Usuario.php");

class CadastroService {

    // Valida os campos obrigatórios de um usuário
    public function validarCampos(?string $nome, ?string $email, ?string $senha,?string $confSenha,?string $cpf, ?int $telefone) {
        $arrayMsg = [];

        if (!$nome) {
            array_push($arrayMsg, "O campo [Nome] é obrigatório.");
        }
        if (!$email) {
            array_push($arrayMsg, "O campo [Email] é obrigatório.");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($arrayMsg, "O campo [Email] está em formato inválido.");
        }

        if (!$senha) {
            array_push($arrayMsg, "O campo [Senha] é obrigatório.");
         
        }
        elseif($senha!=$confSenha){
            array_push($arrayMsg, "O campo [Verificar senha] deve estar igual a senha");
        }
        if(!$confSenha){
            array_push($arrayMsg, "Você deve verificar sua senha! No campo [Verificar senha].");
            
        }
        //Falta validar a formatação do cpf
        if (!$cpf) {
            array_push($arrayMsg, "O campo [CPF] é obrigatório.");
        }
        //Falta validar Telefone
        if (!$telefone) {
            array_push($arrayMsg, "O campo [Telefone] é obrigatório.");
        }

        return $arrayMsg;
    }

}
