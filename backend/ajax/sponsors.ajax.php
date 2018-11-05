<?php

require_once "../controladores/sponsors.controlador.php";
require_once "../modelos/sponsors.modelo.php";
require_once "../modelos/conexion.php";

class AjaxSponsors{

	/*=============================================
	EDITAR SPONSOR
	=============================================*/

	public $idSponsor;

	public function ajaxEditarSponsor(){

		$item = "id";
		$valor = $this->idSponsor;

		$respuesta = ControladorSponsors::ctrMostrarSponsors($item, $valor);

		echo json_encode($respuesta);

	}

}


/*=============================================
EDITAR SPONSOR
=============================================*/
if(isset($_POST["idSponsor"])){

	$editar = new AjaxSponsors();
	$editar -> idSponsor = $_POST["idSponsor"];
	$editar -> ajaxEditarSponsor();

}
