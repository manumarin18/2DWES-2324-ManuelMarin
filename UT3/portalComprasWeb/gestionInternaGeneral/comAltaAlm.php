<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alta almacenes</title>
</head>
<body>
		<?php
		require('../functions/funciones.php');
		?>
		
		<a href="../index.html"><input type="button" name="volver" value="Inicio"></a></p>
		
		<fieldset>
        <form name="formulario" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <h1> Alta de almacenes:</h1>
    
        <p>Localidad: <input type="text" name="localidad"></p>
         
        <input type="submit" name="Enviar" value="Registrar">
        <input type="reset" name="Borrar" value="Borrar"></p>
 
        </form>	

		<?php
			//var_dump($_POST);
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$valor1 = limpieza($_POST["localidad"]);

			$localidad=$valor1;

			$conexion=crear_conexion();

			alta_almacen($conexion,$localidad);
		}
		?>
		</fieldset>
</body>
</html>