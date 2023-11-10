<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Bolsa1</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
	<?php
		require "funciones_bolsa.php";
		$fichero = "ibex35.txt";
		leerarchi($fichero);
	?>
</body>
</html>