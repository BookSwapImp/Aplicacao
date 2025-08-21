<?php
class Status {

    public static string $SEPARADOR = "|";

    const ATIVADO = "ATIVADO";
    const DESATIVADO = "DESATIVADO";

    public static function getAllAsArray() {
        return [Status::ATIVADO, Status::DESATIVADO];
    }

}
