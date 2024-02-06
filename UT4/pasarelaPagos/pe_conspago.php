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
    <h1>Consulta de pagos:</h1>

    <form method="POST" name="consulta_productos" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      
        <label for="">Elige el cliente</label>

        <?php

        $conn = create_conn();
        $customerNumber= crearSelect($conn, "SELECT DISTINCT customerNumber  FROM payments");    
        crearSelectCustomerNumber($customerNumber);          


?>      
        </br></br>
        <input type="date" name="fecha_inicio" value="">
        </br></br>
        <input type="date" name="fecha_fin" value="">
        </br></br>
        <input type="submit" name="mostrar" value="Mostrar pagos"><br><br>
        <input type="submit" name="salir" value="Cerrar sesión"><br><br>
        
    </form>
<?php

    if(isset($_POST['mostrar'])){
         $numeroCliente= $_POST['customerNumbers'];
        $fecha_inicio=$_POST['fecha_inicio'];
        $fecha_fin=$_POST['fecha_fin'];
       
        mostrarPagosProducto($conn,$fecha_inicio,$fecha_fin, $numeroCliente);
    }else if (isset($_POST['salir'])){
        cerrarSesion();
        header("Location:pe_login.php");
    }
    close_conn($conn);
?>
</body>
</html>
