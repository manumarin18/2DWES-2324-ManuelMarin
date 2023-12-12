<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consulta stock</title>
</head>
<body>
		<?php
		require("../functions/funciones.php");
		?>
		
		<a href="../index.html"><input type="button" name="volver" value="Inicio"></a></p>
		
		<fieldset>
		<form name="formulario" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

		<h1>Consulta de stock:</h1>
		
		<p>Seleccionar producto: 
		<?php
			mostrarSelect2();
		?></p>
		
		<input type="submit" name="submit" value="Consultar"/></p>

		</form>

		<?php
			//var_dump($_POST); 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$valor1 = limpieza($_POST["producto"]);

			$producto=$valor1;

			$conexion=crear_conexion();

			consultarStock($conexion,$producto);
			
		}
		?>
		</fieldset>
</body>
</html>
