<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textil Export</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php
        include 'views/header.php';
    ?>
</head>
<body>
<?php
        include 'views/menu.php';
    ?>
        <div class="container">
    <div class="row mx-10 mt-5">
        <div class="col ml-6">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card carta text-white bg-dark mb-3">
                        <h3 class="card-title text-center">Industria textil</h3>
                        <img src="<?=PATH?>/views/assets/img/im2.jpg" width="250px" height="200px" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 align="center">Somos una empresa textil, verticalmente integrada 
                                que cuenta con más de 2000 empleados directos y una planta de más de 80 mil metros cuadrados de área construida.</h5>
                            <p class="card-text text-center"></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card carta text-white bg-dark mb-3">
                        <h3 class="card-title text-center">Calidad</h3>
                        <img src="<?=PATH?>/views/assets/img/im1.jpg" width="250px" height="200px" class="card-img-top">
                        <div class="card-body ">
                            <h5 align="center">Gracias a nuestras plantas hemos podido mantener los mejores estándares de calidad, velando por el mejoramiento de la calidad de vida y el bienestar de su equipo humano.</h5>
                            <p class="card-text text-center"></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card carta text-white bg-dark mb-3">
                        <h3 class="card-title text-center">Productos</h3>
                        <img src="<?=PATH?>/views/assets/img/im3.png" width="250px" height="200px" class="card-img-top">
                        <div class="card-body">
                            <h5 align="center">Trabajamos para ofrecer a los clientes y consumidores soluciones textiles que superan sus expectativas. Proporcionamos telas con las tecnologías más innovadoras del momento.</h5>
                            <p class="card-text text-center"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</body>
</html>