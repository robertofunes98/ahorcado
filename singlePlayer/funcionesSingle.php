<?php
    function aggPalabra($palabra) {
        /*conexion a la DB*/
    }

    function calificar($intentos, $tiempo = 100) {
        $puntos = 0;

        switch ($tiempo) {
            case $tiempo > 20 && $tiempo <= 30:
                $puntos += 10;
                break;

            case $tiempo > 10 && $tiempo <= 20:
                $puntos += 5;
                break;

            case $tiempo > 0 && $tiempo <= 10:
                $puntos += 3;
                break;

            default:
                $puntos += 1;
                break;
        }

        switch ($intentos) {
            case 0:
                $puntos += 10;
                break;

            case 1:
                $puntos += 5;
                break;

            case 2:
                $puntos += 1;
                break;

            default:
                $puntos = 0;
                break;
        }

        return $puntos;
    }
?>
