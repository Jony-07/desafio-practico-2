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
        $viewBag['categorias']=$categoriasModel->get();
        $this->render("index.php",$viewBag);
    }
}

?>