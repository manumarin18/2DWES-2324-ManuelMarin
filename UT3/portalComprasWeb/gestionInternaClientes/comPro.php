<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Compra productos</title>
</head>
<body>
		<?php
		require("../functions/funciones.php");
		?>
		
		<a href="../index.html"><input type="button" name="volver" value="Inicio"></a></p>
		
		<fieldset>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			
			<h1>Realizar compra:</h1>
			
			<p>NIF: 
			<?php
				mostrarSelect4();
			?></p>
			<p>Productos: 
			<?php
				mostrarSelect2();
			?></p>
			<p>Unidades: <input type='text' name='Unidades' size=15 style="width: 50px;"></p>
			<p><input type="submit" name="submit" value="Comprar"/>
			<input type="reset" name="Borrar" value="Borrar">
		
		</form>

<?php
		//var_dump($_POST);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$valor1 = limpieza($_POST["cliente"]);
		$valor2 = limpieza($_POST["producto"]);
		$valor3 = limpieza($_POST["Unidades"]);
		
		$cliente=$valor1;
		$producto=$valor2;
		$unidades=$valor3;
		$fechaCompra=date('Y-m-d');
		$conexion=crear_conexion();
		
		$almacen=disponibilidadAlmacen($conexion,$producto);
		
		//var_dump($almacen);
		
		if($almacen <= 0){
			echo "<h1>No hay stock en ningun almacen</h1>";
		}
		else{
		//insertar 
			compraDeProductos($conexion,$cliente,$producto,$fechaCompra,$unidades);
			actualizarAlmacen($conexion,$producto,$unidades);
		}
	}

?>
</fieldset>
</body>
</html>