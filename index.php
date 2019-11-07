<?php
    include_once("engine/engine.php");
    @session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bienvenido <?php echo $_SESSION['usuario']; ?></title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <link rel="stylesheet" href="menus/style/estiloGeneral.css">
    <body>
        <div class="div1">
            <center><h1><p>Ahorcado Virtual</p></h1></center>
            <center><h2><p>Bienvenido <font color='#01b438'><?php echo $_SESSION['usuario']; ?></font></p></h2></center>

            <center><h3><p>Ahora usando integracion continua de google <font color='#01b438'>B)</font></p></h3></center>

            <center><h3><p>High-Score&nbsp;&nbsp;<font color='#aecd17'><?php echo highScore('engine/datosDB', $_SESSION['usuario']); ?></font></p></h3></center>

            <hr width=100%>

            <center>
                <form method="post">
                    <?php
                        if (!isset($_POST['opcion'])) {
                    ?>


                        <button name="opcion" value="1" class="opciones1"><p>SinglePlayer</p></button>
                        <button name="opcion" value="2" class="opciones2"><p>MultiPlayer</p></button>
                        <button name="opcion" value="3" class="opciones1"><p>LogOut</p></button>

                    <?php
                        } else {
                            $opcion = $_POST['opcion'];

                            switch ($opcion) {
                                case 1:
                                    require_once('menus/singleplayer/index.php');
                                    break;

                                case 2:
                                    require_once('menus/multiplayer/index.php');
                                    break;

                                case 3:
                                    header('location: logout.php');
                                    break;

                                case 4:
                                    header('location: singlePlayer/normal/');
                                    break;

                                case 5:
                                    header('location: singlePlayer/contrareloj/');
                                    break;

                                case 6:
                                    header('location: singlePlayer/aggPalabra/');
                                    break;
                            }
                        }
                    ?>
                </form>
            </center>
        </div>

        <footer class="derechos"><center><p>Todos los Derechos Reservados. Desarrolladores: Mario Vanegas, Roberto Funes.</p></center></footer>
    </body>
</html>
