<?php
    include_once('../engine/conexDB.php');
    include_once('../engine/engine.php');
    include_once('../singlePlayer/funcionesSingle.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ahorcado Virtual</title>
        <link rel="stylesheet" href="../menus/style/estiloGeneral.css">
    </head>
    <body>
        <?php
            $palabra = busquedaPalabra();
            echo $palabra ."<br><br><br>";

            $longPal = strlen($palabra);

            for ($i=0; $i < $longPal; $i++) {
                $palabra[$i] = substr($palabra, $i, 1);
                echo "<input type='text' maxlength=1 name='letraPal[]' size=3 value=" . $palabra[$i] . " disabled />&nbsp;&nbsp;";
            }
        ?>

        <br><br>

        <p>Ingrese una letra</p>
        <input type="text" maxlength="1" id="txtLetraEvaluar" size="4">
        <button name="btnEvaluar">Aceptar</button>
    </body>
</html>
