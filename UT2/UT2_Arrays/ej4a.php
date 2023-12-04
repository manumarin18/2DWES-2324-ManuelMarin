<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
/*Partiendo del array definido en el ejercicio anterior crear un nuevo 
	array que almacene los números binarios en orden inverso.*/

//Definimos un array para almacenar los números binarios en orden inverso.
	$numerosBinariosInversos = array();

//Usamos un bucle for para llenar el array con los 20 primeros números binarios en orden inverso.
	for ($i = 19; $i >= 0; $i--) {
		//En cada iteración, convertimos $i a su representación binaria y lo agregamos al array.
		$binario = decbin($i);
		$numerosBinariosInversos[] = $binario;
	}

//Creamos una tabla y mostramos los encabezados en la primera fila.
	echo "<table border='1'>
			<tr>
				<td>Índice</td>
				<td>Binario</td>
				<td>Octal</td>
			</tr>";

//Usamos un bucle for para recorrer el array y mostrar los datos en la tabla.
	for ($indice = 0; $indice < count($numerosBinariosInversos); $indice++) {
		//$binario representa el número binario actual.
		//Convertimos el número binario a su equivalente en octal.
		$octal = octdec($numerosBinariosInversos[$indice]);
		//Mostramos los datos en una fila de la tabla.
		echo "<tr>
				<td>$indice</td>
				<td>{$numerosBinariosInversos[$indice]}</td>
				<td>$octal</td>
			  </tr>";
	}

	echo "</table>";
?>

</body>
</html>