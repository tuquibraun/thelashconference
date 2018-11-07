<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../modelos/conexion.php";

class TablaCategorias{

  /*=============================================
  MOSTRAR LA TABLA DE CATEGORÍAS
  =============================================*/

 	public function mostrarTabla(){

 	$item = null;
 	$valor = null;

 	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

 	$datosJson = '{

		  "data": [ ';

	for($i = 0; $i < count($categorias); $i++){

			/*=============================================
			REVISAR ESTADO
			=============================================*/

			if( $categorias[$i]["estado"] == 0){

				$colorEstado = "btn-danger";
				$textoEstado = "Desactivado";
				$estadoCategoria = 1;

			}else{

				$colorEstado = "btn-success";
				$textoEstado = "Activado";
				$estadoCategoria = 0;

			}

		 	$estado = "<button class='btn ".$colorEstado." btn-xs btnActivar' estadoCategoria='".$estadoCategoria."' idCategoria='".$categorias[$i]["id"]."'>".$textoEstado."</button>";

			/*=============================================
  			CREAR LAS ACCIONES
  			=============================================*/

		  $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarCategoria' idCategoria='".$categorias[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCategoria'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCategoria' idCategoria='".$categorias[$i]["id"]."' rutaCabecera='".$categorias[$i]["ruta"]."' ><i class='fa fa-times'></i></button></div>";

			$datosJson	.= '[
				      "'.($i+1).'",
				      "'.$categorias[$i]["categoria"].'",
              "'.$categorias[$i]["descripcion"].'",
				      "'.$categorias[$i]["ruta"].'",
				      "'. $estado.'",
				      "'.$acciones.'"],';

	}

	$datosJson = substr($datosJson, 0, -1);

	$datosJson.=  ']

	}';

	echo $datosJson;

 	}


}

/*=============================================
ACTIVAR TABLA DE CATEGORÍAS
=============================================*/
$activar = new TablaCategorias();
$activar -> mostrarTabla();
