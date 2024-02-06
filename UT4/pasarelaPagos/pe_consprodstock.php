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
    <h1>Consulta de stock:</h1>

    <form method="POST" name="stockProductos" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nombre del producto: 
        <?php
		$conn = create_conn();
        $productsName = crearSelect($conn, "SELECT productName,productCode FROM products ");    
        crearSelectProductName($productsName);
        
        ?>      
        </br></br>
        <input type="submit" name="mostrar" value="Mostrar stock"><br><br>
        <input type="submit" name="salir" value="Cerrar sesión">
        </br></br>
        
    </form>
<?php

if(isset($_POST['mostrar'])){

    mostrarStock($conn);

}else if (isset($_POST['salir'])){
    cerrarSesion();
    header("Location:pe_login.php");
}
close_conn($conn);

?>
</body>
