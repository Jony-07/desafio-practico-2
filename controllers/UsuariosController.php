<?php
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/UsuariosModel.php";
require_once "./models/TipoUsuarioModel.php";
require_once "./models/EstadosModel.php";
require_once "./models/ClientesModel.php";
    class UsuariosController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new UsuariosModel();
        }
        public function index()
        {
        var_dump($this->modelo->get());
        }
        public function Comprobar()
        {
            $categoriasModel = new CategoriasModel();
            $viewBag['categorias']=$categoriasModel->get();
            $this->render("comprobar.php",$viewBag);

        }
        public function Comprobando($correo,$hash_active)
        {

            $categoriasModel = new CategoriasModel();
            $viewBag['categorias']=$categoriasModel->get();
            $clientesModel = new ClientesModel();
            $login_buffer=$this->modelo->ValidateU($correo,$hash_active);
            $login_buffer_cliente=$clientesModel->ValidateC($correo,$hash_active);
            if(count($login_buffer)>0)
            {
                $login_buffer= $this->modelo->UpdateActivacion($correo,$hash_active);
                if(count($login_buffer)>0)
                {
                    header("Location: ".PATH."/Usuarios/Login");
                    $viewBag['categorias']=$categoriasModel->get();
                    $this->render("login.php",$viewBag);
                }
            }
            elseif(count($login_buffer_cliente)>0)
            {
                $login_buffer_cliente= $clientesModel->UpdateActivacion($correo,$hash_active);
                if(count($login_buffer_cliente)>0)
                {
                    header("Location: ".PATH."/Usuarios/Login");
                    $viewBag['categorias']=$categoriasModel->get();
                    $this->render("login.php",$viewBag);
                }
            }
        }
        public function Activar()
        {
            $categoriasModel = new CategoriasModel();
            $viewBag['categorias']=$categoriasModel->get();
            $this->render("activar.php",$viewBag);
        }

        public function generarCorreoActivacion($i_nombre,$i_apellido,$i_correo,$hash_active)
        {
            date_default_timezone_set("America/El_Salvador");
            $paraCliente = $i_correo;
            $emailCliente=$i_correo;
            $tituloCliente =  "Activando Cuenta...";
            $mensajeCliente= "<!doctype html>
    <html lang='es'>".
            "<head><title>Recuperando Cuenta</title>".
          "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'
                    integrity='sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn' crossorigin='anonymous'>
                <style>
                    *{
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }
                    body{
                        font-size: 16px;
                        font-weight: 300;
                        color: white;
                        
                        line-height: 30px;
                        text-align: center;
                    }
                    .contenedor{
                    width: 85%;
                    min-height:auto;
                    text-align: center;
                    margin: 0 auto;
                    background: #ececec;
                    border-top: 5px solid #ced831;
                    border-bottom:5px solid #ced831 ;
                }
                .bold{
                    color:white;
                    font-size:25px;
                    font-weight:bold;
                }
                .saludo{
                    color: white;
                    font-size:20px;
                    font-weight:bold;
                }
                img{
                    margin-left: auto;
                    margin-right: auto;
                    display: block;
                    padding:0px 0px 20px 0px;
                }
                .text-dis{
                    text-align: left;
                    color:white;
                }
                .seccion1{
                    color: white;
                    padding: 10px;
                    background-color:  #1b2433;
                }
                .seccion2{
                    background-color:#ced831;
                    color: #1b2433;
                    
                }
                .indicaciones
                {
                    font-weight:bold;
                    font-size:25px;
                    text-align: left;
                }
                .seccion3{
                    color: #1b2433;
                    pad: 10px;
                    background-color: white;
                    font-size:35px;
                    font-weight:bold;
                }
                a{
                        text-decoration: none;
                }
                p{
                    color:white;
                }
                .btn-activate{
                    background-color:#ced831;
                    color: #1b2433;
                    font-weight:bold;
                }
                .btn-activate:hover{
                    background-color: white;
                    color: #1b2433;
                }
                </style>
            </head>".
            "<body>".
                "<div class='container'>".
                "<div class='contenedor'>".
                    "<div class='seccion1'>".
                    "<span class='bold'>Activando Cuenta</span>".
                    "<p>&nbsp;</p>".
                    "<span class='saludo'>Hola<strong > $i_nombre $i_apellido</strong></span>".
                    "<p>&nbsp;</p>".
                    "<div class='text-dis'>".
                    "<p>Has hecho una solicitud para activar tu cuenta, detalles: </p>".
                    "<p>Usuario: $emailCliente</p>".
                    "<p>Fecha y hora de solicitud: ".date('d/m/Y h:i: s a', time())."</p>".       
                    "</div>".
                    "<p class='text-dis'>Para poder activar tu cuenta debes cliquear  el botón activar</p>".
                    "<p>&nbsp;</p>".
                    "<a href=".PATH."/Usuario/Comprobar/$emailCliente/$hash_active' target='_blank' class='btn-activate btn btn-primary btn-block'>Activar</a>".
                    "</div>". 
                "</div>".
                "</div>".
            "</body>".
            "</html>";
            $cabecerasCliente  = 'MIME-Version: 1.0' . "\r\n";
            $cabecerasCliente .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabecerasCliente .= 'From: Sumersa. Tienda en Linea<noreply@textilexport.com>'."\r\n";
            $cabecerasCliente .= 'Reply-To: noresponder@pruebaroyalcanin.com' . "\r\n";
            $cabecerasCliente .=  'X-Mailer: PHP/'.phpversion();
            $enviadoCliente   = @mail($paraCliente, $tituloCliente, $mensajeCliente, $cabecerasCliente);
            if($enviadoCliente)
            {
                echo "<ul> <li>Correo enviado exitosamente</li></ul>";
                
            }
            else{
                    

            }

        }
        public function Activando()
        {
            extract($_POST);
            $errores=array();
            if(isset($_POST['Confirmar']))
            {
                $clientesModel = new ClientesModel();
                if(!isset($correo)||estaVacio($correo))
                {
                    array_push($errores,"Debes ingresar tu correo");
                }
                elseif(!esMail($correo))
                {
                  array_push($errores,"Correo no válido");
                }
                if(count($errores)>0)
                {     
                  $viewBag['errores']=$errores;
                  $categoriasModel = new CategoriasModel();
                $viewBag['categorias']=$categoriasModel->get();
                $viewBag['correo']=$correo;
                  $this->render("activar.php",$viewBag);
                  
                }
                else{

                $login_buffer=$this->modelo->Validate($correo);
                $login_buffer_cliente=$clientesModel->Validate($correo);
                if(count($login_buffer)>0)
                {

                    $login_buffer=$this->modelo->DataActive($correo);
                    if(count($login_buffer)>0)
                    {
                        extract($login_buffer[0]);
                        $this->Activando($nickname,'',$correo,$hash_active);
                    }
                }
                elseif(count($login_buffer_cliente)>0){
                    $login_buffer_cliente=$clientesModel->DataActive($correo);
                    if(count($login_buffer_cliente)>0)
                    {
                        extract($login_buffer_cliente[0]);
                        $this->Activando($nombre,$apellido,$correo,$hash_active);
                      
                    }
                }
                else{
                    array_push($errores,"Cuenta verificada o inexistente");
                    $viewBag['errores']=$errores;
                    $viewBag['correo']=$correo;
                    $categoriasModel = new CategoriasModel();
                    $viewBag['categorias']=$categoriasModel->get();
                    $this->render("activar.php",$viewBag);
                }
                }
            }
        }

        public function Logout()
        {
            $categoriasModel = new CategoriasModel();
            $viewBag['categorias']=$categoriasModel->get();
            session_unset();
            session_destroy();
            header('Location: '.PATH);
        }
        public function Login()
        {
            $categoriasModel = new CategoriasModel();
            $viewBag['categorias']=$categoriasModel->get();
            $this->render("login.php",$viewBag);
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
        }
        public function Validate()
        {
            extract($_POST);
            $errores=array();
            if(isset($_POST['Ingresar']))
            {
                $clientesModel = new ClientesModel();
            if(!isset($usuario)||estaVacio($usuario))
            {
                array_push($errores,"Debes ingresar tu correo");
            }
            if(!isset($clave)||estaVacio($clave))
            {
                array_push($errores,"Debes ingresar tu clave");
            }
            if(count($errores)>0)
          {     
            $viewBag['errores']=$errores;
            $this->render("login.php",$viewBag);
            
          }
          else{
                $login_buffer=$this->modelo->ValidateUser($usuario,$clave);
                if(count($login_buffer)>0)
                {
                    $login_buffer=$this->modelo->ValidateAccess($usuario,$clave);
                if(count($login_buffer)>0)
                {
                    session_start();
                    $_SESSION['login_buffer']=$login_buffer[0];
                    header('Location: '.PATH);
                    
                }
                else{
                    array_push($errores,"Cuenta deshabilitada/no verificada");
                    $viewBag['errores']=$errores;
                    $this->render("login.php",$viewBag);
                      header('Location: '.PATH);
                }
                }
                else{

                    $login_buffer=$clientesModel->ValidateCliente($usuario,$clave);
                    if(count($login_buffer)>0)
                    {
                        $login_buffer=$clientesModel->ValidateAccessCliente($usuario,$clave);
                        if(count($login_buffer)>0)
                        {
                            session_start();
                            $_SESSION['login_buffer']=$login_buffer[0];
                            header('Location: '.PATH);
                        }
                        else{
                            array_push($errores,"Cuenta deshabilitada/no verificada");
                            $viewBag['errores']=$errores;
                            $this->render("login.php",$viewBag);
                        }
                    }
                    else{
                    array_push($errores,"Usuario y/o contraseña incorrecta");
                    $viewBag['errores']=$errores;
                    $this->render("login.php",$viewBag);
                    }
                }
          }
        }
        }
        public function Actualizar($id)
        {

            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){
            $TUModel = new TipoUsuarioModel();
            $estadosModel = new EstadosModel();
            $viewBag = array();
            $categoriasModel = new CategoriasModel();
            $viewBag['estados']=$estadosModel->get();
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['tipo_usuarios']=$TUModel->get();
            $viewBag['usuarios']=$this->modelo->get($id);
            $this->render("edit.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
        }

        public function Update($id)
        {
            if(isset($_POST['Guardar']))
            {
                extract($_POST);

                $viewBag=array();
                $usuario['codigo_usuario']=$codigo_usuario;
                $usuario['id_estado']=$id_estado;
                $usuario['id_tipo_usuario']=$id_tipo_usuario;
                if($this->modelo->updateST($usuario)>0){
                    header('Location: '.PATH);}
                else{
                    header('Location: '.PATH);
                }
                

            }

        }

        public function Estado($cat)
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){

            $categoriasModel = new CategoriasModel();
            $viewBag = array();
           
            $viewBag['usuarios']=$this->modelo->getStatus($cat);
            $viewBag['categorias']=$categoriasModel->get();
            $this->render("index.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
        }
        public function Signin()
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){
        $tipousuarioModel = new TipoUsuarioModel();
        $viewBag = array();
         $categoriasModel = new CategoriasModel();
        $viewBag['categorias']=$categoriasModel->get();
        $viewBag['tipo_usuarios']=$tipousuarioModel->get();
        $this->render("registrar.php",$viewBag);
    }   else{
        header("Location: ".PATH."/Index/Default") ;
    }
}
        }
        public function Edit()
        {

            $TUModel = new TipoUsuarioModel();
            $viewBag = array();
            $categoriasModel = new CategoriasModel();
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['tipo_usuarios']=$TUModel->get();
            $viewBag['usuarios']=$this->modelo->get($_SESSION['login_buffer']['codigo_usuario']);
            $this->render("editme.php",$viewBag);

        }
        public function Editar()
        {
            if(isset($_POST['Guardar']))
            {
                extract($_POST);
                $errores=array();
                $viewBag=array();
                if(!isset($codigo_usuario)||estaVacio($codigo_usuario))
                {
                    array_push($errores,"Debes ingresar un codigo de usuario");
                }elseif(!esUsuario($codigo_usuario))
                {
                    array_push($errores,"El codigo no es válido");
                }
                if(!isset($nickname)||estaVacio($nickname))
                {
                    array_push($errores,"Debes ingresar un nickname");
                }
                elseif(!esNickname($nickname))
                {
                  array_push($errores,"El nickname es inváldo");
                }
                if(!isset($telefono)||estaVacio($telefono))
                {
                    array_push($errores,"Debes ingresar tu número de teléfono");
                }
                elseif(!esTelefono($telefono))
                {
                  array_push($errores,"Debes ingresar un número válido");
                }
                if(!isset($correo)||estaVacio($correo))
                {
                    array_push($errores,"Debes ingresar tu correo");
                }
                elseif(!esMail($correo))
                {
                  array_push($errores,"Correo no válido");
                }
                if(count($errores)>0)
                {
                   $viewBag['errores']=$errores;
                   $TUModel = new TipoUsuarioModel();
                   $categoriasModel = new CategoriasModel();
                   $viewBag['categorias']=$categoriasModel->get();
                   $viewBag['tipo_usuarios']=$TUModel->get();
                   $viewBag['usuarios']=$this->modelo->get($_SESSION['login_buffer']['codigo_usuario']);
                   $this->render("editme.php",$viewBag);    
                }
                else
                {
                if(!isset($clave)||estaVacio($clave))
                {
                    $usuario['codigo_usuario']=$codigo_usuario;
                    $usuario['nombre']=$nickname;
                    $usuario['correo']=$correo;           
                    $usuario['telefono']=$telefono;

                            if($this->modelo->updateNonPass($usuario)>0){
                            header('Location: '.PATH);}
                            else
                            {
                            array_push($errores,"No se ha realizado ningun cambio");
                            $viewBag['errores']=$errores;
                            $categoriasModel = new CategoriasModel();
                            $viewBag['categorias']=$categoriasModel->get();
                            $viewBag['usuarios']=$this->modelo->get($_SESSION['login_buffer']['codigo_usuario']);
                            $TUModel = new TipoUsuarioModel();
                            $viewBag['tipo_usuarios']=$TUModel->get();
                            $this->render("editme.php",$viewBag);
                    
                            }
                     
                }
                elseif(isset($clave)||!estaVacio($clave)||esClave($clave))
                {
                    if(esClave($clave))
                    {   
                        
                        $usuario['codigo_usuario']=$codigo_usuario;
                        $usuario['nombre']=$nickname;
                        $usuario['clave']=hash('sha256',$clave);
                        $usuario['correo']=$correo;           
                        $usuario['telefono']=$telefono;
                            if($this->modelo->update($usuario)>0){
                                header('Location: '.PATH);}
                                else
                                {
                                array_push($errores,"No se ha realizado ningun cambio");
                                $viewBag['errores']=$errores;
                                $viewBag['usuarios']=$this->modelo->get('U238');
                                $TUModel = new TipoUsuarioModel();
                                $categoriasModel = new CategoriasModel();
                                $viewBag['categorias']=$categoriasModel->get();
                                $viewBag['tipo_usuarios']=$TUModel->get();
                                $this->render("editme.php",$viewBag);
                        
                                }
                    }
                    else{
                        array_push($errores,"La contraseña no cumple con los requisitos");
                        $viewBag['errores']=$errores;
                        $TUModel = new TipoUsuarioModel();
                   $categoriasModel = new CategoriasModel();
                   $viewBag['categorias']=$categoriasModel->get();
                   $viewBag['tipo_usuarios']=$TUModel->get();
                   $viewBag['usuarios']=$this->modelo->get('U238');
                   $this->render("editme.php",$viewBag);    
                    }

                     
                } 
            }
   
                 
            } 
        }
        public function Registrar()
        {
            if(isset($_POST['Guardar']))
            {
                extract($_POST);
                $errores=array();
                $viewBag=array();
                if(!isset($codigo_usuario)||estaVacio($codigo_usuario))
                {
                    array_push($errores,"Debes ingresar un codigo de usuario");
                }elseif(!esUsuario($codigo_usuario))
                {
                    array_push($errores,"El codigo no es válido");
                }
                if(!isset($nickname)||estaVacio($nickname))
                {
                    array_push($errores,"Debes ingresar un nickname");
                }
                elseif(!esNickname($nickname))
                {
                  array_push($errores,"El nickname es inváldo");
                }
                if(!isset($telefono)||estaVacio($telefono))
                {
                    array_push($errores,"Debes ingresar tu número de teléfono");
                }
                elseif(!esTelefono($telefono))
                {
                  array_push($errores,"Debes ingresar un número válido");
                }
                if(!isset($correo)||estaVacio($correo))
                {
                    array_push($errores,"Debes ingresar tu correo");
                }
                elseif(!esMail($correo))
                {
                  array_push($errores,"Correo no válido");
                }
                if(!isset($clave)||estaVacio($clave))
                {
                    array_push($errores,"Debes ingresar una clave");
                }
                elseif(!esClave($clave))
                {
                  array_push($errores,"Clave invalida");
                }
               
                $usuario['codigo_usuario']=$codigo_usuario;
                $usuario['nombre']=$nickname;
                $usuario['clave']=hash('sha256',$clave);
                $usuario['hash_active']=md5(rand(1,1000));
                $usuario['id_tipo_usuario']=$id_tipo_usuario;
                $usuario['correo']=$correo;           
                $usuario['telefono']=$telefono;
                if(count($errores)>0)
                 {
                    $viewBag['errores']=$errores;
                    $TUModel = new TipoUsuarioModel();
                    $viewBag['tipo_usuarios']=$TUModel->get();
                    $viewBag['usuario']=$usuario;
                    $this->render("registrar.php",$viewBag);    
                 }
                 else{
                    if($this->modelo->create($usuario)>0){
                        header('Location: '.PATH);}
                        else
                        {
                        array_push($errores,"Ya existe un usuario con estos datos");
                        $viewBag['errores']=$errores;
                        $viewBag['usuario']=$usuario;
                        $TUModel = new TipoUsuarioModel();
                        $viewBag['tipo_usuarios']=$TUModel->get();
                        $this->render("registrar.php",$viewBag);
                
                        }
                 }
                 
            } 
        }
    }
?>