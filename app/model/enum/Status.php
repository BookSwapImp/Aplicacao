<?php
class Status {

    public static string $SEPARADOR = "|";

    const ATIVO = "ativo";
    const INATIVO = "inativo";

    public static function getAllAsArray() {
        return [Status::ATIVO, Status::INATIVO];
    }

}
