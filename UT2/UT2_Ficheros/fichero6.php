<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Operaciones Ficheros</title>
</head>
<body>

   <?php
$valor1 = ($_POST["caja1"]);

$validar="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["caja1"])) {
    echo $validar = "Error: No se ha introducido ningun fichero <br>";
  }
}
/* var_dump($_POST); */

$nombre_fichero = $valor1;

	if(file_exists($nombre_fichero)) {
		
		$nombre=basename($nombre_fichero); 
		$directorio=dirname($nombre_fichero);
		$tamano=filesize($nombre_fichero);
		$ultimaModificacion=date("d/m/Y H:i:s",filemtime($nombre_fichero));
		
		 //var_dump($nombre);
		 //var_dump($directorio);
		 //var_dump($tamano);
		 //var_dump($ultimaModificacion);
		echo "<h1><b>Operaciones Ficheros</b></h1>";
		echo "<b>Nombre del fichero: </b>".$nombre."<br>";
		echo "<b>Directorio: </b>".$directorio."<br>";
		echo "<b>Tamano del fichero: </b>".$tamano." bytes<br>";
		echo "<b>Fecha ultima modificacion fichero: </b>".$ultimaModificacion."<br>"; 

	}
 /* fileatime () Devuelve la última hora de acceso a un archivo */
 /* filemtime () Devuelve la última hora de modificación de un archivo */
 /* fstat () Devuelve información sobre un archivo abierto */
 /* lstat () Devuelve información sobre un archivo o enlace simbólico */
 /* pathinfo () Devuelve información sobre la ruta de un archivo */
 /* realpath () Devuelve el nombre de la ruta absoluta */
 /* stat () Devuelve información sobre un archivo
 /* filesize() */
?>

</body>
</html>
