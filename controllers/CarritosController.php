<?php
include_once "controllers/Controller.php";
require_once 'core/config.php';
require_once 'models/CarritosModel.php';
require_once 'models/ProductosModel.php';
require_once 'models/ClientesModel.php';
require_once 'models/CategoriasModel.php';
require_once 'models/FacturasModel.php';
class CarritosController extends Controller {
    private $modelo;

    public function __construct()
    {
        $this->modelo = new CarritosModel();
    }

    public function Index()
    {
        if(!isset($_SESSION['login_buffer']))
        {
         header("Location: ".PATH."/Usuarios/login") ;   
        }
        else{
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
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
        $viewBag['productos']=$this->modelo->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
        $this->render("index.php",$viewBag);
    }   else{
        header("Location: ".PATH."/Index/Default") ;
    }
}
    }

    public function Comprobantes()
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
        $viewBag['productos']=$this->modelo->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
        $this->render("index.php",$viewBag);
    }


    public function Remover($cod,$id_carrito)
    {
        if(!isset($_SESSION['login_buffer']))
        {
         header("Location: ".PATH."/Usuarios/login") ;   
        }
        else{
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $categoriasModel = new CategoriasModel();
        $viewBag = array();
        if(isset($_SESSION['login_buffer']))
        {
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $carritosModel = new CarritosModel();
        $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
            }
        }
        $carrito['id_carrito']=$id_carrito;
        $carrito['id_session']=sha1($_SESSION['login_buffer']['codigo_cliente']);
        $carrito['codigo_producto']=$cod;
        $viewBag['categorias']=$categoriasModel->get();
        if($this->modelo->delete($carrito)>0)
        {
            header("Location: ".PATH."/Carritos");
        }
    }   else{
        header("Location: ".PATH."/Index/Default") ;
    }
}


    }

    public function Editar($cod,$id)
    {
        if(!isset($_SESSION['login_buffer']))
        {
         header("Location: ".PATH."/Usuarios/login") ;   
        }
        else{
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
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
        $viewBag['productos']=$this->modelo->getEle($id);
        $this->render("detalles.php",$viewBag);
    }   else{
        header("Location: ".PATH."/Index/Default") ;
    }
}
    }

    public function Cancelar($cod,$id)
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
        $viewBag['productos']=$this->modelo->getEle($id);
        $this->render("cancelar.php",$viewBag);
    }

    public function generate_code($id,$lenght=15)
{
    $facturasModel = new FacturasModel();
    $key = "";
    $pattern = "1234567890";
    $max = strlen($pattern)-1;
    do {
        for($i = 0; $i < $lenght; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        $rows = count($facturasModel->Comprobate($key));
    } while ($rows > 0);
    return $key;            
}

    public function Pagar($id,$carrito)
    {
        if(!isset($_SESSION['login_buffer']))
        {
         header("Location: ".PATH."/Usuarios/login") ;   
        }
        else{
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        date_default_timezone_set("America/El_Salvador");
        $categoriasModel = new CategoriasModel();
        $facturasModel = new FacturasModel();
        $productosModel = new ProductosModel();
        $viewBag = array(); 
        $errores = array();
        if(isset($_SESSION['login_buffer']))
        {
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $carritosModel = new CarritosModel();
        $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
            }
        }
        if(isset($_POST['Cancelar']))
        {
            extract($_POST);
            $factura['id_factura']=$this->generate_code($id);
            $factura['fecha']=date('Y/m/d h:i:s', time());
            $factura['codigo_cliente']=$_SESSION['login_buffer']['codigo_cliente'];
            $factura['id_carrito']=$carrito;
            $factura['total']=$cantidad*$precio;
            $existencias=$existencias-$cantidad;
            $codigo_producto=$id;
            if($facturasModel->create($factura)>0)
            {
                if($productosModel->updateExistencias($existencias,$codigo_producto)>0)
                {
                    $carro['codigo_producto']=$id;
                    $carro['id_carrito']=$carrito;
                    if($carritosModel->cancelado($carro))
                    {
                        header("Location: ".PATH."/Carritos");
                    }
                }
            }
            else{
                echo "Algo pasa";
                var_dump($factura);
            }
        } 
    }   else{
        header("Location: ".PATH."/Index/Default") ;
    }
}
    }

    public function Actualizar($id,$cod)
    {
        if(!isset($_SESSION['login_buffer']))
        {
         header("Location: ".PATH."/Usuarios/login") ;   
        }
        else{
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $categoriasModel = new CategoriasModel();
        $viewBag = array(); 
        $errores = array();
        if(isset($_SESSION['login_buffer']))
        {
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $carritosModel = new CarritosModel();
        $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
            }
        } 
        if(isset($_POST['Actualizar']))
        {
            extract($_POST);
            if(!isset($cantidad)||estaVacio($cantidad))
            {
                array_push($errores,"No haz ingresado la cantidad que deseas de este producto");
            }elseif(!esEntero($cantidad))
            {
                array_push($errores,"La cantidad que escojas debe ser mayor a cero");
            }

            $carrito['id_session']=sha1($_SESSION['login_buffer']['codigo_cliente']);
            $carrito['nombre_producto']=$nombre_producto;
            $carrito['id_carrito']=$id_carrito;

            if(count($errores)>0)
            {
                $viewBag['errores']=$errores;
                $viewBag['categorias']=$categoriasModel->get();
                $viewBag['productos']=$this->modelo->GetArray($nombre_producto,$id_carrito);
                $carritosModel = new CarritosModel();
                $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                $this->render("detalles.php",$viewBag);
            }
            else{
                $carrito_tuneado['id_carrito']=$id_carrito;
                $carrito_tuneado['codigo_producto']=$id;
                $carrito_tuneado['cantidad']=$cantidad;
                if($this->modelo->update($carrito_tuneado)>0)
                {
                    header("Location: ".PATH."/Carritos");
                }
                else{
                    header("Location: ".PATH."/Carritos");
                }
            }
        }
    }   else{
        header("Location: ".PATH."/Index/Default") ;
    }
}
    }
}

?>