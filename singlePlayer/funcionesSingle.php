<?php
    include_once("../engine/conexDB.php");

    function aggPalabra($palabra, $pista) {
        $datos = "'" . $palabra . "',NULL,'" . $pista . "'";
        $campos = "texto,reporte,pista";
        $tabla = "Palabra";

        $conexion1 = new conexDB();
        $conexion1->ingresarDatos($tabla, $datos, $campos);
        $conexion1->cerrarConex();

        echo "<script type='text/javascript'>alert('Palabra Ingresada Correctamente');</script>";
    }

    public function busquedaPalabra() {
        $tabla = "Palabra";
        $conexion2 = new conexDB();
        $resultados = $conexion2->consultaGeneral($tabla);
        $cantResultados = count($resultados);
        $idPalabra = mt_rand(1, $cantResultados);
        $sql = "SELECT * FROM Palabra WHERE codigoPalabra = " . $idPalabra;
        $resultConsultaPalabra = $conexion2->consultaPersonalizada($sql);
        $palabra = $resultConsultaPalabra[0]['texto'];

        return $palabra; 
    }
?>
