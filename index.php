<?php
include_once "./core/routing.php";
include_once "./core/config.php";
include_once "./controllers/IndexController.php";
include_once "./controllers/Controller.php";
include_once "./controllers/ProductosController.php";
include_once "./controllers/ClientesController.php";
include_once "./controllers/UsuariosController.php";
include_once "./controllers/CategoriasController.php";
include_once "./controllers/TipoUsuarioController.php";
include_once "./controllers/CarritosController.php";
include_once "./controllers/FacturasController.php";
$router = new Routing();
/*
echo "Controlador: $router->controller";
echo "<br>Method: $router->method";
echo "<br>Param: $router->param";
$controlador = new $router -> controller;
*/
$controller=$router->controller;
$method=$router->method;
$param=$router->param;
$param2=$router->param2;
$param3=$router->param3;
session_start();
error_reporting(0);
$controller=new $controller;
$controller->$method($param,$param2,$param3);


