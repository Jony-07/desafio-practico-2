<?php require_once 'core/config.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo producto</title>
    <?php
        include 'views/header.php';
    ?>
</head>

<body>
<?php
        include 'views/menu.php';
    ?>
    <div class="d-flex justify-content-center">
        <div class="col-md-10 my-5">
        <legend style="color:#084594" class="text-center text-dark">Ingresar Producto</legend>
                        <form method="POST" action="<?=PATH?>/Productos/add" enctype="multipart/form-data" class="formulario">
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
                   <table class="table table-borderless">
                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                <div class="mb-3" style="color:#084594">
                <label class="control-label" for="codigo_producto">Codigo:</label>
                <input type="text" class="form-control" value="<?=isset($producto)?$producto['codigo_producto']:''?>" name="codigo_producto" id="codigo_producto">
                </div>
                                </td>
                            <td>
                <div class="mb-3" style="color:#084594">
                <label class="control-label" for="nombre_producto">Nombre:</label>
                <input type="text" class="form-control" value="<?=isset($producto)?$producto['nombre_producto']:''?>"  name="nombre_producto" id="nombre_producto">
                </div>
                            </td>

                            </tr>
                            <tr>
                                <td>
                <div class="mb-3" style="color:#084594">
                <label class="control-label" for="descripcion">Descripcion:</label>
                <textarea class="form-control" name="descripcion" id="descripcion" cols="35" rows="2"><?=isset($producto)?$producto['descripcion']:''?></textarea>
                </div>
                                </td>
                                <td>
                <div class="mb-3" style="color:#084594">
                <label for="imagen" class="form-label" for="imagen">Imagen</label>
                <input type="file" class="form-control" name="imagen">
                </div>
                                </td>
                            </tr>

                        <tr>
                            <td> <div class="mb-3" style="color:#084594">
                <label for="floatingSelect" class="form-label" for="id_categoria">Categoria</label>
                <div class="form-floating">
                <select class="form-select" name="id_categoria" id="id_categoria" aria-label="Floating label select example">
                <?php
                                    foreach($categorias as $categoria){
                                ?>
                                    <option value="<?=$categoria['id_categoria']?>"><?=$categoria['nombre_categoria']?></option>
                                    <?php } ?>  
                </select>
                    </div>
                </div></td>
                            <td>
                <div class="mb-3" style="color:#084594">
                <label class="control-label" for="precio">Precio:</label>
                <input type="number" step="0.01" value="<?=isset($producto)?$producto['precio']:''?>" class="form-control" name="precio" id="precio">
                </div>
                            </td>
                        </tr>
                <tr>
                    <td>
                <div class="mb-3" style="color:#084594">
                <label class="control-label" for="existencias">Existencias:</label>
                <input type="number" value="<?=isset($producto)?$producto['existencias']:''?>" class="form-control" name="existencias" id="existencias">
                </div>
                    </td>
                    <td>
                    <div class="mb-3" style="color:#084594">
                <input type="hidden" class="form-control" value="" readonly name="ID_PC" id="ID_PC">
                </div>
                <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-dark" value="Guardar" name="Guardar"> &nbsp;
                        <a class="btn btn-danger" href="<?= PATH ?>/Productos/Listado">Cancelar</a>
                </div>
                    </td>
                </tr>


               
               
               

        </div>
    </div>

    </tbody>
                    </table>

    </form>
    </div>


    </div>
    </div>
</body>

</html>