<?php
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/ClientesModel.php";
require_once "./models/CategoriasModel.php";
    class ClientesController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new ClientesModel();
        }
        public function index()
        {
        var_dump($this->modelo->get());
        }

        public function Update($id)
        {
            if(isset($_POST['Guardar']))
            {
                extract($_POST);
                
                $viewBag=array();
                $cliente['codigo_cliente']=$codigo_cliente;
                $cliente['id_estado']=$id_estado;
                if($this->modelo->updateST($cliente)>0){
                    header('Location: '.PATH);}
                else{
                    header('Location: '.PATH);
                }
                

            }

        }

        public function Actualizar($id)
        {
            $estadosModel = new EstadosModel();
            $viewBag = array();
            $categoriasModel = new CategoriasModel();
            $viewBag['estados']=$estadosModel->get();
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['clientes']=$this->modelo->get($id);
            $this->render("edit.php",$viewBag);
        }

        public function Estado($cat)
        {
            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            $viewBag['clientes']=$this->modelo->getStatus($cat);
            $viewBag['categorias']=$categoriasModel->get();
            $this->render("index.php",$viewBag);
        }

        public function signin()
        {
            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            $viewBag['categorias']=$categoriasModel->get();
            $this->render("registrar.php",$viewBag);
        }
        public function Edit()
        {

            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['clientes']=$this->modelo->get('01234567-4');
            $this->render("editme.php",$viewBag);

        }

        public function Editar()
        {
            if(isset($_POST['Guardar']))
            {
                extract($_POST);
                $errores=array();
                $viewBag=array();
                if(!isset($codigo_cliente)||estaVacio($codigo_cliente))
                {
                    array_push($errores,"Debes ingresar tu DUI");
                }elseif(!esDUI($codigo_cliente))
                {
                    array_push($errores,"El DUI no cumple con el estandar");
                }
                if(!isset($nombre_cliente)||estaVacio($nombre_cliente))
                {
                    array_push($errores,"Debes ingresar tu nombre");
                }
                elseif(!esTexto($nombre_cliente))
                {
                  array_push($errores,"Debes ingresar un nombre válido");
                }
                if(!isset($apellido)||estaVacio($apellido))
                {
                    array_push($errores,"Debes ingresar tu apellido");
                }
                elseif(!esTexto($apellido))
                {
                  array_push($errores,"Debes ingresar un apellido válido");
                }
                if(!isset($telefono)||estaVacio($telefono))
                {
                    array_push($errores,"Debes ingresar tu número de teléfono");
                }
                elseif(!esTelefono($telefono))
                {
                  array_push($errores,"Debes ingresar un número válido");
                }
                if(!isset($direccion)||estaVacio($direccion))
                {
                    array_push($errores,"Debes ingresar una direccion");
                }
                elseif(!esDescripcion($direccion))
                {
                  array_push($errores,"Direccion no válida");
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
                   $categoriasModel = new CategoriasModel();
                   $viewBag['categorias']=$categoriasModel->get();
                   $viewBag['clientes']=$this->modelo->get('01234567-4');
                   $this->render("editme.php",$viewBag);    
                }
                else{


                if(!isset($clave)||estaVacio($clave))
                {
                    $cliente['nombre']=$nombre_cliente;
                    $cliente['codigo_cliente']=$codigo_cliente;
                    $cliente['apellido']=$apellido;
                    $cliente['correo']=$correo;
                    $cliente['direccion']=$direccion;
                    $cliente['telefono']=$telefono;
                        if($this->modelo->updateNonPass($cliente)>0){
                            header('Location: '.PATH);}
                            else
                            {
                                array_push($errores,"No se ha podido efectuar ninguna actualización");
                            $viewBag['errores']=$errores;
                            $viewBag['clientes']=$this->modelo->get('01234567-4');
                            $categoriasModel = new CategoriasModel();
                            $viewBag['categorias']=$categoriasModel->get();
                              $this->render("editme.php",$viewBag);
                    
                            }

                }
                elseif(isset($clave)||!estaVacio($clave)){

                  if(esClave($clave))
                  {
                    $cliente['nombre']=$nombre_cliente;
                    $cliente['codigo_cliente']=$codigo_cliente;
                    $cliente['apellido']=$apellido;
                    $cliente['correo']=$correo;
                    $cliente['direccion']=$direccion;
                    $cliente['clave']=hash('sha256',$clave);
                    $cliente['telefono']=$telefono;


                        if($this->modelo->update($cliente)>0){
                            header('Location: '.PATH);}
                            else
                            {
                            array_push($errores,"No se ha podido ninguna actualización");
                            $viewBag['errores']=$errores;
                            $viewBag['clientes']=$this->modelo->get('01234567-4');
                            $categoriasModel = new CategoriasModel();
                            $viewBag['categorias']=$categoriasModel->get();
                              $this->render("editme.php",$viewBag);
                    
                            }
                  }
                  else{
                    array_push($errores,"La contraseña no cumple con los requisitos");
                    $viewBag['errores']=$errores;
                    $categoriasModel = new CategoriasModel();
                    $viewBag['categorias']=$categoriasModel->get();
                    $viewBag['clientes']=$this->modelo->get('01234567-4');
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
                if(!isset($codigo_cliente)||estaVacio($codigo_cliente))
                {
                    array_push($errores,"Debes ingresar tu DUI");
                }elseif(!esDUI($codigo_cliente))
                {
                    array_push($errores,"El DUI no cumple con el estandar");
                }
                if(!isset($nombre_cliente)||estaVacio($nombre_cliente))
                {
                    array_push($errores,"Debes ingresar tu nombre");
                }
                elseif(!esTexto($nombre_cliente))
                {
                  array_push($errores,"Debes ingresar un nombre válido");
                }
                if(!isset($apellido)||estaVacio($apellido))
                {
                    array_push($errores,"Debes ingresar tu apellido");
                }
                elseif(!esTexto($apellido))
                {
                  array_push($errores,"Debes ingresar un apellido válido");
                }
                if(!isset($telefono)||estaVacio($telefono))
                {
                    array_push($errores,"Debes ingresar tu número de teléfono");
                }
                elseif(!esTelefono($telefono))
                {
                  array_push($errores,"Debes ingresar un número válido");
                }
                if(!isset($direccion)||estaVacio($direccion))
                {
                    array_push($errores,"Debes ingresar una direccion");
                }
                elseif(!esDescripcion($direccion))
                {
                  array_push($errores,"Direccion no válida");
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
                $cliente['nombre']=$nombre_cliente;
                $cliente['codigo_cliente']=$codigo_cliente;
                $cliente['apellido']=$apellido;
                $cliente['correo']=$correo;
                $cliente['direccion']=$direccion;
                $cliente['clave']=hash('sha256',$clave);
                $cliente['telefono']=$telefono;
                $cliente['hash_active']=md5(rand(1,1000));
                if(count($errores)>0)
                 {
                    $viewBag['errores']=$errores;
                    $categoriasModel = new CategoriasModel();
                    $viewBag['categorias']=$categoriasModel->get();
                    $viewBag['clientes']=$cliente;
                    $this->render("registrar.php",$viewBag);    
                 }
                 else{
                    if($this->modelo->create($cliente)>0){
                        header('Location: '.PATH);}
                        else
                        {
                          array_push($errores,"Ya existe un usuario con estos datos");
                        $viewBag['errores']=$errores;
                        $viewBag['cliente']=$cliente;
                        $categoriasModel = new CategoriasModel();
                        $viewBag['categorias']=$categoriasModel->get();
                          $this->render("registrar.php",$viewBag);
                
                        }
                 }
                 
            }  
        }
    }
?>