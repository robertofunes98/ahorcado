<?php
    function escribirDatosDB($URL, $user, $pass, $db) {
        //archivo que contiene direccion de BD
        $fileConex = fopen("datosDB/url.txt", "w+");
        fwrite($fileConex, $URL);
        fclose($fileConex);
        //archivo que contiene username
        $fileConex = fopen("datosDB/username.txt", "w+");
        fwrite($fileConex, $user);
        fclose($fileConex);
        //archivo que contiene password
        $fileConex = fopen("datosDB/pass.txt", "w+");
        fwrite($fileConex, $pass);
        fclose($fileConex);
        //archivo que contendra direccion de BD
        $fileConex = fopen("datosDB/dbName.txt", "w+");
        fwrite($fileConex, $db);
        fclose($fileConex);
    }

    if (isset($_POST["btnAceptar"])) {
        $URL = $_POST['txtUrlDB'];
        $user = $_POST['txtUsername'];
        $pass = $_POST['passUser'];
        $db = $_POST['txtDbName'];

        if (is_dir("datosDB/")) {
            escribirDatosDB($URL, $user, $pass, $db);
        } else {
            mkdir("datosDB", 0777, true);
            escribirDatosDB($URL, $user, $pass, $db);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Configuracion BD</title>
    </head>
    <body>
        <form method="post">
            <table border="1px" bordercolor="black">
                <tr>
                    <td><center>URL</center></td>
                    <td><center><input type="text" name="txtUrlDB" placeholder="localhost" value="localhost" required></center></td>
                </tr>

                <tr>
                    <td><center>User</center></td>
                    <td><center><input type="text" name="txtUsername" placeholder="root" value="root" required></center></td>
                </tr>

                <tr>
                    <td><center>Pass</center></td>
                    <td><center><input type="password" name="passUser" value=""></center></td>
                </tr>

                <tr>
                    <td><center>DB</center></td>
                    <td><center><input type="text" name="txtDbName" placeholder="ahorcadoBD" value="ahorcadoBD" required></center></td>
                </tr>

                <tr>
                    <td colspan="2"><center><button name="btnAceptar">Aceptar</button></center></td>
                </tr>
            </table>
        </form>
    </body>
</html>
