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
        $this->render("index.php");
    }
}

?>