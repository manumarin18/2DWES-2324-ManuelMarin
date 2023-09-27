<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<?php /*Definir un array y almacenar los 20 primeros números impares.
			Mostrar en la salida una tabla como la de la figura*/
	
	
$imp = array();
$suma = 0;
$indice = 0;

echo "<table border=2>";
echo "Primeros 20 impares:";
echo "<tr><td>Indice</td><td>Valor</td><td>Suma</td></tr>";

for ($i=1; $i<40; $i++)
{
	if ($i%2!=0)
	{
		$imp[$i]=$i;
		$suma=$suma+$imp[$i];
		echo "<tr><td>$indice</td><td>$imp[$i]</td><td>$suma</td></tr>";
		$indice++;
	}
}
	
	
	
	?>
</body>
</html>
