<?php require_once 'core/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de productos</title>
  
    <?php
        include 'views/header.php';
    ?>
</head>
<body>
<?php
        include 'views/menu.php';
    ?>

<div class="container">
            <div class="row my-5">
                <h3>Lista de deseos</h3>
            </div>

            <div class="col-md-12">

            <?php
             if(!isset($_SESSION['login_buffer']))
             {
              header("Location: ".PATH."/Usuarios/login") ;   
             }
             else{
                 if($_SESSION['login_buffer']['id_tipo_usuario']!=3){
            ?>
            <a type="button" class="btn btn-md" style="background-color: #343a40; color:white" href="<?=PATH?>/Productos/create"><i class="bi bi-plus-square"></i>&nbsp; Agregar</a>
           <?php   } }?>
           
            <input type="search" name="buscador" id="buscador" placeholder="Buscar...">
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 my-3">
            <?php
                   
                    foreach ($productos as $producto)
                     {

                         $imagen=$producto['imagen'];
                        $path="img/".$imagen;
                        if(file_exists($path))
                        {
                            if(($producto['nombre_estado_pago'])=="Pendiente")
                            {
                            ?>
                            <form action="<?=PATH?>/Remover"  method="POST">
                            <input type="hidden" name="id_carrito" id="id_carrito"  value="<?=isset($producto)?$producto['id_carrito']:''?>" >
            <div class="col" id="id_<?=$producto['codigo_producto']?>">
                <div class="card shadow-sm prod">
                    <?php echo "<img src='".PATH."/img/$imagen' width='300px' height='250px' class='card-img-top'>"?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?=$producto['nombre_producto']?>
                        </h5>
                        <p class="card-text">Total: <?=$producto['precio']*$producto['cantidad']?> $</p>
                        <?php
                                    if(($producto['nombre_estado_pago'])=="Cancelado")
                                    {
                                        ?>
                        <p class="card-text ">Estado: <span style="color: green;">Cancelado</span></p>
                        <?php
                                    }
                                    else{
                                        ?>
                        <p class="card-text ">Estado: <span class="text-danger"> Pendiente</span></p>
                        <?php
                                    }
                                    ?>
                        <a href="<?=PATH?>/Carritos/Cancelar/<?=$producto['codigo_producto']?>/<?=$producto['id_carrito']?>" class="btn btn-success">Pagar</a> &nbsp;
                        <a href="<?=PATH?>/Carritos/Editar/<?=$producto['codigo_producto']?>/<?=$producto['id_carrito']?>" class="btn btn-primary">Editar</a> &nbsp;
                        <a href="<?=PATH?>/Carritos/Remover/<?=$producto['codigo_producto']?>/<?=$producto['id_carrito']?>" class="btn btn-warning">Quitar</a>
                    </div>
                </div>
            </div>
            </form>

            <?php }
                        }
                    
                    }
                    ?>
                    <script src="<?=PATH?>/views/assets/js/search.js"></script>
        </div>               
        </div> 

    </body>
</html>