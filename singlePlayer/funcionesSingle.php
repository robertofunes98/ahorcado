<?php
    include_once("../engine/conexDB.php");

    function aggPalabra($palabra, $pista) {
        $datos = "'" . $palabra . "',NULL,'" . $pista . "'";
        $campos = "texto,reporte,pista";
        $tabla = "Palabra";
        $dirDocuentos = "../engine/datosDB";

        $conexion1 = new conexDB($dirDocuentos);
        $conexion1->ingresarDatos($tabla, $datos, $campos);
        $conexion1->cerrarConex();

        echo "<script type='text/javascript'>alert('Palabra Ingresada Correctamente');</script>";
    }
?>
