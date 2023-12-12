<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Aprovisionar productos</title>
</head>
<body>
		<?php
		require("../functions/funciones.php");
		?>
		
		<a href="../index.html"><input type="button" name="volver" value="Inicio"></a></p>
		
		<fieldset>
		<form name="formulario" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
		<h1>Aprovisionar productos:</h1>
		
		<p>Introducir cantidad: <input type='text' name='cantidad' style="width: 50px;"/><p>
		
		<p>Seleccionar producto: 
		<?php
			mostrarSelect2();
		?></p>
		
		<p>Seleccionar almacen: 
		<?php
			mostrarSelect3();
		?></p>
		
		<input type="submit" name="submit" value="Aprovisionar"/>
		<input type="reset" name="Borrar" value="Borrar"></p>
		
		</form>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$valor1 = limpieza($_POST["cantidad"]);
				$valor2 = limpieza($_POST["producto"]);
				$valor3 = limpieza($_POST["almacen"]);

				$cantidad=$valor1;
				$producto=$valor2;
				$numAlmacen=$valor3;
				$conexion=crear_conexion();

				aprovisionarProductos($conexion,$cantidad,$producto,$numAlmacen);
			}
		?>
		</fieldset>
</body>
</html>