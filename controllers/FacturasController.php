<?php
require_once "./models/ProductosModel.php";
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once 'models/CarritosModel.php';
require_once 'models/ProductosModel.php';
require_once 'models/ClientesModel.php';
require_once 'models/CategoriasModel.php';
require_once 'models/FacturasModel.php';
require_once "core/validaciones.php";
    class FacturasController extends Controller
    {

        private $modelo;
        public function __construct()
        {
            $this->modelo = new FacturasModel();
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
            $productosModel = new ProductosModel();
            $viewBag = array();
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
            $viewBag['categorias']=$categoriasModel->get();
            $viewBag['productos']=$this->modelo->GetMySales(sha1($_SESSION['login_buffer']['codigo_cliente']));
            $this->render("facturas.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }

        }
        public function Resumen()
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){
            $categoriasModel = new CategoriasModel();
            $productosModel = new ProductosModel();
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
            $this->render("reports.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
        }

        public function Ventas($id_producto,$id_factura,$codigo_cliente)
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==1){
            $productosModel = new ProductosModel();
            $clientesModel = new ClientesModel();
            $viewBag = array();
            extract($_POST);
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
            $viewBag['clientes']=$clientesModel->get($codigo_cliente);
            $viewBag['compras']=$productosModel->get($id_producto);
            $viewBag['productos']=$this->modelo->GetSpecificSales($id_factura);
            $this->render("reporte.php",$viewBag);
    
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }
        }

        public function Reportes($id_producto,$id_factura)
        {
            if(!isset($_SESSION['login_buffer']))
            {
             header("Location: ".PATH."/Usuarios/login") ;   
            }
            else{
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $productosModel = new ProductosModel();
            $clientesModel = new ClientesModel();
            $viewBag = array();
            if(isset($_SESSION['login_buffer']))
            {
                if($_SESSION['login_buffer']['id_tipo_usuario']==3){
            $carritosModel = new CarritosModel();
            $viewBag['quantity'] = $carritosModel->CountQuantity(sha1($_SESSION['login_buffer']['codigo_cliente']));
                }
            }
            $codigo=$_SESSION['login_buffer']['codigo_cliente'];
            $viewBag['clientes']=$clientesModel->get($codigo);
            $reporte['id_session']=sha1($_SESSION['login_buffer']['codigo_cliente']);
            $reporte['id_factura']=$id_factura;
            $viewBag['compras']=$productosModel->get($id_producto);
            $viewBag['productos']=$this->modelo->GetMySpecificSales($reporte);
            $this->render("reporte.php",$viewBag);
        }   else{
            header("Location: ".PATH."/Index/Default") ;
        }
    }

        }
    }
?>