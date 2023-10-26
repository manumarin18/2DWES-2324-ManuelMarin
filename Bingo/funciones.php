<?php
//Función para generar un cartón de bingo
function generarCarton() {
    $carton = range(1, 60);
    shuffle($carton);
    return array_slice($carton, 0, 15);
}

//Función para comprobar ganador
function ganador($carton, $bolas) {
    $bolasExtraidas = 0;
    $cont = 0;
    for ($i = 0; $i < count($bolas); $i++) {
        for ($j = 0; $j < count($carton); $j++) {
            if ($carton[$j] == $bolas[$i]) {
                $cont++;
                if ($cont == 15) {
                    break;
                }
            }
            $bolasExtraidas++;
        }
        if ($cont == 15) {
            break;
        }
    }
    return $bolasExtraidas;
}

//Función para mostrar un cartón
function verCarton($carton) {
    echo implode(', ', $carton);
}

?>