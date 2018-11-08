
<ul class="nominaciones">
<?php

    $nominaciones = ControladorNominaciones::ctrMostrarNominaciones(null, null);

    foreach ($nominaciones as $key => $value){
        echo'
        <li>'.$value['tipo'].'</li>
        ';
    }
?>
 </ul>