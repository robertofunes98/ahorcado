<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ahorcado Virtual</title>
        <link rel="stylesheet" href="../menus/style/estiloGeneral.css">
        <script type="text/javascript" src="funciones.js"></script>
    </head>
    <body onload="iniciar();foco();" onkeydown="enviarEnter(event)">
        <table border="3" bordercolor="black">
            <tr>
                <td colspan="3"><center id="respuesta"></center></td>
            </tr>

            <tr>
                <td colspan="3">
                    <center>
                        <p>Ingrese una letra</p>
                        <input type="text" size="3" name="txtLetra" id="txtLetra" maxlength="1">
                        <button name="btnEnviarLetra" onclick="enviarLetra();foco();limpiar();">Aceptar</button>
                    </center>
                </td>
            </tr>
        </table>
    </body>
</html>
