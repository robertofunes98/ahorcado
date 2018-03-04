<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bienvenido Jugador</title>
    </head>
    <link rel="stylesheet" href="style/estiloGeneral.css">
    <body>
        <div class="div1">
            <center><h1><p>Ahorcado Virtual</p></h1></center>
            <center><h2><p>Bienvenido Jugador</p></h2></center>

            <hr width=100%>

            <center>
                <form method="post">
                    <?php
                        if (!isset($_POST['opcion'])) {
                    ?>


                        <button name="opcion" value="1" class="opciones1"><p>SinglePlayer</p></button>
                        <button name="opcion" value="2" class="opciones2"><p>MultiPlayer</p></button>
                        <button name="opcion" value="3" class="opciones1"><p>Log Out</p></button>

                    <?php
                        } else {
                            $opcion = $_POST['opcion'];

                            switch ($opcion) {
                                case 1:
                                    require_once('singleplayer/index.php');
                                    break;

                                case 2:
                                    require_once('multiplayer/index.php');
                                    break;

                                case 3:
                                    header('location: login.php');
                                    break;

                                default:
                                    header('location: index.php');
                                break;
                            }
                        }
                    ?>
                </form>
            </center>
        </div>

        <footer class="derechos"><center><p>Todos los Derechos Reservados. Desarrolladores: Mario Vanegas, Roberto Funes, Rodrigo Moreno.</p></center></footer>
    </body>
</html>
