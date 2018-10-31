<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>thelashconference</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php

      session_start();



     ?>
     <link rel="stylesheet" href="vistas/css/plugins/bootstrap.min.css">

	<link rel="stylesheet" href="vistas/css/plugins/font-awesome.min.css">

	<link rel="stylesheet" href="vistas/css/plugins/flexslider.css">

	<link rel="stylesheet" href="vistas/css/plugins/sweetalert.css">

	<link rel="stylesheet" href="vistas/css/plugins/dscountdown.css">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="vistas/css/main.css" />

    <script src="vistas/js/plugins/jquery.min.js"></script>

    <script src="vistas/js/plugins/bootstrap.min.js"></script>

    <script src="vistas/js/plugins/jquery.easing.js"></script>

    <script src="vistas/js/plugins/jquery.scrollUp.js"></script>

    <script src="vistas/js/plugins/jquery.flexslider.js"></script>

    <script src="vistas/js/plugins/sweetalert.min.js"></script>

    <script src="vistas/js/plugins/md5-min.js"></script>

</head>
<body>

    <?php


      include "vistas/modulos/menu.php";

      include "vistas/modulos/portada.php";

      include "vistas/modulos/personas.php";

      include "vistas/modulos/sponsors.php";

     ?>



    <div id="modalidades" class="modalidades-section content-hidden">
        <div class="content-wrap">
            <div class="conference">
            <h1 class="modalidades-tittle">
                Conferencia
            </h1>
            <div class="text">
                Veni a la conferencia internacional mas prestigiosa de latinoamerica con oradores de todo el mundo, ademas participa de una cena de gala comprando tu entrada vip.
            </div>
            </div>
            <div class="competition">
                <h1 class="modalidades-tittle">
                    Competencia
                </h1>
                <div class="text">
                    <div class="online">
                        <h3>campeonato online</h3>
                        <ul class="nominaciones">
                            <li>nominaciones</li>
                            <li>clasico</li>
                            <li>megavolumen</li>
                            <li>kim style   </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="social-section content-hidden">
        <div class="content-wrap">
            <div class="social">
                <h1 class="social-tittle">
                    Encontranos en las redes
                </h1>
                <ul class="media">
                    <a href="www.facebook.com/thelashconference" target="_blank">
                        <li class="facebook icon"></li>
                    </a>
                    <a href="www.instagram.com/thelashconference" target="_blank">
                        <li class="instagram icon"></li>
                    </a>
                    <a href="www.twitter.com/thelashconference" target="_blank">
                        <li class="twitter icon"></li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-section">
        <div class="content-wrap">
            <div class="pre-footer">
                <div class="content">
                    <div class="col col2">
                            <h2>Contacto</h2>
                            <div class="contacto">
                                <p>contacto@thelashconference.com</p>
                                <p>+54 (298) 4652497</p>
                                <p>+54 (298) 4652497</p>
                            </div>
                        </div>
                        <div class="col col3">
                            <h2>Legal</h2>
                            <div class="legal">
                                <p><a href="">term</a></p>
                                <p><a href="">priv</a></p>
                            </div>
                        </div>
                        <div class="col col4">
                            <div class="arrow-top">

                            </div>
                            <div class="digit">
                                Hecho por <span>digit()</span>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="the-footer">
                <h2>copyright &copy; the lash conference 2019</h2>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="vistas/js/main.js"></script>
</body>
</html>
