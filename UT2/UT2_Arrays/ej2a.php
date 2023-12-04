<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
/*Modificar el ejemplo anterior para que calcule la media de los valores
	que están en las posiciones pares y las posiciones impares*/

//Definimos un array para almacenar los números impares y pares.
	$numerosImpares = array();
	$numerosPares = array();
	$sumaImpares = 0; //Inicializamos la variable suma para impares.
	$sumaPares = 0;   //Inicializamos la variable suma para pares.

//Usamos un bucle for para llenar los arrays con los 20 primeros números impares y pares.
	for ($i = 1; count($numerosImpares) <= 20; $i++) {
		//Si $i es impar, lo agregamos al array de impares. Si es par, lo agregamos al array de pares.
		if ($i % 2 == 0) {
			$numerosPares[] = $i;
		} else {
			$numerosImpares[] = $i;
		}
	}

//Creamos una tabla y mostramos los encabezados en la primera fila.
	echo "<table border='1'>
			<tr>
				<td>Índice</td>
				<td>Pares</td>
				<td>Impares</td>
				<td>Media Pares</td>
				<td>Media Impares</td>
			</tr>";

//Usamos un bucle for para recorrer el array de los pares y mostrar los datos en la tabla.
	for ($indice = 0; $indice < count($numerosPares); $indice++) {
		$valorPar = $numerosPares[$indice]; //$valorPar representa el número par actual.
		$sumaPares += $valorPar; //Sumamos el valor actual a la suma de pares.
		$mediaPares = $sumaPares / ($indice + 1); //Calculamos la media de pares.

		//Inicializamos variables para impares.
		$valorImpar = '';
		$mediaImpares = '';

		//Verificamos si el índice existe en el array de impares y calculamos la media de impares si es el caso.
		if ($indice < count($numerosImpares)) {
			$valorImpar = $numerosImpares[$indice];
			$sumaImpares += $valorImpar;
			$mediaImpares = $sumaImpares / ($indice + 1);
		}

		//Mostramos los datos en una fila de la tabla.
		echo "<tr>
				<td>$indice</td>
				<td>$valorPar</td>
				<td>$valorImpar</td>
				<td>$mediaPares</td>
				<td>$mediaImpares</td>
			  </tr>";
	}

	echo "</table>";
?>




</body>
</html>