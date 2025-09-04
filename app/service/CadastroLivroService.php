<?php
include_once(__DIR__."/../model/Anuncios.php");
require_once('CaracteresService.php');

class CadastroLivroService{
    private $anuncio;
    private $caracteresService;
        function __construct() {
        $this->anuncio = new Anuncios;
        $this->caracteresService = new CaracteresService();
    }
    public function validarCampos(?Anuncios $anuncio){
        $arrayMsg = []; 
        if (!$anuncio->getNomeLivro()) 
            array_push($arrayMsg, "O campo [Nome] é obrigatório.");
        else{
            $ivalidado = $this->caracteresService->CaracteresInvalidos($anuncio->getNomeLivro());
            array_push($arrayMsg, $ivalidado);
        }
        return $arrayMsg;
    }
}