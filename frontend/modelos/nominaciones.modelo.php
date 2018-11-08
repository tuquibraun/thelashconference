<?php

require_once "conexion.php";

class ModeloNominaciones {
    static public function mdlMostrarNominaciones($tabla, $value, $tipo){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();
  
        return $stmt -> fetchAll();
    }
}