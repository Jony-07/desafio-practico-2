<?php
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/CategoriasModel.php";
    class CategoriasController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new CategoriasModel();
        }
        public function index()
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){
            $viewBag = array();
            $viewBag['categorias']=$this->modelo->get();
            $this->render("index.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
        }

        public function Recuperar()
        {
        $url = explode("/", $_SERVER['REQUEST_URI']);
        $id = empty($url[4])?'':$url[4];
        if(isset($id))
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){
        $viewBag['categorias']=$this->modelo->get();
        $viewBag['categoriax']=$this->modelo->getDescontinuados($id);
        $this->render("recuperar.php",$viewBag);
    }   else{
        header("Location: ".PATH."/Index/Default") ;
    }
}
        }
        }
        public function Recover()
        {
            if(isset($_POST['Recuperar']))
            {
                $url = explode("/", $_SERVER['REQUEST_URI']);
                $id = empty($url[4])?'':$url[4];
                if(isset($id))
                {
              extract($_POST);
              $id_categoria;
              if($this->modelo->updateStatus($id_categoria)>0){
                header('Location: '.PATH.'/Categorias/Descontinuados');}
      
                $viewBag['categorias']=$this->modelo->get();
                $viewBag['categoriax']=$this->modelo->getDescontinuados();
                  $this->render("descontinuados.php",$viewBag);
              }
            }
        }

        public function Descontinuados()
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){
            $viewBag = array();
            $viewBag['categorias']=$this->modelo->get();
            $viewBag['categoriax']=$this->modelo->getDescontinuados();
            $this->render("descontinuados.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
        }
        public function Create()
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){
            $viewBag = array();
            $viewBag['categorias']=$this->modelo->get();
            $this->render("new.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
        }
        public function Edit()
        {
            $url = explode("/", $_SERVER['REQUEST_URI']);
            $id = empty($url[4])?'':$url[4];
            if(isset($id))
            {
                if(!isset($_SESSION['login_buffer']))
                {
                 header("Location: ".PATH."/Usuarios/login") ;   
                }
                else{
                    if($_SESSION['login_buffer']['id_tipo_usuario']==1){
            $viewBag = array();
            $viewBag['categorias']=$this->modelo->get();
            $viewBag['categoriax']=$this->modelo->get($id);
            $this->render("edit.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
            }
        }

        public function Delete()
        {
            $url = explode("/", $_SERVER['REQUEST_URI']);
            $id = empty($url[4])?'':$url[4];
            if(isset($id))
            {
                if(!isset($_SESSION['login_buffer']))
                {
                 header("Location: ".PATH."/Usuarios/login") ;   
                }
                else{
                    if($_SESSION['login_buffer']['id_tipo_usuario']==1){
            $viewBag = array();
            $viewBag['categorias']=$this->modelo->get();
            $viewBag['categoriax']=$this->modelo->get($id);
            $this->render("delete.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
            }
        }
        public function Eliminar()
        {
            if(isset($_POST['Eliminar']))
            {
              extract($_POST);
              $id_categoria;
              if($this->modelo->delete($id_categoria)>0){
                header('Location: '.PATH.'/Categorias');}
      
                $viewBag['categorias']=$this->modelo->get();
                  $this->render("index.php",$viewBag);
            }
        }

        public function Editar()
        {
            if(isset($_POST['Actualizar']))
            {
                $url = explode("/", $_SERVER['REQUEST_URI']);
                $id = empty($url[4])?'':$url[4];
                if(isset($id))
                {
                    extract($_POST);
                    $errores=array();
                    $viewBag=array();
                    if(!isset($id_categoria)||estaVacio($id_categoria))
                    {
                        array_push($errores,"Debes ingresar el id");
                    }elseif(!esCategoria($id_categoria))
                    {
                        array_push($errores,"El id debe contener solo dos digitos");
                    }
                    if(!isset($nombre_categoria)||estaVacio($nombre_categoria))
                    {
                        array_push($errores,"Debes ingresar el nombre de la categoria");
                    }
                    elseif(!esTexto($nombre_categoria))
                    {
                      array_push($errores,"Debes ingresar un nombre válido");
                    }
                    $categoria['nombre_categoria']=$nombre_categoria;
                    $categoria['id_categoria']=$id_categoria;
                    if(count($errores)>0)
                     {
                       $viewBag['errores']=$errores;
                       $viewBag['categorias']=$this->modelo->get();
                       $viewBag['categoriax']=$this->modelo->get($id);
                       $this->render("edit.php",$viewBag);    
                     }
                     else{
                        if($this->modelo->update($categoria)>0){
                            header('Location: '.PATH.'/Categorias/');}
                            $viewBag['categorias']=$this->modelo->get();
                              $this->render("index.php",$viewBag);

                     }

                }
            }
        }

        public function add()
        {
            if(isset($_POST['Guardar']))
            {
                extract($_POST);
                $errores=array();
                $viewBag=array();
                if(!isset($id_categoria)||estaVacio($id_categoria))
                {
                    array_push($errores,"Debes ingresar el id");
                }elseif(!esCategoria($id_categoria))
                {
                    array_push($errores,"El id debe contener solo dos digitos");
                }
                if(!isset($nombre_categoria)||estaVacio($nombre_categoria))
                {
                    array_push($errores,"Debes ingresar el nombre de la categoria");
                }
                elseif(!esVar($nombre_categoria))
                {
                  array_push($errores,"Debes ingresar un nombre válido");
                }
                $categoria['nombre_categoria']=$nombre_categoria;
                $categoria['id_categoria']=$id_categoria;
                if(count($errores)>0)
                 {
                   $viewBag['errores']=$errores;
                   $viewBag['categorix']=$categoria;
                   $viewBag['categorias']=$this->modelo->get();
                   $this->render("new.php",$viewBag);    
                 }
                 else{
                    if($this->modelo->create($categoria)>0){
                        header('Location: '.PATH.'/Categorias/');}
                        else
                        {
                          array_push($errores,"Ya existe una categoria con este codigo");
                        $viewBag['errores']=$errores;
                        $viewBag['categorix']=$categoria;
                        $viewBag['categorias']=$this->modelo->get();
                          $this->render("new.php",$viewBag);
                
                        }
                 }
                 
            }
        }
    }
?>