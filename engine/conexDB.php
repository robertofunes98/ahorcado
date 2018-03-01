<?php
    class conexDB {
        private $conexion;
        private $db;
        private $url;
        private $user;
        private $pass;

        function __construct() {
            $contURL = file("datosDB/url.txt");
            $contUser = file("datosDB/username.txt");
            $contPass = file("datosDB/pass.txt");
            $contDB = file("datosDB/dbName.txt");

            $this->url = $contURL[0];
            $this->user = $contUser[0];

            if ($contPass[0] == 0) {
                $this->pass = "";
            } else {
                $this->pass = $contPass[0];
            }

            $this->db = $contDB[0];

            $this->conexion = new mysqli($this->url, $this->user, $this->pass, $this->db);

            if ($this->conexion->connect_error) {
                die("Error al Conectarse a la Base de Datos! " . $this->conexion-connect_error);
            }
        }

        public function ingresarDatos($tabla, $datos, $campos) {
            $sql = "INSERT INTO " . $tabla . "(". $campos . ") VALUES (" . $datos . ")";

            if ($this->conexion->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Datos Ingresados Correctamente');</script>";
            } else {
                echo "Error: " . $this->conexion->error;
            }
        }

        public function consultaGeneral($tabla) {
            $sql = "SELECT * FROM " . $tabla;
            $resul = $this->conexion->query($sql);

            if ($result->num_rows > 0) {
                $datos = $result->fetch_assoc();
                return $datos;
            } else {
                echo "<script type='text/javascript'>alert('No hay datos');</script>";
            }
        }

        public function consultaPersonalizada($sql) {
            $resul = $this->conexion->query($sql);

            if ($result->num_rows > 0) {
                $datos = $result->fetch_assoc();
                return $datos;
            } else {
                echo "<script type='text/javascript'>alert('No hay datos');</script>";
            }
        }

        public function cerrarConex() {
            $this->conexion->close();
        }
    }

?>
