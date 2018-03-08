<?php
    include_once('../../engine/conexDB.php');
    include_once('../../engine/engine.php');

    session_start();

    $dirDocumentos = "../../engine/datosDB";

    if (isset($_POST['letra'])) {
        $letra = $_POST['letra'];
        $palabra = $_SESSION['palabra'];

        $letraEvaluar = new motor($palabra);

        if ($letraEvaluar->verificarLetra($letra) == true) {
            $posLetra = $letraEvaluar->getPos();

            for ($i=0; $i < strlen($_SESSION['palabra']); $i++) {
                if (!$posLetra[$i] == 0) {
                    $_SESSION['letras'][$i] = $posLetra[$i];
                }
            }

            $juegoFinalizado = true;

            for ($i=0; $i < strlen($_SESSION['palabra']); $i++) {
                if ($_SESSION['letras'][$i] == "0") {
                    $juegoFinalizado = false;
                }
            }

            if ($juegoFinalizado != false) {
                echo "<h1>Palabra Correcta!</h1>";

                $_SESSION['palabra'] = buscarPalabra($dirDocumentos);

                for ($i=0; $i < strlen($_SESSION['palabra']); $i++) {
                    $_SESSION['letras'][$i] = 0;
                }
            }
        } else {
            echo "letra mala";
        }
    } else {
        session_destroy();
        session_start();
        $_SESSION['palabra'] = buscarPalabra($dirDocumentos);

        for ($i=0; $i < strlen($_SESSION['palabra']); $i++) {
            $_SESSION['letras'][$i] = 0;
        }
    }

    $mostrar = "<table><tr>";

    for ($i=0; $i < strlen($_SESSION['palabra']); $i++) {
        if ($_SESSION['letras'][$i] == "0") {
            $espacioLetras = "";
        } else {
            $espacioLetras = $_SESSION['letras'][$i];
        }

        $mostrar .= "<td><p>" . $espacioLetras . "</p></td>";
    }

    $mostrar .= "</tr><tr>";

    for ($i=0; $i < strlen($_SESSION['palabra']); $i++) {
        $mostrar .= "<td><p>___</p></td>";
    }

    $mostrar .= "</tr></table>";

    echo $mostrar;
?>
