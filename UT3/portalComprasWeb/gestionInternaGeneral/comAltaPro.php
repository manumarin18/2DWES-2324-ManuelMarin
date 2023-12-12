<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alta productos</title>
</head>
<body>
		<?php
		require("../functions/funciones.php");
		?>	
		
		<a href="../index.html"><input type="button" name="volver" value="Inicio"></a></p>
		
		<fieldset>
        <form name="formulario" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
     
        <h1> Alta de productos: </h1>
    
        <p>Nombre del producto: <input type='text' name='producto' size=15></p>	
		<p>Precio del producto: <input type='text' name='precio' size=15></p>
		<p><label for ="Categoria">Seleccionar categoría</label>
            
        <?php 
        mostrarSelect();
        ?></p>

        <input type="submit" name="Enviar" value="Registrar">
        <input type="reset" name="Borrar" value="Borrar">

        </form>	
    
		<?php	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$valor1 = limpieza($_POST["categoria"]);
			$valor2 = limpieza($_POST["producto"]);
			$valor3 = limpieza($_POST["precio"]);
			
			$categoria=$valor1;
			$producto=$valor2;
			$precio=$valor3;
			
			$conexion=crear_conexion();

			insertar_Producto($conexion,$producto,$precio,$categoria);
		}
			//var_dump($_POST);
		?>
		</fieldset>
		
</body>
</html>
