<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Bolsa2</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body> 
    <form name="formulario" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <h2>Valor Empresa</h2>
        <label for = "name">Nombre de la empresa</label>
        <input type="text" name="name">
        <br>
        <br>
        <input type="submit" name="submit" >
    </form>
<?php
	require "funciones_bolsa.php";
	$fichero = "ibex35.txt";
	if(isset($_POST["submit"])){
		$linea = $_POST["name"];
		leerlinea($fichero,$linea);
	}
?>
</body>
</html>