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
                <h3>Comprobantes</h3>
            </div>

            <div class="row mx-6 mt-5">
        <div class="col ml-5">
            <!-- <a class="edit" href="?c=products&a=Insert"><i class="bi bi-plus-square-fill"></i> Insertar</a> -->
            <div class="row mt-3">
                       
               
                <table class="table table-striped table-bordered table-hover table-responsive table-condensed" id="listado">
                    <thead class="Te" style="background-color: #343a40; color:white">
                        <tr>
                            <th>Fecha de compra</th>
                            <th>Codigo de producto</th>
                            <th>Precio/Unidad</th>
                            <th>Unidades</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                   foreach ($productos as $producto)
                   {
                    
                   ?>
                   
                        <tr < id="id_<?=$producto['codigo_producto']?>">
                            <td><?=$producto['fecha']?></td>
                            <td><?=$producto['codigo_producto']?></td>
                            
                            <td><?=$producto['total']/$producto['cantidad']?></td>
                            <td><?=$producto['cantidad']?></td>
                            <td><?=$producto['total']?></td>
                            <td>  

                         <center><a title="Ver más" class="btn btn-primary btn-circle" href="<?=PATH?>/Facturas/Reportes/<?=$producto['codigo_producto']?>/<?=$producto['id_factura']?>"><i class="bi bi-eye-fill"></i></span></a></center>
  
                        </td>
                        </tr>

                        <?php
                        
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