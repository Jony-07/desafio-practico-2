<?php
include_once "controllers/Controller.php";
require_once 'core/config.php';
class IndexController extends Controller {
    private $modelo;

    public function __construct()
    {
    }

    public function Index()
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
        $this->render("index.php",$viewBag);
    }

    public function Default()
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
        $this->render("default.php",$viewBag);
    }
}

?>