<?php
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/UsuariosModel.php";
    class UsuariosController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new UsuariosModel();
        }
        public function index()
        {
        var_dump($this->modelo->get());
        }
    }
?>