<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php /*Transformar un número decimal a cualquier otra base (base 2 a base 9)
			usando bucles (no se podrán utilizar las funcionesde conversión).*/

//Definimos el número decimal que queremos convertir y la base a la que queremos convertirlo
$inicial = 48;
$decimal = $inicial;
$base = 8;

//Creamos una variable para almacenar el número en la nueva base
$numeroBase = '';


while ($inicial > 0) { //Mientras el número decimal sea mayor que 0, realizamos la conversión
    $residuo = $inicial % $base;//Obtenemos el resrto de la división del número decimal entre la base
    $inicial = ($inicial - $residuo) / $base;//Obtenemos el resultado de la división entera del número decimal entre la base    
    $numeroBase = $residuo . $numeroBase;//Concatenamos el resto obtenido a la cadena del número en la nueva base
}

//Imprimimos el resultado de la conversión
echo "El número decimal " . $decimal . " en base " . $base . " es: " . $numeroBase;

?>
	 

</body>
</html>