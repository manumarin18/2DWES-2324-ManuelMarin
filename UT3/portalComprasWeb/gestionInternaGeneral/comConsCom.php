<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consulta compras</title>
</head>
<body>
		<?php
		require("../functions/funciones.php");
		?>
		
		<a href="../index.html"><input type="button" name="volver" value="Inicio"></a></p>
		
		<fieldset>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<h1>Consulta de compras: </h1>
			
				<p>NIF: 
				<?php
					mostrarSelect4();
				?></p>
				<p>Fecha desde: <input type='text' name='fechaIni' size=15></p>
				<p>Fecha hasta: <input type='text' name='fechaFin' size=15></p>
				<p><input type="submit" name="submit" value="Consultar compras"/></p>
	
		</form>

		<?php
				//var_dump($_POST);
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$valor1 = limpieza($_POST["cliente"]);
				$valor2 = limpieza($_POST["fechaIni"]);
				$valor3 = limpieza($_POST["fechaFin"]);
				
				$cliente=$valor1;
				$fechaIni=$valor2;
				$fechaFin=$valor3;
				
				$conexion=crear_conexion();
				
				consultarCompras2($conexion,$cliente,$fechaIni,$fechaFin);
				
			}
		?>
		 </fieldset>
</body>
</html>