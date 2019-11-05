<?php
    include_once('engine/conexDB.php');
    include_once('engine/engine.php');


    if (isset($_POST['login'])) {
        $username = $_POST['txtUsername'];
        $password = $_POST['passUsername'];
        $consultas = new conexDB("engine/datosDB");
        $sql1 = "SELECT * FROM Jugador WHERE usuario = '" . trim($username) . "'";
        $consultaUser = $consultas->consultaPersonalizada($sql1);

        if ($consultaUser == false) {
            $texto = "<font color='#e24949'>No existe el usuario!&nbsp;<u>&quot;" . $username . "!&quot;</u><font>";
        } else {
            $sql2 = "SELECT * FROM Jugador WHERE usuario = '" . trim($username) . "' ";
            $sql2 .= "AND aes_decrypt(contra, 'contra') = '" . trim($password) . "'";
            $consultaPass = $consultas->consultaPersonalizada($sql2);

            if ($consultaPass == false) {
                $texto = "<font color='#e24949'>Contrase&ntilde;a Incorrecta!<font>";
            } else {
                @session_start();
                $_SESSION['usuario'] = trim($username);
                $sql3 = "update Jugador set Enlinea = true where usuario = '" . $_SESSION['usuario'] . "'";
                @$consultas->consultaPersonalizada($sql3);
                @$consultas->cerrarConex();
                header('location: index.php');
            }
        }
    } else {
        $texto = "Iniciar Sesion";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="menus/style/estiloGeneral.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <center><h1><p>Ahorcado Virtual</p></h1></center>

        <center>
            <form method="post">
                <table>
                    <tr>
                        <th colspan="2"><center><p><?php echo $texto; ?></p></center></th>
                    </tr>

                    <tr>
                        <td><center><p>Username:</p></center></td>
                        <td><center><p><input type="text" name="txtUsername" maxlength="30" placeholder="Usuario123" required/></p></center></td>
                    </tr>

                    <tr>
                        <td><center><p>Password:</p></center></td>
                        <td><center><p><input type="password" name="passUsername" maxlength="30" placeholder="*********" required/></p></center></td>
                    </tr>

                    <tr>
                        <td colspan="2"><center><button type="button" onclick="window.location.href = 'registro/';" class="boton2">Registrarse</button>&nbsp;&nbsp;<button name="login" class="boton1">Login</button></center></td>
                    </tr>
                </table>
            </form>
        </center>
    </body>
</html>
