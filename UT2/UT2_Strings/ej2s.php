<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
	 /*Ejercicio 2: realiza el mismo programa del ejercicio anterior 
	 pero sin utilizar las funciones printf o sprintf.*/
	 
	 $ip1="192.18.16.204";
	 $ip2=explode(".",$ip1);
	
	 for ($i = 0; $i<count($ip2); $i++){
		 $ip2[$i] = str_pad(decbin($ip2[$i]),8,"0",STR_PAD_LEFT);
		 
	 }
	 //var_dump ($ip2);
	 
	 echo "IP ". $ip1;	 
	 echo " en binario es ". implode (".",$ip2);
	 
	 echo "<br/><br/>";
	 
//-------------------------------------------------------------------
	 $ip3="10.33.161.2";
	 $ip4=explode(".",$ip3);
	 
	 for ($i=0; $i<count($ip4); $i++){
		 $ip4[$i] = str_pad(decbin($ip4[$i]), 8, "0", STR_PAD_LEFT);
		 
	 }
	 
	 echo "IP ". $ip3;
	 echo " en binario es ".implode (".",$ip4);
	 
	 echo "<br/><br/>";
	
	?>
</body>
</html>
