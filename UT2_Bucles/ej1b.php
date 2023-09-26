<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php /*Transformar un número decimal a binario usando bucles
			(no se podrá utiliza la función decbin)*/
			
//Creamos las variables
$inicial = 127;
$decimal = $inicial;
//Creamos variable para almacenar el número binario
$binario = "";
//Hacemos un bucle "while" para realizar la conversión
	while ($inicial > 0) { //establecemos que el bucle se ejecutará mientras la variable  $inicial  sea mayor que 0
		$resto = $inicial % 2; //obtenemos el resto de la división de  $inicial  por 2. Esto nos da el dígito binario correspondiente al valor actual de  $inicial
		$binario = $resto . $binario; //concatenamos el dígito binario obtenido en la línea anterior al número binario existente,
									  //esto nos permite construir el número binario en el orden correcto, agregando los dígitos de derecha a izquierda
		$inicial = ($inicial - $resto) / 2; //actualizamos el valor de  $inicial  dividiéndolo por 2 y restando el resto obtenido,
											//esto nos permite avanzar al siguiente dígito binario en la siguiente iteración del bucle
	}
//Añadimos ceros a la izquierda del número binario para que se muestre completo
	$binario = str_pad($binario, 8, "0", STR_PAD_LEFT);
		
	echo "El número decimal $decimal en binario es: $binario";//Mostramos el resultado
	 
	?>
</body>
</html>