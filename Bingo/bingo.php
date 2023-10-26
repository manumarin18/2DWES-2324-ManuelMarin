<HTML>
<HEAD><TITLE>BINGO</TITLE></HEAD>
<BODY>
<?php

include "funciones.php";

$jugadorGanador = 0;
$cartonGanador = 0;
$ganadorEncontrado = false;

//Metemos el array en una variable y lo mezclamos
$bolas = range(1, 60);
shuffle($bolas);

//JUGADORES
for ($jugador = 1; $jugador <= 4; $jugador++) {
    echo "<h3>Jugador $jugador:</h3>";

    for ($carton = 1; $carton <= 3; $carton++) {
        $cartonBingo = generarCarton();

        echo "Cartón $carton: ";
        verCarton($cartonBingo);
        echo "<br>";

        $bolasExtraidas = ganador($cartonBingo, $bolas);

        if (!$ganadorEncontrado || $bolasExtraidas < $minBolas) {
            $jugadorGanador = $jugador;
            $cartonGanador = $carton;
            $minBolas = $bolasExtraidas;
            $ganadorEncontrado = true;
        }
    }
}

echo "<h3>Gana el jugador $jugadorGanador con el cartón $cartonGanador.";

?>
</BODY>
</HTML>