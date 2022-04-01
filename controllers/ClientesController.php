<?php
require_once 'core/config.php';
include_once "controllers/Controller.php";
require_once "./models/ClientesModel.php";
    class ClientesController extends Controller
    {
        private $modelo;
        public function __construct()
        {
            $this->modelo = new ClientesModel();
        }
        public function index()
        {
        var_dump($this->modelo->get());
        }
    }
?>