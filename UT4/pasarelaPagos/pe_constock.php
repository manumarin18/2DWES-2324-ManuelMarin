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
    <h1>Consulta stock por familia:</h1>

    <form method="POST" name="stockProductosFamilia" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       Familia
        <?php
		$conn = create_conn();
        $productsLine = crearSelect($conn, "SELECT  productLine FROM productlines");    
        crearSelectProductLine($productsLine);
        
        ?>      
        </br></br>
        <input type="submit" name="mostrar" value="Mostrar stock"><br><br>
        <input type="submit" name="salir" value="Cerrar sesión">
        </br></br>
        
    </form>

<?php
      

if(isset($_POST['mostrar'])){
   
    
     mostrarStockFamilia($conn);

}else if (isset($_POST['salir'])){
    cerrarSesion();
    header("Location:pe_login.php");
}
close_conn($conn);

?>

</body>
</html>