<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <title>Datos Alumnos</title>
</head>
<body>
    <h1>Datos Alumnos</h1>
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
		<label for="nombre">*Obligatorio</label>
        <br><br>

       <label for="apellido1">Apellido1:</label>
        <input type="text" name="apellido1">
        <br><br>

        <label for="apellido2">Apellido2:</label>
        <input type="text" name="apellido2">
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required>
		<label for="nombre">*Obligatorio</label>
        <br><br>

        <label for="sexo">Sexo:</label>
		<input type="radio" name="sexo" value="M" required> Mujer
        <input type="radio" name="sexo" value="H" required> Hombre
		<label for="nombre">*Obligatorio</label>
        <br><br>

        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>

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
        echo "<h2>Datos Ingresados:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Sexo</th></tr>";
        echo "<tr><td>$nombre</td><td>$apellido1 $apellido2</td><td>$email</td><td>$sexo</td></tr>";
        echo "</table>";

        // Almacenamos los datos en el archivo datos.txt
        $datos = "Nombre: $nombre\nApellidos: $apellido1 $apellido2\nEmail: $email\nSexo: $sexo\n\n";
        file_put_contents("fdatos.txt", $datos, FILE_APPEND);

    } else {
        echo "Los campos obligatorios (*) deben completarse.";
    }
}
?>
</body>
</html>
