<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php
	 
	 //Ejercicio 5: mostrar la tabla de multiplciar de un numero con su tabla HTML correspondiente. 
	 
	 $num=8;
	 
	 echo "<table border='1'>";
	 echo "<tbody>";
	 
	 for ($i = 1; $i<=10; $i++){
		 
		 echo "<tr>"."<td>".$num." x ".$i."</td>"."<td>".$num*$i."</td>"."</tr>";
		 
	 }
	 
	 echo "</table>";
	 echo "</tbody>";
	 
	 
	?>
</body>
</html>
