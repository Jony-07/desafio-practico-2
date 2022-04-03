<?php require_once('core/config.php');
  $url = explode("/", $_SERVER['REQUEST_URI']);
  $correo = empty($url[4])?'':$url[4];
  $clave = empty($url[5])?'':$url[5];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include 'views/header.php';
    ?>
    <title>Recuperar Cuenta</title>
    <link rel="stylesheet" href="<?=PATH?>/views/assets/css/comprobante.css">
</head>

<body>
<?php
        include 'views/menu.php';
    ?>
<div class="d-flex justify-content-center">
        <div class="col-md-6 my-5">
       
                <form action="<?=PATH?>/Usuarios/Comprobando/<?=$correo?>/<?=$clave?>" class="formulario" method="POST" role="form"> 
                    <div class="form-group text-center">
                    </div>
                    <br>        
                    <div class="form-group text-center" >
                        <input type="submit" value="Iniciar Sesión" class="boton" id="iniciar" name="iniciar">
                    </div>

                    <div class="form-group text-center my-2">
                        <a href="<?=PATH?>"  style="color:#343a40" class="edit"><i class="bi bi-reply-fill"></i>Regresar</a>
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