<?php require_once 'core/config.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="<?=PATH?>/views/assets/css/details.css">
    
    <?php
        include 'views/header.php';
    ?>
</head>

<body>
<?php
        include 'views/menu.php';
    ?>
    <div class="container">
        <?php foreach($productos as $producto)

                                $path="img/".$producto['imagen'];
                                if(file_exists($path))
                        {
                            ?>
        <div class="row justify  mt-4 mr-1">
            <div class="col-md-6">



                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?php echo "<img src='".PATH."/img/".$producto['imagen']."'  class='rounded float-start col-md-10'>"?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <form method="POST" action="?c=productos&a=detailsst&cod=<?=$producto['codigo_producto']?>">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h1 class=""><?=$producto['nombre_producto']?></h1>



                        </div>
                    </div>
                    <h3 class="text-primary mx-3">$<?=$producto['precio']?></h3>
                    <p class="card-text text-justify">CODIGO: <?=$producto['codigo_producto']?> / CATEGORI: <?=$producto['nombre_categoria']?></p>
                    <div class="form-group row my-2">
                        <div class="col-md-2 "> <input type="number" name="cantidad"  id="cantidad" class="number">
                        </div>
                        <a href="" class="col-md-8 btn btn-success btn-block boton"></i>Agregar al Carrito</a>
                    </div>

                </form>

                <div class="row">
                    <div class="card">
                        <h5 class="card-header">Información</h5>
                        <div class="card-body">
                            <?php
                                    if(($producto['existencias'])>0)
                                    {
                                        ?>
                            <h5 class="card-text ">Disponibilidad: <span class="text-success"> En existencia</span></h5>
                            <?php
                                    }
                                    else{
                                        ?>
                            <p class="card-text ">Disponibilidad: <span class="text-danger"> Fuera de stock</span></p>
                            <?php
                                    }
                                    ?>
                            <h6 class="card-text text-justify">Descripcion: <?=$producto['descripcion']?></h6>
                        </div>

                    </div>
                </div>
            </div>



        </div>
        <?php
                        }
                
            ?>
    </div>
</body>

</html>