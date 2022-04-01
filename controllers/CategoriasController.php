<?php
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/CategoriasModel.php";
    class CategoriasController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new CategoriasModel();
        }
        public function index()
        {
        var_dump($this->modelo->get());
        }
    }
?>