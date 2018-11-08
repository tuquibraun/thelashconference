<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>thelashconference</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php

      session_start();


      $servidor = Ruta::ctrRutaServidor();

      $url = Ruta::ctrRuta();

     ?>
     <link rel="stylesheet" href="<?php echo $url ; ?>vistas/css/plugins/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo $url ; ?>vistas/css/plugins/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo $url ; ?>vistas/css/plugins/flexslider.css">

	<link rel="stylesheet" href="<?php echo $url ; ?>vistas/css/plugins/sweetalert.css">

	<link rel="stylesheet" href="<?php echo $url ; ?>vistas/css/plugins/dscountdown.css">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url ; ?>vistas/css/main.css" />

    <script src="<?php echo $url ; ?>vistas/js/plugins/jquery.min.js"></script>

    <script src="<?php echo $url ; ?>vistas/js/plugins/bootstrap.min.js"></script>

    <script src="<?php echo $url ; ?>vistas/js/plugins/jquery.easing.js"></script>

    <script src="<?php echo $url ; ?>vistas/js/plugins/jquery.scrollUp.js"></script>

    <script src="<?php echo $url ; ?>vistas/js/plugins/jquery.flexslider.js"></script>

    <script src="<?php echo $url ; ?>vistas/js/plugins/sweetalert.min.js"></script>

    <script src="<?php echo $url ; ?>vistas/js/plugins/md5-min.js"></script>

</head>
<body>

    <?php


      include "vistas/modulos/menu.php";


      $rutas = array();
      $ruta = null;

        if(isset($_GET["ruta"])){

            $rutas = explode("/", $_GET["ruta"]);

            if($ruta != null || $rutas[0] == "inscripcion-online"){

                include "modulos/inscripcion-online.php";

            }elseif ($ruta != null || $rutas[0] == "carrito-de-compras") {
                include "modulos/carrito-de-compras.php";
            }

        }else{
            include "vistas/modulos/portada.php";

            include "vistas/modulos/modalidades.php";

            include "vistas/modulos/personas.php";

            include "vistas/modulos/sponsors.php";

            include "vistas/modulos/footer.php";
        }


?>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="<?php echo $url ; ?>vistas/js/main.js"></script>
</body>
</html>
