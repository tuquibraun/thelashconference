<?php

if($_SESSION["perfil"] != "administrador"){

echo '<script>

  window.location = "inicio";

</script>';

return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar sponsors

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar sponsors</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSponsor" id="lala">

          Agregar sponsor

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaSponsors" width="100%">

          <thead>

           <tr>

             <th style="width:10px">#</th>
             <th>Nombre</th>
             <th>Descripcion</th>
             <th>Imagen</th>
             <th>Tipo</th>
             <th>Acciones</th>

           </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR SPONSOR
======================================-->

<div id="modalAgregarSponsor" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" class="form-control input-lg" name="nuevoSponsor">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Sponsor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>


            <!-- ENTRADA PARA SELECCIONAR TIPO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoTipo">

                  <option value="">Selecionar tipo</option>

                  <option value="bronce">Bronce</option>

                  <option value="silver">Silver</option>

                  <option value="gold">Gold</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripcion" id="nuevaDescripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/perfiles/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Sponsor</button>

        </div>

        <?php

          $crearSponsor = new ControladorSponsors();
          $crearSponsor -> ctrCrearSponsor();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SPONSOR
======================================-->

<div id="modalEditarSponsor" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" class="form-control input-lg" id="idSponsor" name="idSponsor">

        <input type="hidden" class="form-control input-lg" name="editarSponsor">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Sponsor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" placeholder="Ingresar nombre" required>

              </div>

            </div>


            <!-- ENTRADA PARA SELECCIONAR TIPO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarTipo">

                  <option value="" id="editarTipo">Selecionar tipo</option>

                  <option value="bronce">Bronce</option>

                  <option value="silver">Silver</option>

                  <option value="gold">Gold</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="text" class="form-control input-lg" name="editarDescripcion" value="" placeholder="Ingresar Descripcion" id="editarDescripcion">

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/perfiles/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Sponsor</button>

        </div>

        <?php

          $editarSponsor = new ControladorSponsors();
          $editarSponsor -> ctrEditarSponsor();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $eliminarSponsor = new ControladorSponsors();
  $eliminarSponsor -> ctrEliminarSponsor();

?>
