<?php
    session_start();
    include "funciones/funciones.php";
    redirigirSesionFalse();
     if (isset($_POST['salir'])){
        cerrarSesion();
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
    <h1>Menú de inicio.</h1>

    <form method="POST" name="indice" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

       
        <h3>Gestion general:</h3>
        <ul>
            <li><a href="pe_altaped.php"> Generar pedido </a></li>
            <li><a href="pe_consped.php">Consulta detalles pedido por número de cliente </a></li>
            <li><a href="pe_consprodstock.php">Consultar disponibilidad de stock </a></li>
            <li><a href="pe_constock.php">Consultar disponibilidad de stock familia </a></li>
            <li><a href="pe_topprod.php">Productos vendidos entre dos fechas</a></li>
            <li><a href="pe_conspago.php">Relación de pagos realizados entre dos fechas</a></li>
        </ul>
        <input type="submit" name="salir" value="Cerrar sesión">
    </form>

</body>
</html>

