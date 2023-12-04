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
    //Obtenemos y limpiamos los datos ingresados
	$valor1 = limpiar_datos($_POST["caja1"]);
	$valor2 = limpiar_datos($_POST["caja2"]);
	$valor3 = limpiar_datos($_POST["caja3"]);
	$valor4 = limpiar_datos($_POST["caja4"]);
	$valor5 = limpiar_datos($_POST["caja5"]);
}

var_dump($_POST);

$fichero =fopen("alumnos1.txt","a");

$nombre=str_pad($valor1,39);
var_dump($nombre);


$apellido1=str_pad($valor2,40);
var_dump($apellido1);


$apellido2=str_pad($valor3,41);
var_dump($apellido2);


$fecha=str_pad($valor4,9);
var_dump($fecha);


$localidad=str_pad($valor5,26);
var_dump($localidad);

$escritura=$nombre.$apellido1.$apellido2.$fecha.$localidad;

fwrite($fichero,$escritura."\n");

fclose($fichero);

?>
</body>
</html>
