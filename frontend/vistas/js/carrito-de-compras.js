$(document).ready(function() {

	/*=============================================
	VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS
	=============================================*/

	if(localStorage.getItem("cantidadCesta") != null){

		$(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
		$(".sumaCesta").html(localStorage.getItem("sumaCesta"));

	}else{

		$(".cantidadCesta").html("0");
		$(".sumaCesta").html("0");


	}

	/*=============================================
	VISUALIZAR LOS PRODUCTOS EN LA PÁGINA CARRITO DE COMPRAS
	=============================================*/

	if(localStorage.getItem("listaProductos") != null){

		var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

		listaCarrito.forEach(funcionForEach);

		function funcionForEach(item, index){

			/*=============================================
			TRAER SUB CATEGORIA
			=============================================*/

			var datosSubcategoria = new FormData();
			datosSubcategoria.append("subCategoria", item.subcategoria);

			$.ajax({

				url:"ajax/producto.ajax.php",
				method:"POST",
				data: datosSubcategoria,
				cache: false,
				contentType: false,
				processData:false,
				dataType: "json",
				success: function(respuesta){

					var subcategoria = "";

					subcategoria = respuesta[0]["subcategoria"]

					var datosProducto = new FormData();
					var precio = 0;

					datosProducto.append("id", item.idProducto);

					$.ajax({

						url:"ajax/producto.ajax.php",
						method:"POST",
						data: datosProducto,
						cache: false,
						contentType: false,
						processData:false,
						dataType: "json",
						success: function(respuesta){


							if(respuesta["precioOferta"] == 0){

								precio = respuesta["precio"];

							}else{

								precio = respuesta["precioOferta"];
							}

							$(".cuerpoCarrito").append(

								'<div clas="row itemCarrito">'+

									'<div class="col-sm-2 col-xs-12">'+

										'<br>'+

										'<center>'+

											'<button class="btn btn-default backColor quitarItemCarrito" idProducto="'+item.idProducto+'">'+

												'<i class="fa fa-times"></i>'+

											'</button>'+

										'</center>'+

									'</div>'+
									/*'<div class="col-sm-2 col-xs-12">'+

										'<figure>'+

											'<img src="'+item.imagen+'" class="img-thumbnail">'+

										'</figure>'+

									'</div>'+*/

									'<div class="col-sm-4 col-xs-12">'+

										'<br>'+

										'<p class="tituloCarritoCompra text-left">'+item.titulo+'</p>'+

									'</div>'+

									'<div class="col-sm-4 col-xs-12">'+

										'<br>'+

										'<p class="" text-left">'+subcategoria+'</p>'+

									'</div>'+

									'<div class="col-sm-2 col-xs-12">'+

										'<br>'+

										'<p class="precioCarritoCompra text-center">USD $<span>'+item.precio+'</span></p>'+

									'</div>'+

								'</div>'+

								'<div class="clearfix"></div>'+

								'<hr>');

							/*=============================================
							ACTUALIZAR SUBTOTAL
							=============================================*/
							var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");
							var cantidadItem = $(".cuerpoCarrito .cantidadItem");

							for(var i = 0; i < precioCarritoCompra.length; i++){

								var precioCarritoCompraArray = $(precioCarritoCompra[i]).html();
								var cantidadItemArray = $(cantidadItem[i]).val();
								var idProductoArray = $(cantidadItem[i]).attr("idProducto");

								$(".subTotal"+i).html('<strong>USD $<span>'+(precioCarritoCompraArray*cantidadItemArray)+'</span></strong>')

								sumaSubtotales();

							}

						}

					})

				}

			})

		}

	}else{

		$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
		$(".sumaCarrito").hide();
		$(".cabeceraCheckout").hide();
	}

	/*=============================================
	AGREGAR AL CARRITO
	=============================================*/

	$(".agregarCarrito").click(function(){

		var seleccionarNominaciones = $(".nominacion input:checked");

		var sumaCesta = 0;

		seleccionarNominaciones.each(function(i) {

			var idProducto = seleccionarNominaciones.attr("value");
			var titulo = $(this).attr("titulo");
			var precio = $(this).attr("precio");
			var idCategoria = $(this).attr("categoria");
			var idSubcategoria = $(this).attr("idSubcategoria");

			/*=============================================
			RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE
			=============================================*/

		 sumaCesta = Number(sumaCesta) + Number(precio);

			if(localStorage.getItem("listaProductos") == null){

				listaCarrito = [];

			}else{

				var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));

				listaCarrito.concat(localStorage.getItem("listaProductos"));

			}

			listaCarrito.push({"idProducto":idProducto,
								 "titulo":titulo,
								 "precio":precio,
									"subcategoria":idSubcategoria,
									"categoria":idCategoria});

			localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));


		})

		/*=============================================
		ACTUALIZAR LA CESTA
		=============================================*/

		localStorage.setItem("sumaCesta", sumaCesta);

			/*=============================================
			MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO
			=============================================*/

			if(localStorage.getItem("listaProductos") != null) {

				swal({
						title: "",
						text: "¡Las nominaciones se han agragado correctamente!",
						type: "success",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "¡Continuar!",
						closeOnConfirm: false
					},
					function(isConfirm){
						if (isConfirm) {
							 window.location = "carrito-de-compras";
						}
				});

			}

	})

	/*=============================================
	/*=============================================
	/*=============================================
	/*=============================================
	/*=============================================
	QUITAR PRODUCTOS DEL CARRITO
	=============================================*/

	$(document).on("click", ".quitarItemCarrito", function(){

		$(this).parent().parent().parent().remove();

		var idProducto = $(".cuerpoCarrito button");
		var imagen = $(".cuerpoCarrito img");
		var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
		var precio = $(".cuerpoCarrito .precioCarritoCompra span");
		var cantidad = $(".cuerpoCarrito .cantidadItem");

		/*=============================================
		SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)
		=============================================*/

		listaCarrito = [];

		if(idProducto.length != 0){

			for(var i = 0; i < idProducto.length; i++){

				var idProductoArray = $(idProducto[i]).attr("idProducto");
				var imagenArray = $(imagen[i]).attr("src");
				var tituloArray = $(titulo[i]).html();
				var precioArray = $(precio[i]).html();
				var pesoArray = $(idProducto[i]).attr("peso");
				var tipoArray = $(cantidad[i]).attr("tipo");
				var cantidadArray = $(cantidad[i]).val();

				listaCarrito.push({"idProducto":idProductoArray,
							   "imagen":imagenArray,
							   "titulo":tituloArray,
							   "precio":precioArray,
						       "tipo":tipoArray,
					           "peso":pesoArray,
					           "cantidad":cantidadArray});

			}

			localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

			sumaSubtotales();


		}else{

			/*=============================================
			SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO
			=============================================*/

			localStorage.removeItem("listaProductos");

			localStorage.setItem("cantidadCesta","0");

			localStorage.setItem("sumaCesta","0");

			$(".cantidadCesta").html("0");
			$(".sumaCesta").html("0");

			$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
			$(".sumaCarrito").hide();
			$(".cabeceraCheckout").hide();

		}

	})


	/*=============================================
	/*=============================================
	/*=============================================
	/*=============================================
	/*=============================================
	SUMA DE TODOS LOS SUBTOTALES
	=============================================*/
	function sumaSubtotales() {

		var subtotales = $(".precioCarritoCompra span");
		var arraySumaSubtotales = [];

		for(var i = 0; i < subtotales.length; i++){

			var subtotalesArray = $(subtotales[i]).html();
			arraySumaSubtotales.push(Number(subtotalesArray));

		}


		function sumaArraySubtotales(total, numero){

			return total + numero;

		}

		var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);

		$(".sumaSubTotal").html('<strong>USD $<span>'+(sumaTotal).toFixed(2)+'</span></strong>');

		$(".sumaCesta").html((sumaTotal).toFixed(2));

		localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2));


	}


	/*=============================================
	/*=============================================
	/*=============================================
	/*=============================================
	/*=============================================
	CHECKOUT
	=============================================*/

	$("#btnCheckout").click(function() {

		$(".listaProductos table.tablaProductos tbody").html("");

		$("#checkPaypal").prop("checked",true);
		$("#checkPayu").prop("checked", false);

		var idUsuario = $(this).attr("idUsuario");
		var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
		var subtotal = $(".cuerpoCarrito .precioCarritoCompra span");
		var tipoArray =[];

		/*=============================================
		SUMA SUBTOTAL
		=============================================*/

		var sumaSubTotal = $(".sumaSubTotal span")

		$(".valorSubtotal").html($(sumaSubTotal).html());
		$(".valorSubtotal").attr("valor",$(sumaSubTotal).html());

		/*=============================================
		TASAS DE IMPUESTO
		=============================================*/

		var impuestoTotal = ($(".valorSubtotal").html() * $("#tasaImpuesto").val()) /100;

		$(".valorTotalImpuesto").html((impuestoTotal).toFixed(2));
		$(".valorTotalImpuesto").attr("valor",(impuestoTotal).toFixed(2));

		sumaTotalCompra()

		/*=============================================
		VARIABLES ARRAY
		=============================================*/

		for(var i = 0; i < titulo.length; i++){

			var tituloArray = $(titulo[i]).html();
			var subtotalArray = $(subtotal[i]).html();

			console.log(titulo)

			/*=============================================
			MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR
			=============================================*/

			$(".listaProductos table.tablaProductos tbody").append('<tr>'+
																   '<td class="valorTitulo">'+tituloArray+'</td>'+
																   '<td>$<span class="valorItem" valor="'+subtotalArray+'">'+subtotalArray+'</span></td>'+
																   '<tr>');

		}


	})

	/*=============================================
	SUMA TOTAL DE LA COMPRA
	=============================================*/
	function sumaTotalCompra(){

		var sumaTotalTasas = Number($(".valorSubtotal").html())+
		                     Number($(".valorTotalEnvio").html())+
		                     Number($(".valorTotalImpuesto").html());


		$(".valorTotalCompra").html((sumaTotalTasas).toFixed(2));
		$(".valorTotalCompra").attr("valor",(sumaTotalTasas).toFixed(2));

		localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));
	}

	/*=============================================
	MÉTODO DE PAGO PARA CAMBIO DE DIVISA
	=============================================*/

	var metodoPago = "paypal";
	divisas(metodoPago);

	$("input[name='pago']").change(function(){

		var metodoPago = $(this).val();

		divisas(metodoPago);

		if(metodoPago == "payu"){

			$(".btnPagar").hide();
			$(".btnPagarMercado").show();

		}else{

			$(".btnPagar").show();
			$(".btnPagarMercado").hide();

		}

	})

	/*=============================================
	FUNCIÓN PARA EL CAMBIO DE DIVISA
	=============================================*/

	function divisas(metodoPago){

		$("#cambiarDivisa").html("");

		if(metodoPago == "paypal"){

			$("#cambiarDivisa").append('<option value="USD">USD</option>'+
				                       '<option value="EUR">EUR</option>'+
				                       '<option value="GBP">GBP</option>'+
				                       '<option value="MXN">MXN</option>'+
				                       '<option value="JPY">JPY</option>'+
				                       '<option value="CAD">CAD</option>'+
				                       '<option value="BRL">BRL</option>')

		}else{

			$("#cambiarDivisa").append('<option value="USD">USD</option>'+
				                       '<option value="PEN">PEN</option>'+
				                       '<option value="COP">COP</option>'+
				                       '<option value="MXN">MXN</option>'+
				                       '<option value="CLP">CLP</option>'+
				                       '<option value="ARS">ARS</option>'+
				                       '<option value="BRL">BRL</option>')

		}

	}

	/*=============================================
	CAMBIO DE DIVISA
	=============================================*/

	var divisaBase = "USD";

	$("#cambiarDivisa").change(function(){

		$(".alert").remove();

		if($("#seleccionarPais").val() == ""){

			$("#cambiarDivisa").after('<div class="alert alert-warning">No ha seleccionado el país de envío</div>');

			return;

		}

		var divisa = $(this).val();

		$.ajax({

			url: "http://free.currencyconverterapi.com/api/v3/convert?q="+divisaBase+"_"+divisa+"&compact=y",
			type:"GET",
			cache: false,
		    contentType: false,
		    processData: false,
		    dataType:"jsonp",
		    success:function(respuesta){

		    	var conversion = (respuesta["USD_"+divisa]["val"]).toFixed(2);

		    	$(".cambioDivisa").html(divisa);

		    	if(divisa == "USD"){

		    		$(".valorSubtotal").html($(".valorSubtotal").attr("valor"))
			    	$(".valorTotalEnvio").html($(".valorTotalEnvio").attr("valor"))
			    	$(".valorTotalImpuesto").html($(".valorTotalImpuesto").attr("valor"))
			    	$(".valorTotalCompra").html($(".valorTotalCompra").attr("valor"))

			    	var valorItem = $(".valorItem");

			    	localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

			    	for(var i = 0; i < valorItem.length; i++){

			    		$(valorItem[i]).html($(valorItem[i]).attr("valor"));

			    	}

		    	}else{

			    	$(".valorSubtotal").html(

			    		Math.ceil(Number(conversion) * Number($(".valorSubtotal").attr("valor"))*100)/100

			    	)

			    	$(".valorTotalEnvio").html(

			    		(Number(conversion) * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2)

			    	)

			    	$(".valorTotalImpuesto").html(

			    		(Number(conversion) * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2)

			    	)

			    	$(".valorTotalCompra").html(

			    		(Number(conversion) * Number($(".valorTotalCompra").attr("valor"))).toFixed(2)

			    	)

			    	var valorItem = $(".valorItem");

			    	localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

			    	for(var i = 0; i < valorItem.length; i++){

			    		$(valorItem[i]).html(

			    			(Number(conversion) * Number($(valorItem[i]).attr("valor"))).toFixed(2)

			    		);

			    	}

			    }

		    	sumaTotalCompra();

		    	pagarConPayu();

		    }

		})



	})

	/*=============================================
	BOTÓN PAGAR PAYPAL
	=============================================*/

	$(".btnPagar").click(function(){

		var divisa = $("#cambiarDivisa").val();
		var total = $(".valorTotalCompra").html();
		var totalEncriptado = localStorage.getItem("total");
		var impuesto = $(".valorTotalImpuesto").html();
		var subtotal = $(".valorSubtotal").html();
		var titulo = $(".valorTitulo");
		var valorItem = $(".valorItem");
		var idProducto = $('.cuerpoCarrito button, .comprarAhora button');

		var tituloArray = [];
		var valorItemArray = [];
		var idProductoArray = [];

		for(var i = 0; i < titulo.length; i++){

			tituloArray[i] = $(titulo[i]).html();
			valorItemArray[i] = $(valorItem[i]).html();
			idProductoArray[i] = $(idProducto[i]).attr("idProducto");

		}

		var datos = new FormData();

		datos.append("divisa", divisa);
		datos.append("total",total);
		datos.append("totalEncriptado",totalEncriptado);
		datos.append("impuesto",impuesto);
		datos.append("subtotal",subtotal);
		datos.append("tituloArray",tituloArray);
		datos.append("valorItemArray",valorItemArray);
		datos.append("idProductoArray",idProductoArray);

		$.ajax({
			 url:"ajax/carrito.ajax.php",
			 method:"POST",
			 data: datos,
			 cache: false,
	         contentType: false,
	         processData: false,
	         success:function(respuesta){

						 console.log(respuesta)

	               window.location = respuesta;

	         },
					 error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
				console.log(xhr.responseText)
      }

		})

	})

	$(".btnPagarMercado").click(function(){

		pagarConPayu()

	})

	/*=============================================
	BOTÓN PAGAR PAYU
	=============================================*/

	function pagarConPayu(){

		var divisa = $("#cambiarDivisa").val();
		var total = $(".valorTotalCompra").html();
		var impuesto = $(".valorTotalImpuesto").html();
		var subtotal = $(".valorSubtotal").html();
		var titulo = $(".valorTitulo");
		var valorItem = $(".valorItem");
		var idProducto = $('.cuerpoCarrito button, .comprarAhora button');

		var tituloArray = [];
		var idProductoArray = [];
		var valorItemArray = [];

		for(var i = 0; i < titulo.length; i++){

			tituloArray[i] = $(titulo[i]).html();
			idProductoArray[i] = $(idProducto[i]).attr("idProducto");
			valorItemArray[i] = $(valorItem[i]).html();

		}

		var valorItemString = valorItemArray.toString();
		var pago = valorItemString.replace(",","-");

		console.log(tituloArray);

		var datos = new FormData();
		datos.append("metodoPago", "payu");
		datos.append("titulos", JSON.stringify(tituloArray));
		datos.append("valores", JSON.stringify(valorItemArray));
		datos.append("currency", divisa);

		if(hex_md5(total) == localStorage.getItem("total")){

			$.ajax({
		      url:"ajax/carrito.ajax.php",
		      method:"POST",
		      data: datos,
		      cache: false,
		      contentType: false,
		      processData: false,
		      success:function(respuesta){

						console.log(respuesta)

						window.location = respuesta;

		      },
					error: function(xhr){
						console.log(xhr.responseText)
					}

		  })
		}
	}


	/*=============================================
	AGREGAR PRODUCTOS GRATIS
	=============================================*/
	$(".agregarGratis").click(function(){

		var idProducto = $(this).attr("idProducto");
		var idUsuario = $(this).attr("idUsuario");
		var tipo = $(this).attr("tipo");
		var titulo = $(this).attr("titulo");
		var agregarGratis = false;

		/*=============================================
		VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
		=============================================*/

		var datos = new FormData();

		datos.append("idUsuario", idUsuario);
		datos.append("idProducto", idProducto);

		$.ajax({
			url:"ajax/carrito.ajax.php",
			method:"POST",
	      	data: datos,
	      	cache: false,
	      	contentType: false,
	      	processData: false,
	      	success:function(respuesta){

	      	    if(respuesta != "false"){

	  	    		swal({
							  title: "¡Usted ya adquirió este producto!",
							  text: "",
							  type: "warning",
							  showCancelButton: false,
							  confirmButtonColor: "#DD6B55",
							  confirmButtonText: "Regresar",
							  closeOnConfirm: false
							})


	      	    }else{

					if(tipo == "virtual"){

						agregarGratis = true;

					}else{

						var seleccionarDetalle = $(".seleccionarDetalle");

						for(var i = 0; i < seleccionarDetalle.length; i++){

							if($(seleccionarDetalle[i]).val() == ""){

									swal({
										  title: "Debe seleccionar Talla y Color",
										  text: "",
										  type: "warning",
										  showCancelButton: false,
										  confirmButtonColor: "#DD6B55",
										  confirmButtonText: "¡Seleccionar!",
										  closeOnConfirm: false
										})

							}else{

								titulo = titulo + "-" + $(seleccionarDetalle[i]).val();

								agregarGratis = true;

							}

						}

					}

					if(agregarGratis){

						window.location = "index.php?ruta=finalizar-compra&gratis=true&producto="+idProducto+"&titulo="+titulo;

					}

	      	    }

	      	}

		})

	})

});
