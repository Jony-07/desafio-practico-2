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

        }
    }
?>