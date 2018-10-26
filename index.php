<?php

  require_once "modelos/personas.modelo.php";
  require_once "modelos/usuarios.modelo.php";
  require_once "modelos/rutas.php";

  require_once "controladores/plantilla.controlador.php";
  require_once "controladores/personas.controlador.php";
  require_once "controladores/usuarios.controlador.php";

  $plantilla = new ControladorPlantilla();
  $plantilla -> plantilla();
