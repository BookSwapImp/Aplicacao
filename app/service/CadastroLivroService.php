<?php
include_once(__DIR__."/../model/Anuncios.php");
class CadastroLivroService{
    private $anuncio;
        function __construct() {
        $this->anuncio = new Anuncios;
    }
    public function validarCampos(?Anuncios $anuncio){
        $arrayMsg = []; 
        if (!$anuncio->getNomeLivro()) {
            array_push($arrayMsg, "O campo [Nome] é obrigatório.");
        }
        return $arrayMsg;

    }

}