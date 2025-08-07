<?php
    
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(?string $nome,?string $email,?string $telefone, ?string $cpf) {
        $erros = array();

        //Validar campos vazios
        if(! $nome)
            array_push($erros, "O campo [Nome] é obrigatório.");

        if(! $email)
            array_push($erros, "O campo [Email] é obrigatório.");

        if(! $telefone)
            array_push($erros, "O campo [telefone] é obrigatório.");

        if(! $cpf)
            array_push($erros, "O campo [cpf] é obrigatório.");


        //Validar se a senha é igual a contra senha
        return $erros;
    }

    /* Método para validar se o usuário selecionou uma foto de perfil */
    public function validarFotoPerfil(array $foto) {
        $erros = array();
        
        if($foto['size'] <= 0)
            array_push($erros, "Informe a foto para o perfil!");

        return $erros;
    }

}
