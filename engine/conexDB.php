<?php
    class conexDB {
        private $conexion;
        private $db;
        private $url;
        private $user;
        private $pass;

        function __construct($dirDocDB) {
            $dirUrl = $dirDocDB . "/url.txt";
            $dirUser = $dirDocDB . "/username.txt";
            $dirPass = $dirDocDB . "/pass.txt";
            $dirDb = $dirDocDB . "/dbName.txt";
            $contURL = file($dirUrl);
            $contUser = file($dirUser);
            $contPass = file($dirPass);
            $contDB = file($dirDb);

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
                exit();
            }
        }

        public function consultaGeneral($tabla) {
            $sql = "SELECT * FROM " . $tabla;
            $result = $this->conexion->query($sql);

            if ($result->num_rows > 0) {
                $datos = $result->fetch_assoc();
                return $datos;
            } else {
                echo "<script type='text/javascript'>alert('No hay datos');</script>";
                exit();
            }
        }

        public function consultaPersonalizada($sql) {
            $result = $this->conexion->query($sql);

            if ($result->num_rows > 0) {
                $datos = $result->fetch_assoc();
                return $datos;
            } else {
                echo "<script type='text/javascript'>alert('No hay datos');</script>";
                exit();
            }
        }

        public function cerrarConex() {
            $this->conexion->close();
        }
    }

?>
