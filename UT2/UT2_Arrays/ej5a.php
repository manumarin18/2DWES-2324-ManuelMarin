<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
/*Definir tres arrays con los siguientes valores relativos a módulos que se imparten en el ciclo DAW:
“Bases Datos”, “Entornos Desarrollo”, “Programación” “Sistemas Informáticos”,”FOL”,”Mecanizado” “Desarrollo Web ES”,”Desarrollo Web EC”,”Despliegue”,”Desarrollo Interfaces”, “Inglés”
Se pide:
a. Unir los 3 arrays en uno único sin utilizar funciones de arrays
b. Unir los 3 arrays en uno único usando la función array_merge()
c. Unir los 3 arrays en uno único usando la función array_push() */

//Definimos los tres arrays.
$modulos1 = ["Bases Datos", "Entornos Desarrollo", "Programación"];
$modulos2 = ["Sistemas Informáticos", "FOL", "Mecanizado"];
$modulos3 = ["Desarrollo Web ES", "Desarrollo Web EC", "Despliegue", "Desarrollo Interfaces", "Inglés"];

//Creamos un nuevo array combinando los tres arrays manualmente usando bucles for.
$modulosCombinados = $modulos1;
for ($i = 0; $i < count($modulos2); $i++) {
    $modulosCombinados[] = $modulos2[$i];
}
for ($i = 0; $i < count($modulos3); $i++) {
    $modulosCombinados[] = $modulos3[$i];
}

//Mostramos el array resultante en una tabla usando un bucle for.
echo "<table border='1'>";
echo "<tr><th>Módulos Combinados (Manual)</th></tr>";
for ($i = 0; $i < count($modulosCombinados); $i++) {
    $modulo = $modulosCombinados[$i];
    echo "<tr><td>$modulo</td></tr>";
}
echo "</table>";

//Usamos la función array_merge() para combinar los tres arrays.
$modulosCombinados = array_merge($modulos1, $modulos2, $modulos3);

//Mostramos el array resultante en una tabla usando un bucle for.
echo "<table border='1'>";
echo "<tr><th>Módulos Combinados (array_merge)</th></tr>";
for ($i = 0; $i < count($modulosCombinados); $i++) {
    $modulo = $modulosCombinados[$i];
    echo "<tr><td>$modulo</td></tr>";
}
echo "</table>";

//Creamos un array vacío para almacenar los módulos combinados.
$modulosCombinados = [];

//Usamos array_push() para agregar los elementos de los tres arrays al array combinado.
for ($i = 0; $i < count($modulos1); $i++) {
    array_push($modulosCombinados, $modulos1[$i]);
}
for ($i = 0; $i < count($modulos2); $i++) {
    array_push($modulosCombinados, $modulos2[$i]);
}
for ($i = 0; $i < count($modulos3); $i++) {
    array_push($modulosCombinados, $modulos3[$i]);
}

//Mostramos el array resultante en una tabla usando un bucle for.
echo "<table border='1'>";
echo "<tr><th>Módulos Combinados (array_push)</th></tr>";
for ($i = 0; $i < count($modulosCombinados); $i++) {
    $modulo = $modulosCombinados[$i];
    echo "<tr><td>$modulo</td></tr>";
}
echo "</table>";
?>


	
</body>
</html>