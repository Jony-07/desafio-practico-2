<?php require_once('core/config.php');?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Recuperar Cuenta</title>
    <link rel="stylesheet" href="<?=PATH?>/views/assets/css/active.css">
    <?php
        include 'views/header.php';
    ?>
</head>

<body>
<?php
        include 'views/menu.php';
    ?>
    <div class="container">
        <div class="row justify-content-center pt-5 mt-5 mr-1 my-5">
          
        <div class="col-md-5 ">
           <form class="formulario" action="<?=PATH?>/Usuarios/Activando" method="POST" role="form"> 
                    <div class="form-group text-center">
                        <h3 class="text-" style="color:#343a40">Verificar Cuenta</h3>
                    </div>        
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
                    <div class="form-group mx-sm-4 pb-3 my-2">
                        <input type="text" class="form-control"  value="<?=isset($correo)?$correo:''?>" placeholder="Ingrese su Email" name="correo" id="correo">
                    </div>
                    <div class="form-group mx-sm-4 pb-2 my-2">
                       <center><input type="submit" value="Confirmar" name="Confirmar" id="Confirmar" class="btn btn-block btn-dark"></center>
                    </div>
                    <div class="form-group text-center my-2">
                        <a href="<?=PATH?>/Usuarios/Login"  style="color:#343a40"><i class="bi bi-reply-fill"></i>Regresar</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>