<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Datos Alumnos</title>
</head>
<body>
	<?php
	echo "<h2>Datos Ingresados:</h2>";
	echo "<table border='1'>
			<tr>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Fecha Nacimineto</th>
				<th>Localidad</th>
			</tr>";
		$fichero = fopen("alumnos1.txt", "r");
		$filas = 0; //Inicializamos el contador de filas
		while (!feof($fichero)) {
			echo "<tr>";
			echo "<td>" . fgets($fichero, 40) . "</td>";
			echo "<td>" . fgets($fichero, 82) . "</td>";
			echo "<td>" . fgets($fichero, 11) . "</td>";
			echo "<td>" . fgets($fichero, 160) . "</td>";
			echo "</tr>";
			$filas++; //Incrementamos el contador de filas
		}
		echo "</table>";
		fclose($fichero); //Cierra el archivo después de su uso
		echo "<p>Número de filas leídas: $filas</p>"; //Muestra el número de filas leídas
	?>
	</body>
</html>
