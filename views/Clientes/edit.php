<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include 'views/header.php';
    ?>
    <title>Usuario</title>
</head>

<body>
<?php
        include 'views/menu.php';
    ?>
    <div class="row mx-5 mt-5 my-4">
        <div class="col ml-5">
            <div class="row mt-3">
            <?php  foreach ($clientes as $cliente)
                     {?>
                <form method="POST" action="<?=PATH?>/Clientes/Update/<?=$cliente['codigo_cliente']?>" enctype="multipart/form-data" class="">
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

                             <legend style="color:#084594" class="text-center text-dark">Usuario <?=$cliente['nombre']?>  <?=$cliente['apellido']?></legend>
                    <table class="table table-borderless">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="codigo_cliente" class="form-label">Codigo cliente</label>
                                        <input readonly type="text" class="form-control" id="codigo_cliente" placeholder="U123" value="<?=isset($cliente)?$cliente['codigo_cliente']:''?>" name="codigo_cliente">
                                    </div>
                                </td>
                                <td></td>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="id_estado" class="form-label">Estado</label>
                                        <select class="form-select" name="id_estado" id="id_estado" aria-label="Floating label select example">
                                        <?php
                                    foreach($estados as $estado){
                                        if($estado['nombre_estado']==$cliente['nombre_estado']){
                                ?>
                                 <option selected value="<?=$estado['id_estado']?>"><?=$estado['nombre_estado']?></option>
                                <?php } else{ ?>
                                    <option value="<?=$estado['id_estado']?>"><?=$estado['nombre_estado']?></option>
                                    <?php }}?>  
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input readonly type="text" class="form-control" placeholder="Ingrese su nombre"
                                            name="nickname" id="nombre" value="<?=isset($cliente)?$cliente['nombre']:''?>"">
                                    </div>
                                </td>
                                <td></td>

                               <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="telefono" class="form-label" >Numero De Telefono</label>
                                        <input type="text" class="form-control"
                                            placeholder="7083-6536" name="telefono" readonly value="<?=isset($cliente)?$cliente['telefono']:''?>" id="telefono">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <div class="form-group mx-sm-4 pt-3">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input readonly type="text" class="form-control"
                                            placeholder="Ingrese su Correo Electronico" name="correo" value="<?=isset($cliente)?$cliente['correo']:''?>" id="correo">
                                    </div>
                                </td>
                                <td></td>

                                
                            </tr>
                            <tr>
                                <th scope="row"></th>

                                <td></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="my-2">
                                        <input type="submit" class="btn btn-dark" value="Guardar" name="Guardar"> &nbsp;
                        <a class="btn btn-danger" href="<?= PATH ?>/Clientes/Estado/<?=$cliente['nombre_estado']?>">Cancelar</a>
                                        </div>
                                    </div>
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