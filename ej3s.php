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
	$ipA="192.168.16.100/16";
	
/*Ubicamos la posicion de la barra usando la funcion "strpos()" que
encuentra la posición de la primera aparición de una cadenadentro de otra cadena.*/
	$barraA = strpos($ipA, "/", 0);
	
/*Una vez que sabemos la posicion de la barra "/",
guardamos en otra variable la ip quitando la barra "/",
con la funcion "substr()" que devuelve una parte de una cadena.*/
	$mascA = substr($ipA, $barraA+1);
	

/*Ahora guardaremos en variables la posicion de cada punto
utilizando otra vez la funcion "strpos()".*/
	$priA = strpos($ipA,"." ,0);
	$segA = strpos($ipA,".",($priA+1));
	$terA = strpos($ipA,".",($segA+1));

/*A continuación usaremos la funcion "decbin()" para convertir de decimal a binario
cada parte de la direccion ip separadas por los puntos usando de nuevo la funcion "substr()".*/
	$ip1A=decbin(substr($ipA,0,$priA));
	$ip2A=decbin(substr($ipA,($priA+1),($segA-$priA)-1));
	$ip3A=decbin(substr($ipA,($segA+1),($terA-$segA)-1));
	$ip4A=decbin(substr($ipA,($terA+1)));

/*El siguiente paso es juntar las partes en binario añadiendo 0 a la izquierda hasta completar 8 bits y lo guardamos en una nueva variable,
para esto hay que utilizar la funcion "str_pad()" que rellena una cadena con una nueva longitud.*/
	$ipBinA = str_pad($ip1A, 8, "0", STR_PAD_LEFT).str_pad($ip2A, 8, "0", STR_PAD_LEFT).str_pad($ip3A, 8, "0", STR_PAD_LEFT).str_pad($ip4A, 8, "0", STR_PAD_LEFT);

/*Ppara obtener la direccion de red segun la mascara
usamos la funcion "substr()" a la ip completa en binario.*/
	$dirRedBinA = substr($ipBinA, 0, $mascA);

//Volvemos a añadir los 0 que faltan hasta completar 32 bits con la funcion "str_paf()".
	$dirRedBin2A = str_pad($dirRedBinA, 32, "0", STR_PAD_RIGHT);

//Creamos otra variable para la dirección de broadcast y completamos con 1 hasta 32 bits.
	$dirBroA = str_pad($dirRedBinA, 32, "1", STR_PAD_RIGHT);

//Añadimos los puntos cada 8 numeros y lo pasamos a decimal para conseguir la direccion de red.
	$dirRedBin3A = bindec(substr($dirRedBin2A,0,8)).".".bindec(substr($dirRedBin2A,8,8)).".".bindec(substr($dirRedBin2A,16,8)).".".bindec(substr($dirRedBin2A,24,8));


//Añadimos puntos a la direccion de broadcast y convertimos a decimal.
	$dirBro2A = bindec(substr($dirBroA, 0, 8)).".".bindec(substr($dirBroA, 8, 8)).".".bindec(substr($dirBroA, 16, 8)).".".bindec(substr($dirBroA, 24, 8));

//Para conseguir ambos rangos sumamos 1 a la ultima parte de la direccion de red en binario y restamos 1 a la misma parte de la direccion de broadcast.
	$rangoRedA = bindec(substr($dirRedBin2A,0,8)).".".bindec(substr($dirRedBin2A,8,8)).".".bindec(substr($dirRedBin2A,16,8)).".".bindec(substr($dirRedBin2A,24,8)+1);
	$rangoBroA = bindec(substr($dirBroA, 0, 8)).".".bindec(substr($dirBroA, 8, 8)).".".bindec(substr($dirBroA, 16, 8)).".".bindec(substr($dirBroA, 24, 8)-1);


//Mostramos los resultados con "echo".
	echo "<h3>Ejemplos salida:</h3>";
	echo "IP $ipA <br>";
	echo "Máscara: $mascA <br>";
	echo "Dirección Red: $dirRedBin3A <br>";
	echo "Dirección Broadcast: $dirBro2A <br>";
	echo "Rango: $rangoRedA a $rangoBroA";

	echo "<br/><br/>";
	 
//Finalmente repetimos todo el codigo para que aparezcan el resto de direcciones IP.

	$ipB ="192.168.16.100/21";

	$barraB = strpos($ipB, "/", 0);
	$mascB = substr($ipB, $barraB+1);

	$priB = strpos($ipB,"." ,0);
	$segB = strpos($ipB,".",($priB+1));
	$terB = strpos($ipB,".",($segB+1));

	$ip1B=decbin(substr($ipB,0,$priB));
	$ip2B=decbin(substr($ipB,($priB+1),($segB-$priB)-1));
	$ip3B=decbin(substr($ipB,($segB+1),($terB-$segB)-1));
	$ip4B=decbin(substr($ipB,($terB+1)));

	$ipBinB = str_pad($ip1B, 8, "0", STR_PAD_LEFT).str_pad($ip2B, 8, "0", STR_PAD_LEFT).str_pad($ip3B, 8, "0", STR_PAD_LEFT).str_pad($ip4B, 8, "0", STR_PAD_LEFT);

	$dirRedBinB = substr($ipBinB, 0, $mascB);

	$dirRedBin2B = str_pad($dirRedBinB, 32, "0", STR_PAD_RIGHT);

	$dirBroB = str_pad($dirRedBinB, 32, "1", STR_PAD_RIGHT);

	$dirRedBin3B = bindec(substr($dirRedBin2B,0,8)).".".bindec(substr($dirRedBin2B,8,8)).".".bindec(substr($dirRedBin2B,16,8)).".".bindec(substr($dirRedBin2B,24,8));

	$dirBro2B = bindec(substr($dirBroB, 0, 8)).".".bindec(substr($dirBroB, 8, 8)).".".bindec(substr($dirBroB, 16, 8)).".".bindec(substr($dirBroB, 24, 8));

	$rangoRedB = bindec(substr($dirRedBin2B,0,8)).".".bindec(substr($dirRedBin2B,8,8)).".".bindec(substr($dirRedBin2B,16,8)).".".bindec(substr($dirRedBin2B,24,8)+1);

	$rangoBroB = bindec(substr($dirBroB, 0, 8)).".".bindec(substr($dirBroB, 8, 8)).".".bindec(substr($dirBroB, 16, 8)).".".bindec(substr($dirBroB, 24, 8)-1);

	echo "IP $ipB <br>";
	echo "Máscara: $mascB <br>";
	echo "Dirección Red: $dirRedBin3B <br>";
	echo "Dirección Broadcast: $dirBro2B <br>";
	echo "Rango: $rangoRedA a $rangoBroB";

	echo "<br/><br/>";

/*-------------------------------------------------------------*/

	$ipC="10.33.15.100/8";

	$barraC = strpos($ipC, "/", 0);
	$mascC = substr($ipC, $barraC+1);

	$priC = strpos($ipC,"." ,0);
	$segC = strpos($ipC,".",($priC+1));
	$terC = strpos($ipC,".",($segC+1));

	$ip1C=decbin(substr($ipC,0,$priC));
	$ip2C=decbin(substr($ipC,($priC+1),($segC-$priC)-1));
	$ip3C=decbin(substr($ipC,($segC+1),($terC-$segC)-1));
	$ip4C=decbin(substr($ipC,($terC+1)));

	$ipBinC = str_pad($ip1C, 8, "0", STR_PAD_LEFT).str_pad($ip2C, 8, "0", STR_PAD_LEFT).str_pad($ip3C, 8, "0", STR_PAD_LEFT).str_pad($ip4C, 8, "0", STR_PAD_LEFT);

	$dirRedBinC = substr($ipBinC, 0, $mascC);

	$dirRedBin2C = str_pad($dirRedBinC, 32, "0", STR_PAD_RIGHT);

	$dirBroC = str_pad($dirRedBinC, 32, "1", STR_PAD_RIGHT);

	$dirRedBin3C = bindec(substr($dirRedBin2C,0,8)).".".bindec(substr($dirRedBin2C,8,8)).".".bindec(substr($dirRedBin2C,16,8)).".".bindec(substr($dirRedBin2C,24,8));

	$dirBro2C = bindec(substr($dirBroC, 0, 8)).".".bindec(substr($dirBroC, 8, 8)).".".bindec(substr($dirBroC, 16, 8)).".".bindec(substr($dirBroC, 24, 8));

	$rangoRedC = bindec(substr($dirRedBin2C,0,8)).".".bindec(substr($dirRedBin2C,8,8)).".".bindec(substr($dirRedBin2C,16,8)).".".bindec(substr($dirRedBin2C,24,8)+1);

	$rangoBroC = bindec(substr($dirBroC, 0, 8)).".".bindec(substr($dirBroC, 8, 8)).".".bindec(substr($dirBroC, 16, 8)).".".bindec(substr($dirBroC, 24, 8)-1);

	echo "IP $ipC <br>";
	echo "Máscara: $mascC <br>";
	echo "Dirección Red: $dirRedBin3C <br>";
	echo "Dirección Broadcast: $dirBro2C <br>";
	echo "Rango: $rangoRedC a $rangoBroC";

	echo "<br/><br/>";
	 
	?>
</body>
</html>