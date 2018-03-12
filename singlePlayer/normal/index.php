<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Normal</title>
        <link rel="stylesheet" href="../../menus/style/estiloGeneral.css">
        <script type="text/javascript" src="funciones.js"></script>
    </head>
    <body onload="iniciar();foco();" onkeydown="enviarEnter(event)">
        <?php include_once("../../menus/juego/header.php"); ?>

        <div class="div1">
            <center>
                <br><br><br>

                <table>
                    <tr>
                        <td colspan="3"><center id="respuesta"></center></td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <center>
                                <p>Ingrese una letra</p>
                                <input type="text" size="3" name="txtLetra" id="txtLetra" maxlength="1">
                                <button class="boton1" name="btnEnviarLetra" onclick="enviarLetra();foco();limpiar();">Aceptar</button>
                            </center>
                        </td>
                    </tr>
                </table>
            <center>
        </div>
    </body>
</html>
