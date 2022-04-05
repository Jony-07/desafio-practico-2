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
                <h3>Usuarios</h3>
            </div>
            <div class="row mx-6 mt-5">
        <div class="col ml-5">
            <!-- <a class="edit" href="?c=products&a=Insert"><i class="bi bi-plus-square-fill"></i> Insertar</a> -->
            <div class="row mt-3">
                <table id="listado" class="table table-striped table-bordered table-hover table-responsive table-condensed">
                    <thead class="Te" style="background-color: #343a40; color:white">
                        <tr>
                            <th>Codigo</th>
                            <th>Nickname</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                   
                   foreach ($usuarios as $usuario)
                   {

                      
                   ?>
                        <tr < id="id_<?=$usuario['codigo_usuario']?>">
                            <td><?=$usuario['codigo_usuario']?></td>
                            <td><?=$usuario['nombre']?></td>
                            <td><?=$usuario['telefono']?></td>
                            <td><?=$usuario['correo']?></td>

                            <td>
                                <center>
                                <?php if($usuario['nombre_estado']=='Habilitado') {?>
                                    <a title="Editar"  class="btn btn-danger btn-circle" href="<?=PATH?>/Usuarios/Actualizar/<?=$usuario['codigo_usuario']?>"><i class="bi bi-arrow-counterclockwise"></i></span></a>
                                <?php }elseif($usuario['nombre_estado']=='Deshabilitado'){?>
                                    <a title="Editar"  class="btn btn-primary btn-circle" href="<?=PATH?>/Usuarios/Actualizar/<?=$usuario['codigo_usuario']?>"><i class="bi bi-arrow-counterclockwise"></i></span></a>
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