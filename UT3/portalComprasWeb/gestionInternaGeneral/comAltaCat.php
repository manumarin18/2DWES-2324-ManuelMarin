<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alta categorías</title>
</head>
<body>
		<?php
		require("../functions/funciones.php");
		?>
		
		<a href="../index.html"><input type="button" name="volver" value="Inicio"></a></p>
		
		<fieldset>
        <form name="formulario" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          
        <h1> Alta de categorías:</h1>
    
        <p>Nombre de categoria: <input type='text' name='categoria' size=15></p>

        <input type="submit" name="Enviar" value="Registrar">
        <input type="reset" name="Borrar" value="Borrar">
	
        </form>	
		
		<?php	
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$valor1 = limpieza($_POST["categoria"]);

				$categoria=$valor1;
				$conexion=crear_conexion();

				insertar_categoria($conexion,$categoria);
			}
		?>
		</fieldset>

</body>
</html>
