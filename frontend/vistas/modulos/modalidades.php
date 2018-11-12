

    <div id="modalidades" class="modalidades-section content-hidden">
        <div class="content-wrap">
            <div class="conference">
                <h1 class="modalidades-tittle">
                    Conferencia
                </h1>
                <div class="text">
                    Veni a la conferencia internacional mas prestigiosa de latinoamerica con oradores de todo el mundo, ademas participa de una cena de gala comprando tu entrada vip.
                    Enterate quienes vienen a dar las charlas mas importantes a nivel mundial
                </div>
                <a href="<?php $url ; ?>#people"><button type="button">Oradores!</button></a>
                <div class="right-conf">
                    <img src="img/Sheraton-ConferenceRoom.jpg" alt="">
                </div>
            </div>
            <div class="competition">
                <h1 class="modalidades-tittle">
                    Competencia
                </h1>
                <div class="text">
                    Participa de nuestras competencias y posicionate entre los mejores lashistas a nivel latinoamericano.
                    Inscribite en nuestra modalidad Online
                    <div class="online">
                        <h2>Copa America 2019</h2>
                        <h3>Nominaciones</h3>

                    </div>

                    <?php
                        //include "vistas/modulos/nominaciones.php";

                        $categoria = ControladorProductos::ctrMostrarCategorias("categoria", "CAMPEONATO ONLINE");

                        echo '<button type="button" data-toggle="modal" data-target="#inscripcionOnline" idCompetencia="'.$categoria['id'].'">inscribite</button>';

                    ?>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="inscripcionOnline">

      <div class="modal-dialog" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h4 class="modal-title">Nominaciones - campeonato online</h4>

          </div>

          <div class="modal-body">

            <h4 class="text-center well text-muted text-uppercase">Elige la categoria</h4>

            <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <select class="form-control input-lg seleccionarCategoria">

                    <option value="">Selecionar categoría</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

                    foreach ($subcategorias as $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["subcategoria"].'</option>';
                    }

                    ?>

                    </select>

                </div>

            </div>

            <h4 class="text-center well text-muted text-uppercase selectNominaciones" style="display: none;">Elige las nominaciones</h4>

            <div class="form-group nOpciones">


            </div>

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

            <button type="button" class="btn btn-primary agregarCarrito">Continuar</button>

          </div>

        </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

    </div><!-- /.modal -->
