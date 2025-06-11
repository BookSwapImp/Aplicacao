<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class UsuarioPapel {

    public static string $SEPARADOR = "|";

    const USUARIO = "usuario";
    const ADMINISTRADOR = "admin";

    public static function getAllAsArray() {
        return [UsuarioPapel::USUARIO, UsuarioPapel::ADMINISTRADOR];
    }

}

