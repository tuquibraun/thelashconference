<div class="online-section">
    <div class="content-wrap">
        <div class="online-tittle">
        <?php
              $nominaciones = ControladorProductos::ctrMostrarProductos(null, null, null);
        ?>
            <h1>Inscripcion Online</h1>
        </div>
        <div class="online-info">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur temporibus repellat amet repudiandae ex quis ullam nemo,
        </div>
        <div class="nominaciones">
            
            <select class="form seleccionarNom" id="seleccionarNominacion">
                        <option value="">Nominacion</option>
                        <?php
                        foreach ($nominaciones as $key =>$value){
                            echo '<option value="'.$nominaciones["titulo"].'">'.$nominaciones["titulo"].'</option>';
                        }
                        ?>
            </select>
                
            <div class="inscribirme">
                <?php
                
                echo '<button class="btn agregarAlCarrito" >inscribite</button>';
               
              ?>
            </div>
                    
        </div>
    </div>
</div>