<?php
    require_once(__DIR__ . "/Controller.php");

    class RelatoriosController extends Controller{
       public function __construct() {
        $this->handleAction();    
    }
        protected function view(){    
        $this->loadView("meusLivros/perfil.php", []);    
    }
    }
?>