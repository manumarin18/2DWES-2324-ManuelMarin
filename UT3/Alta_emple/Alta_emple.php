<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>

<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/*Inserción en tabla Prepared Statement- mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO empleado (dni,nombre_emple,salario,cod_dpto)
							VALUES (:dni,:nombre_emple,:salario,:cod_dpto)");
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':nombre_emple', $nombre_emple);
    $stmt->bindParam(':salario', $salario);
	$stmt->bindParam(':cod_dpto', $cod_dpto);
  
    // insert a row
    $dni = test_input($_POST['dni']);
	$nombre_emple = test_input($_POST['nombre_emple']);
	$salario = test_input($_POST['salario']);
	$cod_dpto = test_input($_POST['cod_dpto']);
    $stmt->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;


?>

</body>
</html>