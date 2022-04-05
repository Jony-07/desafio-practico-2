<?php 
require_once 'core/config.php';
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de productos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
    <link href="https://cdn.jsdelivr.et/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .padd{
            padding-top: 40px;
            margin-top: 40px;
        }
    </style>
    <?php
        include 'views/header.php';
    ?>
</head>
<body>

<div class="container padd">

            <div class="row my-2 ">
        <div class="col ml-5">
            <!-- <a class="edit" href="?c=products&a=Insert"><i class="bi bi-plus-square-fill"></i> Insertar</a> -->
            <div class="row mt-3">
            <?php
                   
                   foreach ($productos as $producto)
                   {

                      
                   ?>
                        <div class="row">
                     <center> <p style="font-size: 60px;">Textil Export</p>  
                    <small style="color: blue;font-size:15 px;font-style: italic;">Más que un servicio, una solución</small>
                    </center> 
                     <br>
               <center><p>FACTURA: <?=$producto['id_factura']?> / ID:<?=$producto['codigo_producto']?></p>
            <p style="font-size: 16px;font-style: italic;">Información</p>

            <br>
                    <?php  foreach ($clientes as $cliente)
                   {
                       ?>
                            <p>A nombre de <?=$cliente['nombre']?>  <?=$cliente['apellido']?></p>
                       <?php } ?>

                       <?php
                             if($_SESSION['login_buffer']['id_tipo_usuario']==1){
                            ?>
                             <p><?=$cliente['codigo_cliente']?></p>
                            <?php }?>
            
            </center>
            </div>
                <table class="table table-striped table-bordered table-hover table-responsive table-condensed">
                    <thead class="Te" style="background-color:white; color:#343a40">
                        <tr>
                            <th>Fecha de compra</th>
                            <th>Producto</th>
                            <th>Precio/Unidad</th>
                            <th>Unidades</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                             <tr < id="id_<?=$producto['codigo_producto']?>">
                            <td><?=$producto['fecha']?></td>
                            <td><?php
                            foreach($compras as $compra)
                            {
                            ?>
                            <?=$compra['nombre_producto']?>
                        <?php }?>    
                        </td>
                            <td><?=$producto['total']/$producto['cantidad']?></td>
                            <td><?=$producto['cantidad']?></td>
                            <td><?=$producto['total']?></td>
                        </tr>
                       
                    </tbody>
                </table>
                <br>
                <br>
                    <center>
                        <p style="font-style: italic;">Gracias por confiar en nosotros..!</p>
                    </center>

                <?php
                        
                    }
                    ?>
            </div>              
        </div> 
            </div>
</div>
    </body>
</html>
<?php
$html =ob_get_clean();
//echo $html;

include_once ("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');

$dompdf->render();
$dompdf->stream("factura_".$producto['id_factura'].".pdf", array("Attachment"=>false))
?>