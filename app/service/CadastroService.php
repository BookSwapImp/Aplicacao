<?php
# Nome do arquivo: CadastroService.php
# Objetivo: Classe de serviço para cadastro e login de usuários

require_once(__DIR__ . "/../model/Usuario.php");

class CadastroService {

    // Valida os campos obrigatórios de um usuário
    public function validarCampos(?string $nome, ?string $email, ?string $senha, ?string $cpf, ?int $telefone) {
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

        if (!$cpf) {
            array_push($arrayMsg, "O campo [CPF] é obrigatório.");
        }

        if (!$telefone) {
            array_push($arrayMsg, "O campo [Telefone] é obrigatório.");
        }

        return $arrayMsg;
    }

    // Salva os dados do usuário logado na sessão
    public function salvarUsuarioSessao(Usuario $usuario) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION[SESSAO_USUARIO_ID]     = $usuario->getId();
        $_SESSION[SESSAO_USUARIO_NOME]   = $usuario->getNome();
        $_SESSION[SESSAO_USUARIO_EMAIL]  = $usuario->getEmail();
        $_SESSION[SESSAO_USUARIO_PAPEL]   = $usuario->getTipo();
        $_SESSION[SESSAO_USUARIO_STATUS] = $usuario->getStatus();
    }

    // Remove os dados do usuário da sessão
    public function removerUsuarioSessao() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
    }

}
