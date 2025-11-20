<?php
#Nome do arquivo: LoginService.php
#Objetivo: classe service para Login

require_once(__DIR__ . "/../model/Usuario.php");

class LoginService {

    public function validarCampos(?string $email, ?string $senha) {
        $arrayMsg = [];

        //Valida o campo 
        if(! $email)
            array_push($arrayMsg, "O campo [Email] é obrigatório.");
            
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($arrayMsg, "O campo [Email] está em formato inválido.");
                }

        //Valida o campo login
        if(! $senha)
            array_push($arrayMsg, "O campo [Senha] é obrigatório.");

        return $arrayMsg;
    }

    public function salvarUsuarioSessao(Usuario $usuario) {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Setar usuário na sessão do PHP
        $_SESSION[SESSAO_USUARIO_ID]   = $usuario->getId();
        $_SESSION[SESSAO_USUARIO_NOME] = $usuario->getNome();
        $_SESSION[SESSAO_USUARIO_TIPO] = $usuario->getTipo();
        $_SESSION[SESSAO_USUARIO_STATUS] = $usuario->getStatus();
    }

    public function removerUsuarioSessao() {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Destroi a sessão 
        session_destroy();
    }

}