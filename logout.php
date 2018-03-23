<?php
    @session_start();
    include_once("engine/conexDB.php");
    include_once("engine/engine.php");

    if (comprobarSession() == false) {
        header('location: login.php');
    }

    $dirDocumentos = "engine/datosDB";
    $consultas = new conexDB($dirDocumentos);
    $sql3 = "update Jugador set Enlinea = false where usuario = '" . $_SESSION['usuario'] . "'";
    $consultas->consultaPersonalizada($sql3);

    session_destroy();
    header('location: login.php');
?>
