<?php
    include_once("conexDB.php");

    function buscarPalabra($dirDocumentos) {
        $tabla = "Palabra";
        $conexion2 = new conexDB($dirDocumentos);
        $resultados = $conexion2->consultaGeneral($tabla);
        $cantResultados = count($resultados);
        $idPalabra = mt_rand(1, $cantResultados);
        $sql = "SELECT * FROM Palabra WHERE codigoPalabra = " . $idPalabra;
        $resultConsultaPalabra = $conexion2->consultaPersonalizada($sql);

        return $resultConsultaPalabra;
    }

    class motor {
        private $palabra;
        private $posLetra;

        function __construct($palabra) {
            $this->palabra = $palabra;
        }

        public function verificarLetra($letra) {
            $letrasCorr = 0; //cantidad de letras correctas en la palabra

            for ($i=0; $i < strlen($this->palabra); $i++) {
                if ($letra == substr($this->palabra, $i, 1)) {
                    $this->posLetra[$i] = $letra;
                    $letrasCorr++;
                } else {
                    $this->posLetra[$i] = 0;
                }
            }

            if ($letrasCorr > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getPos() {
            return $this->posLetra;
        }
    }
?>
