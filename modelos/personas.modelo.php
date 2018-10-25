<?php

require_once "conexion.php";

class ModeloUsuarios {

  /*=============================================
	INSERTAR PERSONA
	=============================================*/

	static public function mdlIngresarPersona($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, tipo, pais, imagen, descripcion) VALUES (:nombre, :tipo, :pais, :imagen, :descripcion)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PERSONAS
	=============================================*/

	static public function mdlMostrarPersonas($tabla, $item, $valor){

    if($item != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();
  
      return $stmt -> fetch();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }

    $stmt -> close();

    $stmt = null;

	}

}
