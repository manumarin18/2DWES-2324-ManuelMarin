<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php /*Transformar un número decimal a hexadecimal usando bucles
			(no se podrá utilizar lafunción de conversión dechex)*/

//Definimos el número decimal a convertir
$inicial = 1515;
$decimal = $inicial;
//Definimos la base hexadecimal
$base = 16;

//Creamos un array con los dígitos hexadecimales
$digitos = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');

//Inicializamos la variable que almacenará el resultado hexadecimal
$hexadecimal = '';

//Mientras el número sea mayor que 0, continuamos con la conversión
while ($inicial > 0) {
    //Obtenemos el resto de la división entre el número y la base
    $remainder = $inicial % $base;
    
    //Concatenamos el dígito hexadecimal correspondiente al resto al resultado hexadecimal
    $hexadecimal = $digitos[$remainder] . $hexadecimal;
    
    //Actualizamos el número dividiéndolo entre la base (redondeando hacia abajo)
    $inicial = (int)($inicial / $base);
}

// Imprimimos el resultado de la conversión
echo "Número $decimal en base $base = $hexadecimal<br>";


?>

</body>
</html>