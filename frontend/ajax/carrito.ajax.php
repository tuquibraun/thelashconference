<?php

require_once "../extensiones/paypal.controlador.php";
require_once "../extensiones/mercadopago.php";

require_once "../controladores/carrito.controlador.php";
require_once "../modelos/carrito.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";



class AjaxCarrito{

	/*=============================================
	MÉTODO PAYPAL
	=============================================*/

	public $divisa;
	public $total;
	public $totalEncriptado;
	public $impuesto;
	public $subtotal;
	public $tituloArray;
	public $valorItemArray;
	public $idProductoArray;

	public function ajaxEnviarPaypal(){

		if(md5($this->total) == $this->totalEncriptado){

				$datos = array(
						"divisa"=>$this->divisa,
						"total"=>$this->total,
						"impuesto"=>$this->impuesto,
						"subtotal"=>$this->subtotal,
						"tituloArray"=>$this->tituloArray,
						"valorItemArray"=>$this->valorItemArray,
						"idProductoArray"=>$this->idProductoArray,
					);

				$respuesta = Paypal::mdlPagoPaypal($datos);

				echo $respuesta;

		}
	}

	/*=============================================
	MÉTODO PAYU
	=============================================*/

	public function ajaxTraerComercioPayu(){

		$titulos = json_decode($_POST["titulos"]);
		$valores = json_decode($_POST["valores"]);
		$divisa = $_POST["currency"];

		$mp = new MP('684542876475084', 'woF6dzSWDqbpuqQbBYhGuhvrYrgck5HM');

		$mp->sandbox_mode(TRUE);

		$preference_data = array(
			"items" => array()
		);

		foreach ($titulos as $key => $value) {

			array_push($preference_data["items"],
				array(
					"title" => $titulos[$key],
					"quantity" => 1,
					"currency_id" => $divisa,
					"unit_price" => intval($valores[$key])
				));

		}

		$preference = $mp->create_preference($preference_data);

		echo $preference['response']['sandbox_init_point'];
	}

}

/*=============================================
MÉTODO PAYPAL
=============================================*/

if(isset($_POST["divisa"])){

	$idProductos = explode("," , $_POST["idProductoArray"]);
	$precioProductos = explode("," , $_POST["valorItemArray"]);

	$item = "id";

	for($i = 0; $i < count($idProductos); $i ++){

		$valor = $idProductos[$i];

		$verificarProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

		$divisa = file_get_contents("http://free.currencyconverterapi.com/api/v3/convert?q=USD_".$_POST["divisa"]."&compact=y");

		$jsonDivisa = json_decode($divisa, true);

		$conversion = number_format($jsonDivisa["USD_".$_POST["divisa"]]["val"],2);

		if($verificarProductos["precioOferta"] == 0){

			$precio = number_format($verificarProductos["precio"]*$conversion, 2);

		}else{

			$precio = number_format($verificarProductos["precioOferta"]*$conversion, 2);

		}

			echo "carrito-de-compras";

			return;

	}

	$paypal = new AjaxCarrito();
	$paypal ->divisa = $_POST["divisa"];
	$paypal ->total = $_POST["total"];
	$paypal ->totalEncriptado = $_POST["totalEncriptado"];
	$paypal ->impuesto = $_POST["impuesto"];
	$paypal ->envio = $_POST["envio"];
	$paypal ->subtotal = $_POST["subtotal"];
	$paypal ->tituloArray = $_POST["tituloArray"];
	$paypal ->cantidadArray = $_POST["cantidadArray"];
	$paypal ->valorItemArray = $_POST["valorItemArray"];
	$paypal ->idProductoArray = $_POST["idProductoArray"];
	$paypal -> ajaxEnviarPaypal();


}

/*=============================================
MÉTODO PAYU
=============================================*/

if(isset($_POST["metodoPago"]) && $_POST["metodoPago"] == "payu"){

	$payu = new AjaxCarrito();
	$payu -> ajaxTraerComercioPayu();


}
