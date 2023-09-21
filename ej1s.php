<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
	/*Ejercicio 1: Convertir la IP a su representacion en binario 
	 haciendo uso de la funcion printf o sprintf únicamente se podrán 
	 utilizar funciones de cadenas de caracteres.*/
	 
	 $ip="192.18.16.204";
	 
	//utilizo la funcion "explode" para divir la cadena de caracteres en un array.
	 $ip2=explode(".",$ip);
		 
	//hago un bucle con la funcion "count()" que devuelve el numero de elementos del array.
	//uso la funcion "decbin()" para convertir decimal a binario.
	//uso la funcion "str_pad()" para añadir con ceros los ceros a la izquierda del numero binario.
	 for ($i=0; $i<count($ip2); $i++){
		 $ip2[$i] = str_pad(decbin($ip2[$i]),8,"0",STR_PAD_LEFT);
		 
	 }
	 
	 //var_dump ($ip2); para ver el array.
	 
	 //uso la funcion "printf()" para mostrar la ip. 
	 printf ("IP " .$ip);
	 
	 //con la funcion "implode" devuelvo el contenido del array ya cambiado por el bucle y el ddecbin.
	 printf (" en binario es ".implode (".",$ip2));
	 
	 echo "<br/><br/>";
	 
	 //repito el código con otra ip.
	 
	 $ip3="10.33.161.2";
	 $ip4=explode(".",$ip3);
	 
	 for ($i=0; $i<count($ip4); $i++){
		 $ip4[$i] = str_pad(decbin($ip4[$i]), 8, "0", STR_PAD_LEFT);
		 
	 }
	 
	 printf ("IP " .$ip3);
	 printf (" en binario es ".implode (".",$ip4));
	 
	 echo "<br/><br/>";	 
	 
	?>
</body>
</html>