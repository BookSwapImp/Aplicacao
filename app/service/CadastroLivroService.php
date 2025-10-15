<?php
include_once(__DIR__."/../model/Anuncio.php");
require_once('CaracteresService.php');

class CadastroLivroService{
    private $anuncio;
    private $caracteresService;
        function __construct() {
        $this->anuncio = new Anuncio;
        $this->caracteresService = new CaracteresService();
    }
    public function validarCampos(?Anuncio $anuncio){
        $arrayMsg = []; 
        if (!$anuncio->getNomeLivro()) 
            array_push($arrayMsg, "O campo [Nome] é obrigatório.");
        if (!$anuncio->getDescricao()) 
            array_push($arrayMsg, "O campo [Descrição] é obrigatório.");
        if (!$anuncio->getEstadoCon()) 
            array_push($arrayMsg, "O campo [Estado de conservação] é obrigatório.");
        if (!$anuncio->getUsuarioId()) 
            array_push($arrayMsg, "erro o Usuario id não foi verficado.");        
            // loop para verficar caractere invalidos
        /*if (!$anuncio->getNomeLivro() || !$anuncio->getDescricao()) 
            $aux = $anuncio->getNomeLivro().$anuncio->getDescricao();     
           for ($i=0; $i < strlen($aux); $i++) { 
               $ivalidado = $this->caracteresService->CaracteresInvalidos($aux[$i]);
               if ($ivalidado) {
                   array_push($arrayMsg, $ivalidado);
                   return $arrayMsg;
                }
           } 
                */
        return $arrayMsg;
    }
}