$(document).ready(function() {

	/*=============================================
	CARGAR LA TABLA DINÁMICA DE SUBCATEGORÍAS
	=============================================*/

	var tablaSubCategorias = $('.tablaSubCategorias').DataTable({

		"ajax":"ajax/tablaSubCategorias.ajax.php",
		"deferRender": true,
		"retrieve": true,
		"processing": true,
	    "language": {

				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}

		}

	});


	/*=============================================
	ACTIVAR SUBCATEGORÍA
	=============================================*/

	$('.tablaSubCategorias tbody').on("click", ".btnActivar", function(){

		var idSubCategoria = $(this).attr("idSubCategoria");
		var estadoSubCategoria = $(this).attr("estadoSubCategoria");

		var datos = new FormData();
	 	datos.append("activarId", idSubCategoria);
	  	datos.append("activarSubCategoria", estadoSubCategoria);

	  	$.ajax({

		  url:"ajax/subCategorias.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
	      contentType: false,
	      processData: false,
	      success: function(respuesta){
	          // console.log("respuesta", respuesta);

	      }

	  	})

	  	if(estadoSubCategoria == 0){

	  		$(this).removeClass('btn-success');
	  		$(this).addClass('btn-danger');
	  		$(this).html('Desactivado');
	  		$(this).attr('estadoSubCategoria',1);

	  	}else{

	  		$(this).addClass('btn-success');
	  		$(this).removeClass('btn-danger');
	  		$(this).html('Activado');
	  		$(this).attr('estadoSubCategoria',0);

	  	}

	})


	/*=============================================
	REVISAR SI LA SUBCATEGORÍA YA EXISTE
	=============================================*/

	$(".validarSubCategoria").change(function(){

		$(".alert").remove();

		var subCategoria = $(this).val();

		var datos = new FormData();
		datos.append("validarSubCategoria", subCategoria);

		 $.ajax({
		    url:"ajax/subCategorias.ajax.php",
		    method:"POST",
		    data: datos,
		    cache: false,
		    contentType: false,
		    processData: false,
		    dataType: "json",
		    success:function(respuesta){

		    	// console.log("respuesta", respuesta);

		    	if(respuesta.length != 0){

		    		$(".validarSubCategoria").parent().after('<div class="alert alert-warning">Esta Subcategoría ya existe en la base de datos</div>');

		    		$(".validarSubCategoria").val("");

		    	}

		    }

		})
	})

	/*=============================================
	RUTA SUBCATEGORÍA
	=============================================*/

	function limpiarUrl(texto){
	      var texto = texto.toLowerCase();
	      texto = texto.replace(/[á]/, 'a');
	      texto = texto.replace(/[é]/, 'e');
	      texto = texto.replace(/[í]/, 'i');
	      texto = texto.replace(/[ó]/, 'o');
	      texto = texto.replace(/[ú]/, 'u');
	      texto = texto.replace(/[ñ]/, 'n');
	      texto = texto.replace(/ /g, "-")
	      return texto;
	   }

	$(".tituloSubCategoria").change(function(){

		$(".rutaSubCategoria").val(

			limpiarUrl($(".tituloSubCategoria").val())

		);

	})

	/*=============================================
	EDITAR SUBCATEGORÍA
	=============================================*/

	$(".tablaSubCategorias tbody").on("click", ".btnEditarSubCategoria", function(){

		var idSubCategoria = $(this).attr("idSubCategoria");

		var datos = new FormData();
		datos.append("idSubCategoria", idSubCategoria);

		$.ajax({

			url:"ajax/subCategorias.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

				$("#modalEditarSubCategoria .editarIdSubCategoria").val(respuesta[0]["id"]);
				$("#modalEditarSubCategoria .tituloSubCategoria").val(respuesta[0]["subcategoria"]);
				$("#modalEditarSubCategoria .rutaSubCategoria").val(respuesta[0]["ruta"]);
				$("#modalEditarSubCategoria .descripcionSubCategoria").val(respuesta[0]["descripcion"]);

				/*=============================================
				EDITAR NOMBRE SUBCATEGORÍA Y RUTA
				=============================================*/

				$("#modalEditarSubCategoria .tituloSubCategoria").change(function(){

					$("#modalEditarSubCategoria .rutaSubCategoria").val(limpiarUrl($("#modalEditarSubCategoria .tituloSubCategoria").val()));

				})

				/*=============================================
				TRAEMOS LA CATEGORIA
				=============================================*/

				if(respuesta[0]["id_categoria"] != ""){

					var datosCategoria = new FormData();
					datosCategoria.append("idCategoria", respuesta[0]["id_categoria"]);


					$.ajax({

							url:"ajax/categorias.ajax.php",
							method: "POST",
							data: datosCategoria,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "json",
							success: function(respuesta){

								$("#modalEditarSubCategoria .seleccionarCategoria").val(respuesta["id"]);
								$("#modalEditarSubCategoria .optionEditarCategoria").html(respuesta["categoria"]);
							}

						})

				}else{

					$("#modalEditarSubCategoria .optionEditarCategoria").html("SIN CATEGORÍA");

				}

			}

		});

	})

	/*=============================================
	ELIMINAR SUBCATEGORÍA
	=============================================*/
	$(".tablaSubCategorias").on("click", ".btnEliminarSubCategoria", function(){

	  var idSubCategoria = $(this).attr("idSubCategoria");

	  swal({
	    title: '¿Está seguro de borrar la subcategoría?',
	    text: "¡Si no lo está puede cancelar la accíón!",
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      cancelButtonText: 'Cancelar',
	      confirmButtonText: 'Si, borrar subcategoría!'
	  }).then(function(result){

	    if(result.value){

	      window.location = "index.php?ruta=subcategorias&idSubCategoria="+idSubCategoria;

	    }

	  })

	})

});
