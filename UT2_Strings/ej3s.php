<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
/*Ejercicio 3: a partir de la dirección IP y la máscara de red, obtener la dirección de red, la
dirección de broadcast y el rango de IPs disponibles para los equipos.*/

/*Declaramos la variable con la ip y la mascara que queramos*/
	$ip="192.168.16.100/16";
	//$ip="192.168.16.100/21";
	//$ip="10.33.15.100/8";
	//$ip ="1.2.3.4/21";
	
/*Ubicamos la posicion de la barra usando la funcion "strpos()" que
encuentra la posición de la primera aparición de una cadenadentro de otra cadena.*/
	$barra = strpos($ip, "/", 0);
	
/*Una vez que sabemos la posicion de la barra "/",
guardamos en otra variable la ip quitando la barra "/",
con la funcion "substr()" que devuelve una parte de una cadena.*/
	$masc = substr($ip, $barra+1);
	

/*Ahora guardaremos en variables la posicion de cada punto
utilizando otra vez la funcion "strpos()".*/
	$pri = strpos($ip,"." ,0);
	$seg = strpos($ip,".",($pri+1));
	$ter = strpos($ip,".",($seg+1));

/*A continuación usaremos la funcion "decbin()" para convertir de decimal a binario
cada parte de la direccion ip separadas por los puntos usando de nuevo la funcion "substr()".*/
	$ip1=decbin(substr($ip,0,$pri));
	$ip2=decbin(substr($ip,($pri+1),($seg-$pri)-1));
	$ip3=decbin(substr($ip,($seg+1),($ter-$seg)-1));
	$ip4=decbin(substr($ip,($ter+1)));

/*El siguiente paso es juntar las partes en binario añadiendo 0 a la izquierda hasta completar 8 bits y lo guardamos en una nueva variable,
para esto hay que utilizar la funcion "str_pad()" que rellena una cadena con una nueva longitud.*/
$ipBin = str_pad($ip1, 8, "0", STR_PAD_LEFT).str_pad($ip2, 8, "0", STR_PAD_LEFT).str_pad($ip3, 8, "0", STR_PAD_LEFT).str_pad($ip4, 8, "0", STR_PAD_LEFT);

/*Ppara obtener la direccion de red segun la mascara
usamos la funcion "substr()" a la ip completa en binario.*/
	$dirRedBin = substr($ipBin, 0, $masc);

//Volvemos a añadir los 0 que faltan hasta completar 32 bits con la funcion "str_paf()".
	$dirRedBin2 = str_pad($dirRedBin, 32, "0", STR_PAD_RIGHT);

//Creamos otra variable para la dirección de broadcast y completamos con 1 hasta 32 bits.
	$dirBro = str_pad($dirRedBin, 32, "1", STR_PAD_RIGHT);

//Añadimos los puntos cada 8 numeros y lo pasamos a decimal para conseguir la direccion de red.
	$dirRedBin3 = bindec(substr($dirRedBin2,0,8)).".".bindec(substr($dirRedBin2,8,8)).".".bindec(substr($dirRedBin2,16,8)).".".bindec(substr($dirRedBin2,24,8));


//Añadimos puntos a la direccion de broadcast y convertimos a decimal.
	$dirBro2 = bindec(substr($dirBro, 0, 8)).".".bindec(substr($dirBro, 8, 8)).".".bindec(substr($dirBro, 16, 8)).".".bindec(substr($dirBro, 24, 8));


//Para conseguir ambos rangos sumamos 1 a la ultima parte de la direccion de red en binario y restamos 1 a la misma parte de la direccion de broadcast.
	$rangoRed = bindec(substr($dirRedBin2,0,8)).".".bindec(substr($dirRedBin2,8,8)).".".bindec(substr($dirRedBin2,16,8)).".".bindec(substr($dirRedBin2,24,8)+1);
	$rangoBro = bindec(substr($dirBro, 0, 8)).".".bindec(substr($dirBro, 8, 8)).".".bindec(substr($dirBro, 16, 8)).".".bindec(substr($dirBro, 24, 8)-1);


//Mostramos los resultados con "echo".
	echo "IP $ip <br>";
	echo "Máscara: $masc <br>";
	echo "Dirección Red: $dirRedBin3 <br>";
	echo "Dirección Broadcast: $dirBro2 <br>";
	echo "Rango: $rangoRed a $rangoBro";

	 
	?>
</body>
</html>
