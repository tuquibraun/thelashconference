<?php

require_once "../controladores/sponsors.controlador.php";
require_once "../modelos/sponsors.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";

class TablaSponsors{

  /*=============================================
  MOSTRAR LA TABLA DE PRODUCTOS
  =============================================*/

  public function mostrarTablaSponsors(){

  	$item = null;
  	$valor = null;

  	$sponsors = ControladorSponsors::ctrMostrarSponsors($item, $valor);

  	$datosJson = '

  		{
  			"data":[';

	 	for($i = 0; $i < count($sponsors); $i++){

      /*=============================================
			TRAER FOTO USUARIO
			=============================================*/

			if($sponsors[$i]["imagen"] != "" ){

				$imagen = "<img class='img-circle' src='".$sponsors[$i]["imagen"]."' width='60px'>";

			}else{

				$imagen = "<img class='img-circle' src='vistas/img/usuarios/default/anonymous.png' width='60px'>";
			}

	  		/*=============================================
  			TRAER LAS ACCIONES
  			=============================================*/

  			$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarSponsor' idSponsor='".$sponsors[$i]["id"]."' data-toggle='modal' data-target='#modalEditarSponsor'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarSponsor' idSponsor='".$sponsors[$i]["id"]."'><i class='fa fa-times'></i></button></div>";

  			/*=============================================
  			CONSTRUIR LOS DATOS JSON
  			=============================================*/


			$datosJson .='[

					"'.($i+1).'",
					"'.$sponsors[$i]["nombre"].'",
					"'.$sponsors[$i]["descripcion"].'",
          "'.$imagen.'",
					"'.$sponsors[$i]["tipo"].'",
				  	"'.$acciones.'"

			],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']

		}';

		echo $datosJson;

  }


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarSponsors = new TablaSponsors();
$activarSponsors -> mostrarTablaSponsors();
