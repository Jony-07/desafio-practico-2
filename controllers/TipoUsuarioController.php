<?php
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/TipoUsuarioModel.php";
    class TipoUsuarioController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new TipoUsuarioModel();
        }
        public function index()
        {
        var_dump($this->modelo->get());
        }
    }
?>