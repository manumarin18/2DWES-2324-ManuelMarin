<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alta clientes</title>
</head>
<body>
		<?php
		require("../functions/funciones.php");
		?>
		
		<a href="../index.html"><input type="button" name="volver" value="Inicio"></a></p>
		
		<fieldset>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			
			<h1>Alta de cliente:</h1>		

			<p>NIF: <input type='text' name='nif' size=15></p>
			<p>Nombre: <input type='text' name='nombre' size=15></p>
			<p>Apellido: <input type='text' name='apellido' size=15></p>
			<p>CP: <input type='text' name='cp' size=15></p>
			<p>Dirección: <input type='text' name='direccion' size=15></p>
			<p>Localidad: <input type='text' name='ciudad' size=15></p><br>
			<input type="submit" name="submit" value="Dar de alta"/>
			<input type="reset" name="Borrar" value="Borrar">
		
		</form>

		<?php
			//var_dump($_POST);
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$valor1 = limpieza($_POST["nif"]);
				$valor2 = limpieza($_POST["nombre"]);
				$valor3 = limpieza($_POST["apellido"]);
				$valor4 = limpieza($_POST["cp"]);
				$valor5 = limpieza($_POST["direccion"]);
				$valor6 = limpieza($_POST["ciudad"]);
				
				$NIF=$valor1;
				$Nombre=$valor2;
				$Apellido=$valor3;
				$CP=$valor4;
				$Direccion=$valor5;
				$Ciudad=$valor6;
				$conexion=crear_conexion();
				
				insertar_cliente($conexion,$NIF,$Nombre,$Apellido,$CP,$Direccion,$Ciudad);
			}
		?>
		</fieldset>	
</body>
</html>