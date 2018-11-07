<?php

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../modelos/conexion.php";

class TablaSubCategorias{

  /*=============================================
  MOSTRAR LA TABLA DE SUBCATEGORÍAS
  =============================================*/

  public function mostrarTablaSubCategoria(){

  	$item = null;
  	$valor = null;

  	$subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item, $valor);

  	$datosJson = '{

      "data": [ ';

		for($i = 0; $i < count($subcategorias); $i++){

			/*=============================================
  			TRAER LAS CATEGORÍAS
  			=============================================*/

			$item = "id";
			$valor = $subcategorias[$i]["id_categoria"];

			$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

			if($categorias["categoria"] == ""){

				$categoria = "SIN CATEGORÍA";

			}else{

				$categoria = $categorias["categoria"];
			}

			/*=============================================
  			REVISAR ESTADO
  			=============================================*/

  			if( $subcategorias[$i]["estado"] == 0){

  				$colorEstado = "btn-danger";
  				$textoEstado = "Desactivado";
  				$estadoSubCategoria = 1;

  			}else{

  				$colorEstado = "btn-success";
  				$textoEstado = "Activado";
  				$estadoSubCategoria = 0;

  			}

  			$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idSubCategoria='". $subcategorias[$i]["id"]."' estadoSubCategoria='".$estadoSubCategoria."'>".$textoEstado."</button>";

	  		/*=============================================
  			CREAR LAS ACCIONES
  			=============================================*/

  			$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarSubCategoria' idSubCategoria='".$subcategorias[$i]["id"]."' data-toggle='modal' data-target='#modalEditarSubCategoria'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarSubCategoria' idSubCategoria='".$subcategorias[$i]["id"]."'><i class='fa fa-times'></i></button></div>";


			 $datosJson .=  '
			 [
		      "'.($i+1).'",
		      "'.$subcategorias[$i]["subcategoria"].'",
		      "'.$categoria.'",
		      "'.$subcategorias[$i]["ruta"].'",
		      "'.$estado.'",
          "'.$subcategorias[$i]["descripcion"].'",
	        "'.$acciones.'"
	    	],';

			}

	        $datosJson =  substr($datosJson, 0, -1);
	        $datosJson .=  '

          ]
        }';

    echo $datosJson;

  }

}

/*=============================================
ACTIVAR TABLA DE SUBCATEGORÍAS
=============================================*/
$activarSubcategoria = new TablaSubCategorias();
$activarSubcategoria -> mostrarTablaSubCategoria();
