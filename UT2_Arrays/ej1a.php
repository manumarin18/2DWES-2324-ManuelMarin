<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
/*Definir un array y almacenar los 20 primeros números impares.
	Mostrar en la salida una tabla como la de la figura*/

//Definimos un array para almacenar los números impares.
	$numerosImpares = array();
	$suma = 0;//Inicializamos la variable suma.

//Usamos un bucle for para llenar el array con los 20 primeros números impares.
	for ($i = 1; count($numerosImpares) < 20; $i += 2) {
		$numerosImpares[] = $i;//Agregamos el número impar actual al array $numerosImpares.
	}

//Creamos una tabla y mostramos el índice, el valor y la suma.
	echo "<table border='1'>
			<tr>
				<td>Índice</td>
				<td>Valor</td>
				<td>Suma</td>
			</tr>";

//Usamos un bucle for para recorrer el array y mostrar los datos en la tabla.
	for ($indice = 0; $indice < count($numerosImpares); $indice++) {
		$valor = $numerosImpares[$indice];//$valor representa el número impar actual.
		$suma += $valor;//Sumamos el valor actual a la suma acumulada.
		//Mostramos los datos en una fila de la tabla.
		echo "<tr>
				<td>$indice</td>
				<td>$valor</td>
				<td>$suma</td>
			  </tr>";
	}


	echo "</table>";
?>


</body>
</html>