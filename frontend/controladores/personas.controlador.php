<?php

class ControladorPersonas{

	/*=============================================
	MOSTRAR CATEGORÍAS
	=============================================*/

	static public function ctrMostrarPersonas($item, $valor){

		$tabla = "personas";

		$respuesta = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor);

		return $respuesta;

	}

}
