
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?=PATH?>/views/assets/css/login.css">
    <?php
        include 'views/header.php';
    ?>
</head>

<body>
<?php
        include 'views/menu.php';
    ?>
    <div class="container">
       
        <div class="row justify-content-center pt-5 mt-5 mr-1">
            <div class="col-md-4 ">
                <form class="formulario" action="<?=PATH?>/Usuarios/Validate" method="POST" role="form">
                    <div class="form-group text-center">
                        <h3 class="text-" style="color:#084594">Iniciar Sesion</h3>
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
                    <div class="form-group mx-sm-4 pt-3 my-3">
                        <input type="text" class="form-control" placeholder="Ingrese su Correo Electronico"
                            name="usuario" id="usuario">
                    </div>

                    <div class="form-group my-3 mx-sm-4 pb-6">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Ingrese su Contraseña" id="clave" name="clave"
                            id="i_pass">
                            <div class="input-group-append">
                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="bi bi-eye-slash-fill icon"></span> </button>
                    </div>
                    </div>
                    </div>
                    <div class="form-group mx-sm-3 text-center">
                    <input type="submit" class="btn btn-dark" style="background-color:#343a40 ;color:white" value="Ingresar" name="Ingresar"> 
                    </div>
       <!--             <div class="form-group mx-sm-3 text-center my-3">
                  
                            <span class=""  style="color: #343a40;"><a  style="color: #343a40;" href="" class="olvide">¿Olvide mi
                                    contraseña?</a></span>
                    </div>-->





            <div class="form-group mx-sm-4 my-1 text-center olv my-2">
                <span class="" style="color: #343a40;"><a  style="color: #343a40;" href="<?=PATH?>/Usuarios/Activar" class="olvide"><i class="bi bi-key-fill"></i>Activar
                        Cuenta</a></span>
            </div>

            </form>
        </div>
    </div>



    <!-- <span class="right-title">Sign up with <br>Social Network</span> -->
    <!-- <i class="bi bi-facebook"></i><button class="social facebook">Log in with Facebook</button> -->
    <script type="text/javascript">
    function mostrarPassword(){
		var cambio = document.getElementById("i_pass");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('bi bi-eye-slash-fill').addClass('bi bi-eye-fill');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('bi bi-eye-fill').addClass('bi bi-eye-slash-fill');
		}
	} 
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>