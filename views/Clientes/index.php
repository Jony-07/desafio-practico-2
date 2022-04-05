<?php require_once 'core/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>
  
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
                <h3>Clientes</h3>
            </div>
            <div class="row mx-6 mt-5">
        <div class="col ml-5">
            <!-- <a class="edit" href="?c=products&a=Insert"><i class="bi bi-plus-square-fill"></i> Insertar</a> -->
            <div class="row mt-3">
                <table id="listado" class="table table-striped table-bordered table-hover table-responsive table-condensed">
                    <thead class="Te" style="background-color: #343a40; color:white">
                        <tr>
                            <th>DUI</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                   
                   foreach ($clientes as $cliente)
                   {

                      
                   ?>
                        <tr < id="id_<?=$cliente['codigo_cliente']?>">
                            <td><?=$cliente['nombre']?></td>
                            <td><?=$cliente['apellido']?></td>
                            <td><?=$cliente['telefono']?></td>
                            <td><?=$cliente['correo']?></td>

                            <td>
                                <center>
                                <?php if($cliente['nombre_estado']=='Habilitado') {?>
                                    <a title="Editar"  class="btn btn-danger btn-circle" href="<?=PATH?>/Clientes/Actualizar/<?=$cliente['codigo_cliente']?>"><i class="bi bi-arrow-counterclockwise"></i></span></a>
                                <?php }elseif($cliente['nombre_estado']=='Deshabilitado'){?>
                                    <a title="Editar"  class="btn btn-primary btn-circle" href="<?=PATH?>/Clientes/Actualizar/<?=$cliente['codigo_cliente']?>"><i class="bi bi-arrow-counterclockwise"></i></span></a>
                                        <?php }?>
                                </center>
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