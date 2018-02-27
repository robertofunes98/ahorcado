<?php
    class motor {
        private $palabra;
        private $posLetra;
        private $totalLetras; //letras que se han adivinado
        private $intentos;
        private $tiempoRest;

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
            if ($this->totalLetras == strlen($this->palabra)) {
                return true;
            } else {
                return false;
            }
        }

        public function setTiempoRest($tiempoRest) {
            $this->tiempoRest = $tiempoRest;
        }

        public function Calificar() {
            $puntos = 0;

            switch ($this->totalLetras) {
                case $this->totalLetras == 1:
                    $puntos += 1;
                    break;

                case $this->totalLetras == 2:
                    $puntos += 5;
                    break;

                case $this->totalLetras >= 3:
                    $puntos += 10;
                    break;

                default:
                    $puntos += 0;
                    break;
            }

            switch ($this->tiempoRest) {
                case $this->tiempoRest > 20 && $this->tiempoRest <= 30:
                    $puntos += 10;
                    break;

                case $this->tiempoRest > 10 && $this->tiempoRest <= 20:
                    $puntos += 5;
                    break;

                case $this->tiempoRest > 0 && $this->tiempoRest <= 10:
                    $puntos += 3;
                    break;

                default:
                    $puntos += 1;
                    break;
            }

            switch ($this->intentos) {
                case 0:
                    $puntos += 10;
                    break;

                case 1:
                    $puntos += 5;
                    break;

                case 2:
                    $puntos += 1;
                    break;

                default:
                    $puntos = 0;
                    break;
            }

            return $puntos;
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
