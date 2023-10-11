<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php
// Función para validar y limpiar datos de entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos y limpiamos los datos ingresados
    $nombre = test_input($_POST['nombre']);
    $apellido1 = test_input($_POST['apellido1']);
    $apellido2 = test_input($_POST['apellido2']);
    $email = test_input($_POST['email']);
    $sexo = test_input($_POST['sexo']);

    // Comprobamos que los campos obligatorios tengan valor
    if (!empty($nombre) && !empty($email) && !empty($sexo)) {
        // Creamos una tabla HTML con los datos ingresados
        echo "<h2>Datos Alumnos:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Sexo</th></tr>";
        echo "<tr><td>$nombre</td><td>$apellido1 $apellido2</td><td>$email</td><td>$sexo</td></tr>";
        echo "</table>";

        // Almacenamos los datos en el archivo datos.txt
        $datos = "Nombre: $nombre\nApellidos: $apellido1 $apellido2\nEmail: $email\nSexo: $sexo\n\n";
        file_put_contents("datos.txt", $datos, FILE_APPEND);

    } else {
        echo "Los campos obligatorios (*) deben completarse.";
    }
}
?>

</body>
</html>