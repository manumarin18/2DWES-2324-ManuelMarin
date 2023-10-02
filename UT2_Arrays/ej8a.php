<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
/*Crear un array asociativo con los nombres de 5 alumnos y la nota de cada uno de ellos en Bases Datos.
Se pide:
a. Mostrar el alumno con mayor nota.
b. Mostrar el alumno con menor nota.
c. Media notas obtenidas por los alumnos*/
			

// Creamos un array asociativo con los nombres de los alumnos y sus notas en Bases Datos.
$notasBasesDatos = [
    "Manu" => 5,
    "Jose" => 9,
    "Rosa" => 8,
    "Ana" => 7,
    "Pedro" => 4
];

// a. Encontrar al alumno con la mayor nota.
$maxNotaAlumno = array_search(max($notasBasesDatos), $notasBasesDatos);

// b. Encontrar al alumno con la menor nota.
$minNotaAlumno = array_search(min($notasBasesDatos), $notasBasesDatos);

// c. Calcular la media de las notas obtenidas por los alumnos.
$mediaNotas = array_sum($notasBasesDatos) / count($notasBasesDatos);

// Mostrar los resultados.
echo "a. El alumno con la mayor nota es: $maxNotaAlumno con una nota de " . max($notasBasesDatos) . "\n";
echo "<br/><br/>";
echo "b. El alumno con la menor nota es: $minNotaAlumno con una nota de " . min($notasBasesDatos) . "\n";
echo "<br/><br/>";
echo "c. La media de las notas obtenidas por los alumnos es: $mediaNotas\n";
?>

</body>
</html>