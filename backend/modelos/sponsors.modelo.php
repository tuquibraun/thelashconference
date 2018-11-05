<?php

class ModeloSponsors{

  /*=============================================
  MOSTRAR SPONSORS
  =============================================*/

  static public function mdlMostrarSponsors($tabla, $item, $valor){

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

    $stmt-> close();

    $stmt = null;

}

    /*=============================================
  	REGISTRO DE SPONSOR
  	=============================================*/

  	static public function mdlIngresarSponsor($tabla, $datos){

  		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, tipo, imagen, descripcion) VALUES (:nombre, :tipo, :imagen, :descripcion)");

  		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
  		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
  		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
  		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

  		if($stmt->execute()){

  			return "ok";

  		}else{

  			return "error";

  		}

  		$stmt->close();

  		$stmt = null;

  	}

    /*=============================================
  	ACTUALIZAR SPONSOR
  	=============================================*/

  	static public function mdlActualizarSponsor($tabla, $item1, $valor1, $item2, $valor2){

  		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

  		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
  		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

  		if($stmt -> execute()){

  			return "ok";

  		}else{

  			return "error";

  		}

  		$stmt -> close();

  		$stmt = null;

  	}

  	/*=============================================
  	EDITAR SPONSOR
  	=============================================*/

  	static public function mdlEditarSponsor($tabla, $datos){

  		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, tipo = :tipo, imagen = :imagen, descripcion = :descripcion WHERE id = :id");

  		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
  		$stmt -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
  		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
  		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
  		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

  		if($stmt -> execute()){

  			return "ok";

  		}else{

  			return "error";

  		}

  		$stmt -> close();

  		$stmt = null;

  	}

  	/*=============================================
  	ELIMINAR PERFIL
  	=============================================*/

  	static public function mdlEliminarSponsor($tabla, $datos){

  		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

  		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

  		if($stmt -> execute()){

  			return "ok";

  		}else{

  			return "error";

  		}

  		$stmt -> close();

  		$stmt = null;


  	}
}
