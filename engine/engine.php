<?php
    class motor {
        private $palabra;
        private $posLetra;
        private $totalLetras; //letras que se han adivinado
        private $intentos;

        function __construct($dificultad) {
            /*espacio para codigo de busqueda de palabra*/
            $this->palabra = $palabra;
            $this->totalLetras = 0;
            $this->intentos = 0;
        }

        public function verificarLetra($letra) {
            if ($this->intentos < 3) {
                $letrasCorr = 0; //cantidad de letras correctas en la palabra

                for ($i=0; $i < strlen($this->palabra); $i++) {
                    if ($letra == substr($this->palabra, $i, 1)) {
                        $this->posLetra[$i] = $letra;
                        $letrasCorr++;
                        $this->totalLetras += $letrasCorr;
                    }
                }

                if ($letrasCorr > 0) {
                    return true;
                } else {
                    $this->intentos++;
                    return false;
                }
            } else {
                return 0; //cero significa intentos agotados
            }
        }

        public function estPalabra() {
            if ($totalLetras == strlen($this->palabra)) {
                return true;
            } else {
                return false;
            }
        }

        public function tiempoFuera() { //SOLO MULTIPLAYER
            $this->intentos = 3;
        }

        public function getPos() {
            return $this->posLetra;
        }

        public function getIntentos() {
            return $this->intentos;
        }

        public function getPalabra() {
            return $this->palabra;
        }

        public function getLetrasCorr() {
            return $this->totalLetras;
        }
    }
?>
