<?php require_once 'core/config.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria</title>
    <?php
        include 'views/header.php';
    ?>
</head>

<body>
<?php
        include 'views/menu.php';
    ?>
    <div class="d-flex justify-content-center">
        <div class="col-md-4 my-5">
        <legend style="color:#084594" class="text-center text-dark">Editar categoria</legend>
        <?php  foreach ($categoriax as $categorix)
                     {?>
                        <form method="POST" action="<?=PATH?>/Categorias/Editar/<?=$categorix['id_categoria']?>" enctype="multipart/form-data" class="formulario">
                <div class="form-group text-center">

                </div>
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


                <div class="mb-3" style="color:#084594">
                <label class="control-label" for="id_categoria">ID categoria:</label>
                <input readonly type="text" class="form-control" value="<?=isset($categorix)?$categorix['id_categoria']:''?>" name="id_categoria" id="id_categoria">
                </div>

                <div class="mb-3" style="color:#084594">
                <label class="control-label" for="nombre_categoria">Nombre de categoria:</label>
                <input type="text" class="form-control" value="<?=isset($categorix)?$categorix['nombre_categoria']:''?>"  name="nombre_categoria" id="nombre_categoria">
                </div>

                    <div class="mb-3" style="color:#084594">
                <input type="hidden" class="form-control" value="" readonly name="ID_PC" id="ID_PC">
                </div>
                <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-dark" value="Actualizar" name="Actualizar"> &nbsp;
                        <a class="btn btn-danger" href="<?= PATH ?>/Categorias">Cancelar</a>
                </div>



               
               
               

        </div>
    </div>


    </form>
    <?php }?>
    </div>


    </div>
    </div>
</body>

</html>