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
                <form method="POST" action="<?=PATH?>/Carritos/Pagar/<?=$producto['codigo_producto']?>/<?=$producto['id_carrito']?>">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h1 class=""><?=$producto['nombre_producto']?></h1>

                            <input type="hidden" name="nombre_producto" id="nombre_producto" value="<?=isset($producto)?$producto['nombre_producto']:''?>">
                                <input readonly type="hidden" name="id_carrito" id="id_carrito"  value="<?=isset($producto)?$producto['id_carrito']:''?>">
                                <input type="hidden" name="existencias" id="existencias" value="<?=isset($producto)?$producto['existencias']:''?>">
                                <input type="hidden" name="precio" id="precio" value="<?=isset($producto)?$producto['precio']:''?>">
                        </div>
                    </div>
                    <h3 >Total: <span class="text-primary mx-3" > $<?=$producto['precio']*$producto['cantidad']?></span> </h3>
                    <p class="card-text text-justify">CODIGO: <?=$producto['codigo_producto']?></p>
                    <?php 
                    if(isset($_SESSION['login_buffer']))
                    {
                        if($_SESSION['login_buffer']['id_tipo_usuario']==3){
                    ?>
                    <div class="form-group row my-2">
                        <div class="col-md-2 "> <input readonly   name="cantidad" value="<?=isset($producto)?$producto['cantidad']:''?>"  id="cantidad" class="number">
                        </div>
                        <button name="Cancelar" id="Cancelar" title="Cancelar" class="col-md-8 btn btn-success btn-block boton"></i>Cancelar</button>
                    </div>
                    <?php  }
                }?>

                </form>

                <div class="row my-3">
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
                <div class="row">
                <?php
                        if(isset($errores)){
                            if(count($errores)>0){
                                echo "<div class='alert alert-danger' style='color:#343a40'><ul>";
                                foreach ($errores as $error) {
                                    echo "<li  style='color:#343a40'>$error</li>";
                                }
                                echo "</ul></div>";

                            }
                        }

                   ?>
                </div>
               
            </div>



        </div>
        <?php
                        }
                
            ?>
    </div>
</body>

</html>