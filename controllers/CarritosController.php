<?php
include_once "controllers/Controller.php";
require_once 'core/config.php';
require_once 'models/CarritosModel.php';
require_once 'models/ProductosModel.php';
require_once 'models/ClientesModel.php';
require_once 'models/CategoriasModel.php';
class CarritosController extends Controller {
    private $modelo;

    public function __construct()
    {
        $this->modelo = new CarritosModel();
    }

    public function Index()
    {
        $categoriasModel = new CategoriasModel();
        $viewBag = array();
        if(isset($_SESSION['login_buffer']))
        {
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $carritosModel = new CarritosModel();
        $viewBag['quantity'] = $carritosModel->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
            }
        }
        $viewBag['categorias']=$categoriasModel->get();
        $viewBag['productos']=$this->modelo->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
        $this->render("index.php",$viewBag);
    }

    public function Remover($cod)
    {
        $categoriasModel = new CategoriasModel();
        $viewBag = array();
        if(isset($_SESSION['login_buffer']))
        {
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $carritosModel = new CarritosModel();
        $viewBag['quantity'] = $carritosModel->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
            }
        }
        $carrito['id_session']=sha1($_SESSION['login_buffer']['codigo_cliente']);
        $carrito['codigo_producto']=$cod;
        $viewBag['categorias']=$categoriasModel->get();
        if($this->modelo->delete($carrito)>0)
        {
            header("Location: ".PATH."/Carritos");
        }


    }

    public function Editar($cod)
    {
        $categoriasModel = new CategoriasModel();
        $viewBag = array();
        if(isset($_SESSION['login_buffer']))
        {
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $carritosModel = new CarritosModel();
        $viewBag['quantity'] = $carritosModel->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
            }
        }
        $viewBag['categorias']=$categoriasModel->get();
        $viewBag['productos']=$this->modelo->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
        $this->render("detalles.php",$viewBag);
    }

    public function Actualizar($id)
    {
        $categoriasModel = new CategoriasModel();
        $viewBag = array(); 
        $errores = array();
        if(isset($_SESSION['login_buffer']))
        {
            if($_SESSION['login_buffer']['id_tipo_usuario']==3){
        $carritosModel = new CarritosModel();
        $viewBag['quantity'] = $carritosModel->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
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

            if(count($errores)>0)
            {
                $viewBag['errores']=$errores;
                $viewBag['categorias']=$categoriasModel->get();
                $viewBag['productos']=$this->modelo->GetArray($carrito);
                $carritosModel = new CarritosModel();
                $viewBag['quantity'] = $carritosModel->get(sha1($_SESSION['login_buffer']['codigo_cliente']));
                $this->render("detalles.php",$viewBag);
            }
            else{
                $carrito_tuneado['id_session']=sha1($_SESSION['login_buffer']['codigo_cliente']);
                $carrito_tuneado['codigo_producto']=$id;
                $carrito_tuneado['cantidad']=$cantidad;
                if($this->modelo->update($carrito_tuneado)>0)
                {
                    header("Location: ".PATH."/Carritos");
                }
            }
        }
    }
}

?>