<?php
    
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarNomeEmail(?string $nome,?string $email) {
        $erros = array();

        //Validar campos vazios
        if(! $nome)
            array_push($erros, "O campo [Nome] é obrigatório.");

        if(! $email)
            array_push($erros, "O campo [Email] é obrigatório.");
    }
    /* Método para validar se o usuário selecionou uma foto de perfil */
    public function validarFotoPerfil(array $foto) {
        $erros = array();
        
        if($foto['size'] <= 0)
            array_push($erros, "Informe a foto para o perfil!");

        return $erros;
    }

}
