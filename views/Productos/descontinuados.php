<?php require_once 'core/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descontinuados</title>
  
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
                <h3>Lista de productos descontinuados</h3>
            </div>
          
            <div class="row mx-6 mt-5">
        <div class="col ml-5">
            <!-- <a class="edit" href="?c=products&a=Insert"><i class="bi bi-plus-square-fill"></i> Insertar</a> -->
            <div class="row mt-3">
                <table class="table table-striped table-bordered table-hover table-responsive table-condensed" id="listado">
                    <thead class="Te" style="background-color: #343a40; color:white">
                        <tr>
                            <th>Codigo Producto</th>
                            <th>Nombre</th>
                          
                            <th>Imagen</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Existencias</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                   
                   foreach ($productos as $producto)
                   {
                       if($producto['estado']==0)
                       {
                       $imagen=$producto['imagen'];
                      $path="img/".$imagen;
                      if(file_exists($path))
                      
                   ?>
                        <tr < id="id_<?=$producto['codigo_producto']?>">
                            <td><?=$producto['codigo_producto']?></td>
                            <td><?=$producto['nombre_producto']?></td>
                          
                            <td><?php echo "<img src='".PATH."/img/$imagen' width='200px' height='200px'>"?></td>
                            <td><?=$producto['nombre_categoria']?></td>
                            <td>$<?=$producto['precio']?></td>
                            <td><?=$producto['existencias']?></td>
                            <td>   
                            <center><a title="Activar" id="Recuperar" class="btn btn-primary btn-circle" href="<?=PATH?>/Productos/Recuperar/<?=$producto['codigo_producto']?>"><i class="bi bi-arrow-counterclockwise"></i></span></a></center> 
                            </td>
                        </tr>
                        <?php
                        }
                        elseif($producto['estado_categoria']==0)
                        {
                            $imagen=$producto['imagen'];
                            $path="img/".$imagen;
                            if(file_exists($path))
                            
                         ?>
                              <tr < id="id_<?=$producto['codigo_producto']?>">
                                  <td><?=$producto['codigo_producto']?></td>
                                  <td><?=$producto['nombre_producto']?></td>
                                
                                  <td><?php echo "<img src='".PATH."/img/$imagen' width='200px' height='200px'>"?></td>
                                  <td><?=$producto['nombre_categoria']?></td>
                                  <td>$<?=$producto['precio']?></td>
                                  <td><?=$producto['existencias']?></td>
                                  <td>   
                                    <center><a title="Activar" id="Recuperar" class="btn btn-danger btn-circle" href="<?=PATH?>/Categorias/Descontinuados"><i class="bi bi-arrow-counterclockwise"></i></span></a></center>  
                                  </td>
                              </tr>
                              <?php
                              }

                        
                    }
                    ?>
                    </tbody>
                </table>
            </div>              
        </div> 
            </div>
</div>
<script>
    $(document).ready(function () {
        $('#listado').DataTable();
    });
</script>
    </body>
</html>