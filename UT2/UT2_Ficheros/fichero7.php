<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Operaciones Sistemas Ficheros</title>
</head>
<body>

 <?php

$validar="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["caja1"])) {
    echo $validar = "Error: No se ha introducido ninguna ruta <br>";
  }
  if (empty($_POST["caja2"])&& $_POST["fichero"]=="CopiarFichero") {
    echo $validar = "Error: No se ha introducido ninguna ruta <br>";
  }
   if (empty($_POST["fichero"])) {
    echo $validar = "Error: No has elegido operacion <br>";
  }
  
}
 $valor1 = ($_POST["caja1"]);
 $valor2 = ($_POST["caja2"]);
 $valor3 = ($_POST["fichero"]);
 
var_dump($_POST);

$fichero = $valor1;
$fichero2 = $valor2;
/* var_dump($fichero);
var_dump($fichero2); */

	if(file_exists($fichero)){
		if($valor3=="CopiarFichero"){
			//copy — Copia un fichero
			$fichero=realpath($valor1);
			$fichero2=basename($valor1);
			$fichero3=dirname($valor2);
			$fichero4="$fichero3"."\ "."$fichero2";
			if (file_exists($fichero4)) {
				echo "Error al copiar el fichero $fichero4 EXISTE \n";
			}else{
				copy($fichero2, $fichero4);
			}
			var_dump($fichero);
			var_dump($fichero2);
			var_dump($fichero3);
		}
		
		
		if($valor3=="RenombrarFichero"){
			//rename — Renombra un fichero o directorio
			$fichero=realpath($valor1);
			$fichero2=basename($valor1);
			$fichero3=dirname($valor2);
			$fichero4="$fichero3"."\ "."$fichero2";
			var_dump($fichero);
			var_dump($fichero2);
			var_dump($fichero3);
			var_dump($fichero4);
			/* rename("$valor1","$fichero4"); */
					
		}
		if($valor3=="BorrarFichero"){
			//unlink — Borra un fichero
		}
	}
else{
	$directorio=dirname($fichero);
	var_dump($directorio);
	echo "El directorio "."$directorio"." NO existe <br>";
	mkdir("$directorio");
	echo "Se ha creado el directorio ".$directorio;
	$aux=fopen("$fichero","x");
	fwrite($aux,"hello");
	fclose($aux);
}


if(file_exists($fichero2)) {
	echo "El directorio DESTINO ".dirname($valor2)." EXISTE";
}
else{
	echo "<br>";
	echo "El directorio ".dirname($valor2)." NO existe<br>";
	$directorio2=dirname($valor2);
	if(!file_exists($directorio2)){
		mkdir($directorio2);
		echo "Se ha creado el directorio ".dirname($valor2);
		$aux=fopen("$fichero2","x");
		fwrite($aux,"hello2");
		fclose($aux);
	}
}
	
	


 /*  fileatime () Devuelve la última hora de acceso a un archivo */
 /* filemtime () Devuelve la última hora de modificación de un archivo */
 /*  fstat () Devuelve información sobre un archivo abierto */
 /* lstat () Devuelve información sobre un archivo o enlace simbólico */
 /* pathinfo () Devuelve información sobre la ruta de un archivo */
 /* realpath () Devuelve el nombre de la ruta absoluta */
/* stat () Devuelve información sobre un archivo
 /* filesize() */

?>

</body>
</html>
