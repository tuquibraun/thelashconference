$(document).ready(function() {

	/*=============================================
	CARGAR LA TABLA DINÁMICA DE PRODUCTOS
	=============================================*/

	 $.ajax({

	 	url:"ajax/tablaSponsors.ajax.php",
	 	success:function(respuesta){

	 	}

	 })

	$('.tablaSponsors').DataTable({

		"ajax":"ajax/tablaSponsors.ajax.php",
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
	SUBIENDO LA FOTO DEL PERFIL
	=============================================*/
	$(".nuevaImagen").change(function(){

	  var imagen = this.files[0];

	  /*=============================================
	    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
	    =============================================*/

	    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

	      $(".nuevaImagen").val("");

	       swal({
	          title: "Error al subir la imagen",
	          text: "¡La imagen debe estar en formato JPG o PNG!",
	          type: "error",
	          confirmButtonText: "¡Cerrar!"
	        });

	    }else if(imagen["size"] > 2000000){

	      $(".nuevaImagen").val("");

	       swal({
	          title: "Error al subir la imagen",
	          text: "¡La imagen no debe pesar más de 2MB!",
	          type: "error",
	          confirmButtonText: "¡Cerrar!"
	        });

	    }else{

	      var datosImagen = new FileReader;
	      datosImagen.readAsDataURL(imagen);

	      $(datosImagen).on("load", function(event){

	        var rutaImagen = event.target.result;

	        $(".previsualizar").attr("src", rutaImagen);

	      })

	    }
	})

	/*=============================================
	EDITAR PERFIL
	=============================================*/
	$(".tablaSponsors").on("click", ".btnEditarSponsor", function(){

	  var idSponsor = $(this).attr("idSponsor");

		console.log(idSponsor)

	  var datos = new FormData();
	  datos.append("idSponsor", idSponsor);

	  $.ajax({

	    url:"ajax/sponsors.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){

				console.log(respuesta)

 				$("#idSponsor").val(respuesta["id"]);
	      $("#editarNombre").val(respuesta["nombre"]);
	      $("#editarDescripcion").val(respuesta["descripcion"]);
				$("#editarTipo").val(respuesta["tipo"]);
	      $("#imagenActual").val(respuesta["imagen"]);

	      if(respuesta["imagen"] != ""){

	        $(".previsualizar").attr("src", respuesta["imagen"]);

	      }

	    },
			error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
				console.log(xhr.responseText)
      }


	  })


	})

	/*=============================================
	ELIMINAR SPONSOR
	=============================================*/
	$(".tablaSponsors").on("click", ".btnEliminarSponsor", function(){

	  var idSponsor = $(this).attr("idSponsor");
	  var imagenSponsor = $(this).attr("imagenSponsor");


	  swal({
	    title: '¿Está seguro de borrar el sponsor?',
	    text: "¡Si no lo está puede cancelar la accíón!",
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      cancelButtonText: 'Cancelar',
	      confirmButtonText: 'Si, borrar sponsor!'
	  }).then(function(result){

	    if(result.value){

	      window.location = "index.php?ruta=sponsors&idSponsor="+idSponsor+"&imagenSponsor"+imagenSponsor;

	    }

	  })

	})


});
