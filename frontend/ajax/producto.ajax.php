<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../modelos/conexion.php";

class AjaxProductos{

	public $valor;
	public $item;
	public $ruta;

	public function ajaxVistaProducto(){

		$item1 = $this->item;
		$valor1 = $this->valor;

		$item2 = "ruta";
		$valor2 = $this->ruta;

		$respuesta = ControladorProductos::ctrActualizarProducto($item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	TRAER EL PRODUCTO DE ACUERDO AL ID
	=============================================*/

	public $id;

	public function ajaxTraerProducto(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

		echo json_encode($respuesta);
	}

	public function ajaxTraerProductoSubcategoria(){

		$item = "id_subcategoria";
		$valor = $this->id;
		$ordenar = "id";

		$respuesta = ControladorProductos::ctrListarProductos($ordenar,$item, $valor);

		echo json_encode($respuesta);
	}

	public function ajaxTraerSubcategoria(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

		echo json_encode($respuesta);
	}


}

if(isset($_POST["valor"])){

	$vista = new AjaxProductos();
	$vista -> valor = $_POST["valor"];
	$vista -> item = $_POST["item"];
	$vista -> ruta = $_POST["ruta"];
	$vista -> ajaxVistaProducto();


}

if(isset($_POST["id"])){

	$producto = new AjaxProductos();
	$producto -> id = $_POST["id"];
	$producto -> ajaxTraerProducto();

}

if(isset($_POST["idSubCategoria"])){

	$producto = new AjaxProductos();
	$producto -> id = $_POST["idSubCategoria"];
	$producto -> ajaxTraerProductoSubcategoria();

}

if(isset($_POST["subCategoria"])){

	$producto = new AjaxProductos();
	$producto -> id = $_POST["subCategoria"];
	$producto -> ajaxTraerSubcategoria();

}
