<?php

class ControladorSponsors{

	static public function ctrMostrarSponsors($item, $valor){

		$tabla = "sponsors";

		$respuesta = ModeloSponsors::mdlMostrarSponsors($tabla, $item, $valor);

		return $respuesta;

	}
}