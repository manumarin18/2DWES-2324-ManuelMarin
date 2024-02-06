<?php
include "funciones/funciones.php";

session_start();
if (!comprobarSession()) {
    header("Location:pe_login.php");
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="author" content="width=device-width" />
    <link rel="stylesheet" href="">
    <script type="text/javascript" src=""></script>
</head>

<body>
	<a href="pe_inicio.php">volver al menú</a>
    <h1>Consulta de pedidos:</h1>

    <form method="POST" name="infoPedidos" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Número Cliente
        <?php
		$conn = create_conn();
        $customerNumber = crearSelect($conn, "SELECT DISTINCT customers.customerNumber FROM customers INNER JOIN orders ON customers.customerNumber = orders.customerNumber GROUP BY customers.customerNumber ORDER BY customerNumber");
        crearSelectCustomerNumber($customerNumber);
        ?>
        </br></br>
        <input type="submit" name="mostrar" value="Mostrar pedidos"><br><br>
        <input type="submit" name="salir" value="Cerrar sesión">
        </br></br>
        
    </form>
<?php

if (isset($_POST['mostrar'])) {
    mostrar_informacion($conn);
} else if (isset($_POST['salir'])) {
    cerrarSesion();
    header("Location:pe_login.php");
}

close_conn($conn);
?>
</body>
</html>