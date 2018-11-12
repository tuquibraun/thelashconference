$(document).ready(function() {

  $(".seleccionarCategoria").change(function(){

    $(".selectNominaciones").show()

		var subcategoria = $(this).val();

		$(".nominaciones").html("");

		var datos = new FormData();
		datos.append("idSubCategoria", subcategoria);

		 $.ajax({
		    url:"ajax/producto.ajax.php",
		    method:"POST",
		    data: datos,
		    cache: false,
		    contentType: false,
		    processData: false,
		    dataType: "json",
		    success:function(respuesta){

		    	//console.log("respuesta", respuesta);

		    	$(".nominaciones").show();

          $(".nominacion").remove()

		    	respuesta.forEach(funcionForEach);

		        function funcionForEach(item, index){

		        	$(".nOpciones").append(

                '<div class="checkbox nominacion"><label><input type="checkbox" value="'+item["id"]+'" titulo="'+item["titulo"]+'" precio="'+item["precio"]+'" idSubcategoria="'+item["id_subcategoria"]+'" idCategoria="'+item["id_categoria"]+'">'+item["titulo"]+'</label></div>'

	    			)

		      }

		    },
        error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log(xhr.responseText)
      }

		})

	})


});
