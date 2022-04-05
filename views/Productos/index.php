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
                <h3>Lista de productos</h3>
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
                       <div class="row my-2">
                <div class="col-md-4">
            <a type="button" class="btn btn-md" style="background-color: #343a40; color:white" href="<?=PATH?>/Productos/create"><i class="bi bi-plus-square"></i>&nbsp; Agregar</a>
                </div>
                       </div>
            <?php   } }?>
           <div class="row my-2">
                <div class="col-md-4">
                <div class="input-group">
           <input type="search" class="form-control" name="buscador" id="buscador" placeholder="Buscar...">
           <div class="input-group-append">
               <span class="input-group-text">
               <i class="bi bi-search"></i>
               </span>
           </div>
        </div>
                </div>
                <div class="col-md-4">
                <a type="button" class="btn btn-md" style="background-color: #343a40; color:white" href="<?=PATH?>/Productos/Order/Desc"><i class="bi bi-arrow-down-square-fill"></i></i>&nbsp; Mayor precio</a>
                <a type="button" class="btn btn-md" style="background-color: #343a40; color:white" href="<?=PATH?>/Productos/Order/Asc"><i class="bi bi-arrow-up-square-fill"></i></i>&nbsp; Menor precio</a>
                </div>
           </div>


            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 my-3">
            <?php
                   
                    foreach ($productos as $producto)
                     {
                        if($producto['estado_categoria']==1)
                        {
                         $imagen=$producto['imagen'];
                        $path="img/".$imagen;
                        if(file_exists($path))
                        {
                            ?>
            <div class="col" id="id_<?=$producto['codigo_producto']?>">
                <div class="card carta shadow-sm prod">
                    <?php echo "<img src='".PATH."/img/$imagen' width='300px' height='250px' class='card-img-top'>"?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?=$producto['nombre_producto']?>
                        </h5>
                        <p class="card-text">Precio <?=$producto['precio']?> $</p>
                        <p class="card-text">Categoria: <?=$producto['nombre_categoria']?></p>
                        <?php
                                    if(($producto['existencias'])>0)
                                    {
                                        ?>
                        <p class="card-text ">Disponibilidad: <span style="color: green;"> en existencia</span></p>
                        <?php
                                    }
                                    else{
                                        ?>
                        <p class="card-text ">Disponibilidad: <span class="text-danger"> Fuera de stock</span></p>
                        <?php
                                    }
                                    ?>
                        <a href="<?=PATH?>/Productos/Detalles/<?=$producto['codigo_producto']?>" class="btn btn-primary">Ver
                            más</a>
                    </div>
                </div>
            </div>

            <?php
                        }
                    }  
                    }
                    ?>
                    <script src="<?=PATH?>/views/assets/js/search.js"></script>
        </div>               
        </div> 

    </body>
</html>