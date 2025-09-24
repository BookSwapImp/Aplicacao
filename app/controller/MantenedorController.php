<?php
require_once(__DIR__.'/../dao/UsuarioDAO.php');
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__.'/../model/enum/UsuarioPapel.php');
    class MantenedorController extends Controller{
        private Usuario $usuario;
        private UsuarioDAO $usuarioDAO;
        public function __construct(){
            if(!$this->usuarioEstaLogado())
                return;
             $this->usuarioDAO = new UsuarioDAO();
             $userType = $this->usuarioDAO->findById($this->getIdUsuarioLogado()); 

             if($userType !==  UsuarioPapel::ADMINISTRADOR)
                 header("location: " . LOGIN_PAGE);
             $this->usuario = new Usuario();   
        }
        protected function mantenedorPage(){
            $dados= array();
            $this->loadView("mantenedor/mantenedor.php",$dados);   
        }
    }
 
   new MantenedorController(); 
