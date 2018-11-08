<?php

class ControladorNominaciones{
    
    static public function ctrMostrarNominaciones($tipo, $value){
        $tabla = 'nominaciones';

        $respuesta = ModeloNominaciones::mdlMostrarNominaciones($tabla, $tipo, $value);

        return $respuesta;
    }
}