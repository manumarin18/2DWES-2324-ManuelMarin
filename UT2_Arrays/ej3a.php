<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
/*Definir un array y almacenar los 20 primeros números binarios.
	Mostrar en la salida una tabla como la de la figura*/

//Definimos un array para almacenar los números binarios.
	$numerosBinarios = array();

//Usamos un bucle for para llenar el array con los 20 primeros números binarios.
	for ($i = 0; count($numerosBinarios) < 20; $i++) {
		//En cada iteración, convertimos $i a su representación binaria y lo agregamos al array.
		$binario = decbin($i);
		$numerosBinarios[] = $binario;
	}

//Creamos una tabla y mostramos los encabezados en la primera fila.
	echo "<table border='1'>
			<tr>
				<td>Índice</td>
				<td>Binario</td>
				<td>Octal</td>
			</tr>";

//Usamos un bucle for para recorrer el array y mostrar los datos en la tabla.
	for ($indice = 0; $indice < count($numerosBinarios); $indice++) {
		//$binario representa el número binario actual.
		//Convertimos el número binario a su equivalente en octal.
		$octal = octdec($numerosBinarios[$indice]);
		//Mostramos los datos en una fila de la tabla.
		echo "<tr>
				<td>$indice</td>
				<td>{$numerosBinarios[$indice]}</td>
				<td>$octal</td>
			  </tr>";
	}


	echo "</table>";
?>

</body>
</html>