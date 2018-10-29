<?php

class ModeloSponsors{

    static public function mdlMostrarSponsors($tabla, $valor){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

          $stmt -> execute();

          return $stmt -> fetchAll();
    }
}