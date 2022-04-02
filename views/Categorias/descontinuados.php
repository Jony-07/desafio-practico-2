<?php require_once 'core/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de categorias</title>
  
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
                <h3>Categorias descontinuadas</h3>
            </div>
            <div class="col-md-12">
            <a type="button" class="btn btn-dark btn-md" href="<?=PATH?>/Categorias/create"><i class="bi bi-plus-square"></i>&nbsp; Agregar</a>
            </div>
            <div class="row mx-6 mt-5">
        <div class="col ml-5">
            <!-- <a class="edit" href="?c=products&a=Insert"><i class="bi bi-plus-square-fill"></i> Insertar</a> -->
            <div class="row mt-3">
                <table id="listado" class="table table-striped table-bordered table-hover table-responsive table-condensed">
                    <thead class="Te" style="background-color: #343a40; color:white">
                        <tr>
                            <th>ID categoria</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                   
                   foreach ($categoriax as $categoria)
                   {

                      
                   ?>
                        <tr < id="id_<?=$categoria['id_categoria']?>">
                            <td><?=$categoria['id_categoria']?></td>
                            <td><?=$categoria['nombre_categoria']?></td>

                            <td>
                                   
                            <center><a title="Activar" id="Recuperar" class="btn btn-primary btn-circle" href="<?=PATH?>/Categorias/Recuperar/<?=$categoria['id_categoria']?>"><i class="bi bi-arrow-counterclockwise"></i></span></a></center> 
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