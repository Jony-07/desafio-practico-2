<?php
require_once "./models/ProductosModel.php";
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/CategoriasModel.php";
    class ProductosController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new ProductosModel();
        }
        public function index()
        {
            $viewBag = array();
            $viewBag['productos']=$this->modelo->get();
            $this->render("index.php",$viewBag);
        }
    }
?>