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
                <h3>Categorias</h3>
            </div>
            <div class="col-md-12">
            <a type="button" class="btn btn-dark btn-md" href="<?=PATH?>/Categorias/create"><i class="bi bi-plus-square"></i>&nbsp; Agregar</a>
            </div>
            <div class="row mx-6 mt-5">
        <div class="col ml-5">
            <!-- <a class="edit" href="?c=products&a=Insert"><i class="bi bi-plus-square-fill"></i> Insertar</a> -->
            <div class="row mt-3">
                <table class="table table-striped table-bordered table-hover table-responsive table-condensed">
                    <thead class="Te" style="background-color: #343a40; color:white">
                        <tr>
                            <th>ID categoria</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                   
                   foreach ($categorias as $categoria)
                   {

                      
                   ?>
                        <tr < id="id_<?=$categoria['id_categoria']?>">
                            <td><?=$categoria['id_categoria']?></td>
                            <td><?=$categoria['nombre_categoria']?></td>

                            <td>
                                   
                                    <a title="Editar" class="btn btn-primary btn-circle" href="<?=PATH?>/Categorias/Edit/<?=$categoria['id_categoria']?>"><i class="bi bi-pencil-square"></i></span></a>
                                    <a title="Eliminar"  class="btn btn-danger btn-circle" href="<?=PATH?>/Categorias/Delete/<?=$categoria['id_categoria']?>"><i class="bi bi-trash3-fill"></i></span></a>
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
    </body>
</html>