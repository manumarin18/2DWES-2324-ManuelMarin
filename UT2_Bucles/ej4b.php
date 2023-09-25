<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
	 //Ejercicio 4: Mostrar por pantalla la tabla de multiplicar de un numero usando bucles.
	 
	 $num=8;
	 
	 echo "<table>";
	 echo "<tbody>";
	 
	 for ($i = 1; $i<=10; $i++){
		 
		 echo "<tr>"."<td>".$num." x ".$i."</td>"."<td>"." = ".$num*$i."</td>"."</tr>";
		 
	 }
	 
	 echo "</table>";
	 echo "</tbody>";
	 
	 
	 
	?>
</body>
</html>
