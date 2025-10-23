<?php
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/Anuncio.php");
require_once(__DIR__ . "/../model/Usuario.php");

class BuscaDAO{
    private $Anuncio;
    private $Usuario;
    public function __construct()
    {
      $this->Anuncio = new Anuncio();
      $this->Usuario = new Usuario();  
    }
    
}
