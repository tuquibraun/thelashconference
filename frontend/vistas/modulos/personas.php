<div id="people" class="people-section content-hidden">
   <div class="content-wrap">
      <div class="box-tittle">
          <h1 class="people-tittle">Oradores &amp; Jurado</h1>

      </div>

      <div class="people-line">

      <?php

      $personas = ControladorPersonas::ctrMostrarPersonas(null, null);

      foreach ($personas as $key => $value) {


        echo '
        <div class="card">
          <img class="person" src="http://localhost/thelashconference/maquetado2/frontend/'.$value['img'].'" alt="">
          <h3 class="name">'.$value['nombre'].'</h3>
          <h3 class="rol">'.$value['tipo'].'</h3>
          <i></i><h4 class="country">'.$value['pais'].'</h4>
        </div>';


      }

       ?>


       </div>

   </div>

</div>
