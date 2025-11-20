<?php
    require_once(__DIR__ . "/Controller.php");
    require_once(__DIR__ . "/../model/enum/UsuarioPapel.php");
    require_once(__DIR__ ."/../model/Usuario.php");
    require_once(__DIR__ . "/../dao/UsuarioDAO.php");
    require_once(__DIR__ . "/../service/UsuarioService.php");
   
    class RelatoriosController extends Controller{
        private UsuarioDAO $usuarioDAO;
        private Usuario $usuario;
        private UsuarioPapel $usuarioPapel;
        private UsuarioService $usuarioService;
            
       public function __construct() {
        $this->usuario = new Usuario();
        $this->usuarioPapel = new UsuarioPapel();
        $this->usuarioDAO = new UsuarioDAO();
        $this->usuarioService = new UsuarioService(); 
        $this->handleAction();    
    }
        
    }
    #Criar objeto da classe para assim executar o construtor
    new RelatoriosController();