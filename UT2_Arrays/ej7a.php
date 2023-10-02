<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
/*Crear un array asociativo con los nombres de 5 alumnos y la edad de cada uno de ellos. Se pide:
a. Mostrar el contenido del array utilizando bucles
b. Sitúa el puntero en la segunda posición del array y muestra su valor
c. Avanza una posición y muestra el valor
d. Coloca el puntero en la última posición y muestra el valor
e. Ordena el array por orden de edad (de menor a mayor) y muestra la primera posición del array y la última.*/
			

// Creamos un array asociativo con los nombres de los alumnos y sus edades.
$alumnos = [
    "Manu" => 26,
    "Jose" => 25,
    "Rosa" => 24,
    "Ana" => 23,
    "Juan" => 22
];

// Función para mostrar un array en una tabla.
function mostrarTabla($titulo, $array) {
    echo "<h2>$titulo</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Edad</th></tr>";
    
    // Utilizamos un bucle for para recorrer el array.
    $nombres = array_keys($array); // Obtenemos los nombres de los alumnos.
    $edades = array_values($array); // Obtenemos las edades de los alumnos.
    $count = count($array); // Obtenemos la cantidad de elementos en el array.
    for ($i = 0; $i < $count; $i++) {
        $nombre = $nombres[$i]; // Obtenemos el nombre del alumno en la posición $i.
        $edad = $edades[$i]; // Obtenemos la edad del alumno en la posición $i.
        echo "<tr><td>$nombre</td><td>$edad</td></tr>"; // Mostramos el nombre y la edad en una fila de la tabla.
    }
    
    echo "</table>";
}

//Mostramos el contenido del array utilizando un bucle for.
mostrarTabla("a. Contenido del Array", $alumnos);

//Situamos el puntero en la segunda posición del array y mostramos su valor.
reset($alumnos); // Reiniciamos el puntero al inicio del array.
next($alumnos); // Avanzamos una posición en el array.
$segundoAlumno = current($alumnos); // Obtenemos el valor actual del puntero.
mostrarTabla("b. Valor del Segundo Alumno", ["Segundo Alumno" => $segundoAlumno]);

//Avanzamos una posición y mostramos el valor.
next($alumnos); // Avanzamos una posición en el array.
$tercerAlumno = current($alumnos); // Obtenemos el valor actual del puntero.
mostrarTabla("c. Valor del Tercer Alumno", ["Tercer Alumno" => $tercerAlumno]);

//Colocamos el puntero en la última posición y mostramos el valor.
end($alumnos); // Colocamos el puntero en la última posición del array.
$ultimoAlumno = current($alumnos); // Obtenemos el valor actual del puntero.
mostrarTabla("d. Valor del Último Alumno", ["Último Alumno" => $ultimoAlumno]);

//Ordenamos el array por edad (de menor a mayor).
asort($alumnos); // Ordenamos el array manteniendo la asociación entre nombres y edades.

//Mostramos la primera posición (el alumno más joven) y la última (el alumno más mayor) del array.
$alumnoMasJoven = key($alumnos); // Obtenemos la clave (nombre) del primer elemento del array.
$edadMasJoven = current($alumnos); // Obtenemos el valor (edad) del primer elemento del array.
end($alumnos); // Colocamos el puntero en la última posición del array.
$alumnoMasMayor = key($alumnos); // Obtenemos la clave (nombre) del último elemento del array.
$edadMasMayor = current($alumnos); // Obtenemos el valor (edad) del último elemento del array.

mostrarTabla("e. Alumno más Joven y Alumno más Mayor", ["Alumno más Joven" => "$alumnoMasJoven (Edad: $edadMasJoven)", "Alumno más Mayor" => "$alumnoMasMayor (Edad: $edadMasMayor)"]);
?>


</body>
</html>