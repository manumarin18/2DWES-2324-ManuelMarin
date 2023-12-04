<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Operaciones Ficheros</title>
</head>
<body>
<h1>Operaciones Ficheros</h1>
   <?php
//Función para validar y limpiar datos de entrada
function limpiar_datos($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}

//Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $valor1 = limpiar_datos($_POST["caja1"]);
  $valor2 = limpiar_datos($_POST["caja2"]);
  $valor3 = limpiar_datos($_POST["caja3"]);
  $valor4 = limpiar_datos($_POST["fichero"]);
}


$validar="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["caja1"])) {
    echo $validar = "Error: No se ha introducido ningun fichero <br>";
  }
  if (empty($_POST["caja2"]) && $valor4=="MostrarLinea") {
    echo $validar = "Error: No se ha introducido ningun numero <br>";
  } 
  if (empty($_POST["caja3"])&& $valor4=="MostrarPrimeraLineas") {
   echo $validar = "Error: No se ha introducido ningun numero <br>";
  } 
  if (empty($_POST["fichero"])) {
   echo $validar = "Error: No se ha seleccionado ninguna operacion <br>";
  } 
}


$nombre_fichero = $valor1;

	if (file_exists($nombre_fichero)) {
	  
	   if($valor4=="MostrarFichero" ){
			$fichero=readfile("$nombre_fichero");
			echo "<br>";
			//readfile("$nombre_fichero");
	   }
	   
	   if($valor4=="MostrarLinea" && !empty($valor2)){
			$fichero=file($nombre_fichero);
			// var_dump($fichero);
			$valor2=(int)$valor2;
			foreach($fichero as $linea=>$texto) {
				if($linea==$valor2){
					echo "<b>Linea ".$linea."</b><br>".$texto;
					// var_dump($texto);
				}
			}
	   }
	   if($valor4=="MostrarPrimeraLineas"){
			$fichero=file($nombre_fichero);
			$valor3=(int)$valor3;
			foreach($fichero as $linea=>$texto) {
				if($linea<$valor3){
					echo "<b>"."Linea ".$linea.":</b> ".$texto."<br>";
					/* var_dump($texto); */
				}
			}
	   }
	} 
	else {
		echo "El fichero $nombre_fichero no existe";
	}

?>

</body>
</html>
