<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include 'views/header.php';
    ?>
    <title>Cliente</title>
</head>

<body>
<?php
        include 'views/menu.php';
    ?>
    <div class="row mx-5 mt-5 my-4">
        <div class="col ml-5">
            <div class="row mt-3">
                <form method="POST" action="<?=PATH?>/Clientes/Editar" enctype="multipart/form-data" class="">
                <?php
                   if(isset($errores))
                   {
                       if(count($errores)>0)
                       {
                        echo "<div class='alert alert-danger' style='color:#343a40' ><ul>";
                           foreach ($errores as $error) {
                               echo "<li style='color:#343a40'>$error</li>";
                           }
                           echo "</ul></div>";
                       }
                   }
                   ?>
  <?php  foreach ($clientes as $cliente)
                     {?>
                    <table class="table table-borderless">
                        <thead>
                            <tr>

                                <th scope="col"></th>
                                <th scope="col" style="color: #343a40;">INFORMACION PERSONAL</th>
                                <th scope="col"></th>
                                <th scope="col" style="color: #343a40;">
                                    DATOS DE INICIO DE SESIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="codigo_cliente" class="form-label">DUI</label>
                                        <input type="text" class="form-control" id="codigo_cliente" placeholder="00470129-3" value="<?=isset($cliente)?$cliente['codigo_cliente']:''?>" name="codigo_cliente"
                                            id="DUI">
                                    </div>
                                </td>
                                <td></td>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input type="text" class="form-control"
                                            placeholder="Ingrese su Correo Electronico" name="correo" value="<?=isset($cliente)?$cliente['correo']:''?>" id="correo">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="nombre_cliente" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" placeholder="Ingrese su nombre"
                                            name="nombre_cliente" id="nombre_cliente" value="<?=isset($cliente)?$cliente['nombre']:''?>">
                                    </div>
                                </td>
                                <td></td>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">                            
                                        <label for="clave" class="form-label">Nueva clave</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Ingrese su Clave" name="clave" id="clave">
                                        <div class="input-group-append">
                                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                                        <i class="bi bi-eye-slash-fill icon"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" placeholder="Ingrese Apellido"
                                            name="apellido" id="apellido" value="<?=isset($cliente)?$cliente['apellido']:''?>">
                                    </div>
                                </td>
                                <td></td>
                                <td>
                                    <!-- <div class="form-group mx-sm-4 pt-3">
                                        <label for="exampleInputPassword1" class="form-label">Confirmar clave</label>
                                        <input type="text" class="form-control" placeholder="Confirme su clave"
                                            name="SPassword" id="SPassword">
                                    </div> -->
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="telefono" class="form-label">Numero De Telefono</label>
                                        <input type="text" class="form-control"
                                            placeholder="7083-6536" name="telefono" value="<?=isset($cliente)?$cliente['telefono']:''?>" id="telefono">
                                    </div>
                                </td>
                                <td></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="my-2">
                                        <input type="submit" class="btn btn-dark" value="Guardar" name="Guardar"> &nbsp;
                        <a class="btn btn-danger" href="<?= PATH ?>">Cancelar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="direccion" class="form-label">Direccion</label>
                                        <input type="text" class="form-control" placeholder="Ingrese su direccion"
                                            name="direccion" id="direccion" value="<?=isset($cliente)?$cliente['direccion']:''?>">
                                    </div>
                                </td>
                                <td><div class="form-group mx-sm-4 pt-3">
                                        <input type="hidden" class="form-control" placeholder="Ingrese su direccion"
                                            name="Verificar" id="Verificar" value="0">
                                    </div></td>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            </form>
            <?php }?>
            <script type="text/javascript">
            function mostrarPassword(){
		    var cambio = document.getElementById("clave");
		    if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('bi bi-eye-slash-fill').addClass('bi bi-eye-fill');
		    }else{
			cambio.type = "password";
			$('.icon').removeClass('bi bi-eye-fill').addClass('bi bi-eye-slash-fill');
		    }
	        } 
            </script>
</html>