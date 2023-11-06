<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Datos Alumnos</title>
</head>
<body>
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
  $nombre = limpiar_datos($_POST["caja1"]);
  $apellido1 = limpiar_datos($_POST["caja2"]);
  $apellido2 = limpiar_datos($_POST["caja3"]);
  $fecha = limpiar_datos($_POST["caja4"]);
  $localidad = limpiar_datos($_POST["caja5"]);
}

var_dump($_POST);

$fichero =fopen("alumnos2.txt","a");

$escritura=$nombre."##".$apellido1."##".$apellido2."##".$fecha."##".$localidad."##"."\n";

fwrite($fichero,$escritura);

fclose($fichero);

?>
</body>
</html>
