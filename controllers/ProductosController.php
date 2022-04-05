<?php
require_once "./models/ProductosModel.php";
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/CategoriasModel.php";
require_once "core/validaciones.php";
    class ProductosController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new ProductosModel();


        }
        public function index()
        {
           
            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['productos']=$this->modelo->get();
            $this->render("index.php",$viewBag);
        }

        public function Order($by)
        {
           
            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
            $viewBag['categorias']=$categoriasModel->get();
            if($by=="Asc")
            {
                $viewBag['productos']=$this->modelo->OrderByAsc();
            }
            elseif($by="Desc"){
                $viewBag['productos']=$this->modelo->OrderByDesc();
            }
            
            $this->render("index.php",$viewBag);
        }

        public function listado()
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']!=3){
            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['productos']=$this->modelo->get();
            $this->render("list.php",$viewBag);
                }
            else{
                header("Location: ".PATH."/Index/Default") ;
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
            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['productos']=$this->modelo->getDescontinuados();
            $this->render("descontinuados.php",$viewBag);
            }
            else{
                header("Location: ".PATH."/Index/Default") ;
            }
        }
        }

        public function create()
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']!=3){
            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            $viewBag['productos']=$this->modelo->get();
            $viewBag['categorias']=$categoriasModel->get();
            $this->render("new.php",$viewBag);
                }
                else{
                    header("Location: ".PATH."/Index/Default") ;
                }
            }
        }

        public function categoria($cat)
        {
            $categoriasModel = new CategoriasModel();
            $viewBag = array();
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
            $viewBag['productos']=$this->modelo->getCategoria($cat);
            $viewBag['categorias']=$categoriasModel->get();
            $this->render("categoria.php",$viewBag);
        }
        public function edit()
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
                if($_SESSION['login_buffer']['id_tipo_usuario']!=3){
            $categoriasModel = new CategoriasModel();
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['productos']=$this->modelo->get($id);
            $this->render("edit.php",$viewBag);
                }   else{
                    header("Location: ".PATH."/Index/Default") ;
                }
            }
        }

        
    }

    

    public function delete()
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
                if($_SESSION['login_buffer']['id_tipo_usuario']!=3){
        $categoriasModel = new CategoriasModel();
        $viewBag['categorias']=$categoriasModel->get();
        $viewBag['productos']=$this->modelo->get($id);
        $this->render("delete.php",$viewBag);
    }   else{
        header("Location: ".PATH."/Index/Default") ;
    }
}
    }    
}
public function generate_code($id,$lenght=10)
{
    $carritosModel = new CarritosModel();
    $key = "";
    $pattern = "1234567890";
    $carrito['id_session']=sha1($_SESSION['login_buffer']['codigo_cliente']);
    $carrito['codigo_producto']=$id;
    $max = strlen($pattern)-1;
    do {
        for($i = 0; $i < $lenght; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        $carrito['id_carrito']=$key;
        $rows = count($carritosModel->Comprobate());
    } while ($rows > 0);
    return $key;            
}

public function Comprar($id)
{
    if(isset($_POST['Comprar']))
    {
        $errores=array();
        $viewBag=array();
        extract($_POST);
        $carritosModel = new CarritosModel();
        if(!isset($cantidad)||estaVacio($cantidad))
        {
            array_push($errores,"No haz ingresado la cantidad que deseas de este producto");
        }elseif(!esEntero($cantidad))
        {
            array_push($errores,"La cantidad que escojas debe ser mayor a cero");
        }
        $carrito['id_carrito']=$this->generate_code($id);
        $carrito['id_session']=sha1($_SESSION['login_buffer']['codigo_cliente']);
        $carrito['codigo_producto']=$id;
        $carrito['cantidad']=$cantidad;
        if(count($errores)>0)
        {
            $categoriasModel = new CategoriasModel();
            $viewBag['errores']=$errores;
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['productos']=$this->modelo->get($id);
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
            $this->render("detalles.php",$viewBag);
        }
        else{

            if($carritosModel->create($carrito)>0){
                header('Location: '.PATH.'/Productos');}
                else
                {
                  array_push($errores,"Este producto ya está en tu carrito");
                  $viewBag['errores']=$errores;
                  $categoriasModel = new CategoriasModel();
                  $viewBag['categorias']=$categoriasModel->get();
                  $viewBag['productos']=$this->modelo->get($id);
                  $carritosModel = new CarritosModel();
                  $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                  $this->render("detalles.php",$viewBag);
        
                }
        }
    }
}

public function Cantidad()
{
    
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
        $categoriasModel = new CategoriasModel();
        $viewBag['categorias']=$categoriasModel->get();
        $viewBag['productos']=$this->modelo->get($id);
        $viewBag['productos']=$this->modelo->getDescontinuados($id);
        $this->render("recuperar.php",$viewBag);
        }
        else{
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
              $codigo_producto;
              if($this->modelo->updateStatus($codigo_producto)>0){
                header('Location: '.PATH.'/Productos/Descontinuados');}
      
                $viewBag['productos']=$this->modelo->get();
                  $this->render("descontinuados.php",$viewBag);
              }
            }
        }
        public function Detalles($id)
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            $categoriasModel = new CategoriasModel();
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['productos']=$this->modelo->get($id);
            $this->render("detalles.php",$viewBag);
        }

        public function Eliminar()
        {
            if(isset($_POST['Eliminar']))
            {
              extract($_POST);
              $codigo_producto;
              if($this->modelo->delete($codigo_producto)>0){
                header('Location: '.PATH.'/Productos/Listado');}
      
                $viewBag['productos']=$this->modelo->get();
                  $this->render("list.php",$viewBag);
            }
        }

    public function editar()
    {
        if(isset($_POST['Actualizar']))
        {
            $url = explode("/", $_SERVER['REQUEST_URI']);
            $id = empty($url[4])?'':$url[4];
            if(isset($id))
            {
            extract($_POST);
            $filename=$_FILES['imagen']['name'];
            $size = $_FILES['imagen']['size'];
            $temp = $_FILES['imagen']['tmp_name'];
            $explode=explode('.',$filename);
            $extension=array_pop($explode);
            $errores=array();
            $viewBag=array();
            if(!isset($codigo_producto)||estaVacio($codigo_producto))
{
    array_push($errores,"Debes ingresar el codigo");
}elseif(!esProducto($codigo_producto))
{
    array_push($errores,"El codigo del producto es inválido");
}
if(!isset($nombre_producto)||estaVacio($nombre_producto))
{
    array_push($errores,"Debes ingresar el nombre del  producto");
}
elseif(!esVar($nombre_producto))
{
  array_push($errores,"Debes ingresar un nombre válido");
}

if(!isset($existencias)||estaVacio($existencias))
{
    array_push($errores,"Debes ingresar la cantidad");
}elseif(!esEntero($existencias))
{
    array_push($errores,"Ingresa numeros enteros");
}

if(!isset($precio)||estaVacio($precio))
{
    array_push($errores,"Debes ingresar el precio del libro");
}elseif(!esFloat($precio))
{
    array_push($errores,"Ingresa el precio en enteros o decimales");
}
if(!isset($descripcion)||estaVacio($descripcion))
{
    array_push($errores,"Debes ingresar ingresar una descripcion");
}
elseif(!esDescripcion($descripcion))
{
  array_push($errores,"Debes ingresar la descripcion válida");
}
$producto['nombre_producto']=$nombre_producto;
$producto['codigo_producto']=$codigo_producto;
$producto['id_categoria']=$id_categoria;
$producto['descripcion']=$descripcion;
$producto['precio']=$precio;
$producto['existencias']=$existencias;
$producto['precio']=$precio;

if(count($errores)>0)
{
  $categoriasModel = new CategoriasModel();
  $viewBag['errores']=$errores;
  $viewBag['productos']=$this->modelo->get($codigo_producto);
  $viewBag['categorias']=$categoriasModel->get();
  $this->render("edit.php",$viewBag);    
}
else{
    if (empty($filename))
{

    if($this->modelo->updateImgNone($producto)>0){
        header('Location: '.PATH.'/Productos/Listado');}
}
elseif(!empty($filename)){
    if (!( ($extension == "png" || $extension == "jpg" || $extension == "jpeg") && ($size < 2000000))) {
        array_push($errores,"Debes ingresar una imagen válida (png/jpg)");
       }
       else{
        $producto['imagen']=$codigo_producto.'.'.$extension;
        $path="img";
        if(file_exists($path))
        {
            $dir=$path.'/'.$producto['imagen'];
            if(move_uploaded_file($temp,$dir))
            {
        if($this->modelo->update($producto)>0){
          header('Location: '.PATH.'/Productos/Listado');}
          $viewBag['productos']=$this->modelo->get();
          $this->render("list.php",$viewBag);
        }
    }
       }
     
}
  }
}
        }
    }

        public function add()
        {
            if(isset($_POST['Guardar']))
            {
                extract($_POST);
                $filename=$_FILES['imagen']['name'];
                $size = $_FILES['imagen']['size'];
                $temp = $_FILES['imagen']['tmp_name'];
                $explode=explode('.',$filename);
                $extension=array_pop($explode);
                $errores=array();
                $viewBag=array();
                if(!isset($codigo_producto)||estaVacio($codigo_producto))
    {
        array_push($errores,"Debes ingresar el codigo");
    }elseif(!esProducto($codigo_producto))
    {
        array_push($errores,"El codigo del producto es inválido");
    }
    if(!isset($nombre_producto)||estaVacio($nombre_producto))
    {
        array_push($errores,"Debes ingresar el nombre del  producto");
    }
    elseif(!esVar($nombre_producto))
    {
      array_push($errores,"Debes ingresar un nombre válido");
    }

    if(!isset($existencias)||estaVacio($existencias))
    {
        array_push($errores,"Debes ingresar la cantidad");
    }elseif(!esEntero($existencias))
    {
        array_push($errores,"Ingresa numeros enteros");
    }

    if(!isset($precio)||estaVacio($precio))
    {
        array_push($errores,"Debes ingresar el precio del libro");
    }elseif(!esFloat($precio))
    {
        array_push($errores,"Ingresa el precio en enteros o decimales");
    }
    if(!isset($descripcion)||estaVacio($descripcion))
    {
        array_push($errores,"Debes ingresar ingresar una descripcion");
    }
    elseif(!esDescripcion($descripcion))
    {
      array_push($errores,"Debes ingresar la descripcion válida");
    }
    if (empty($filename))
    {
        array_push($errores,"Debes ingresar una imagen");
    }
    elseif(!empty($filename)){
        if (!( ($extension == "png" || $extension == "jpg" || $extension == "jpeg") && ($size < 2000000))) {
            array_push($errores,"Debes ingresar una imagen válida (png/jpg)");
           }
    }

    $producto['nombre_producto']=$nombre_producto;
    $producto['codigo_producto']=$codigo_producto;
    $producto['id_categoria']=$id_categoria;
    $producto['descripcion']=$descripcion;
    $producto['precio']=$precio;
    $producto['existencias']=$existencias;
    $producto['precio']=$precio;

    if(count($errores)>0)
    {
      $categoriasModel = new CategoriasModel();
      $viewBag['errores']=$errores;
      $viewBag['producto']=$producto;
      $viewBag['categorias']=$categoriasModel->get();
      $this->render("new.php",$viewBag);    
    }
    else{
        $producto['imagen']=$codigo_producto.'.'.$extension;
        $path="img";
        if(file_exists($path))
        {
            $dir=$path.'/'.$producto['imagen'];
            if(move_uploaded_file($temp,$dir))
            {
        if($this->modelo->create($producto)>0){
          header('Location: '.PATH.'/Productos/');}
          else
          {
            array_push($errores,"Ya existe un producto con este codigo");
            $viewBag['errores']=$errores;
            $categoriasModel = new CategoriasModel();
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['producto']=$producto;
            $this->render("new.php",$viewBag);
  
          }
        }
    }

      }
            }
        }
    }
?>