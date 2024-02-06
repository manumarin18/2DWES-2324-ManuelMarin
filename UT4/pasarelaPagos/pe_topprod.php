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
    <h1>Consulta de compras.</h1>
   
    <form method="POST" name="consulta_productos" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      
        <label for="">Elige las fechas:</label>
        </br></br>
        <input type="date" name="fecha_inicio" value="">
        </br></br>
        <input type="date" name="fecha_fin" value="">
        </br></br>
        <input type="submit" name="mostrar" value="Mostrar compras"><br><br>
        <input type="submit" name="salir" value="Cerrar sesión"><br><br>
        
    </form>
<?php
    $conn = create_conn();
    if(isset($_POST['mostrar'])){
    
        $fecha_inicio=$_POST['fecha_inicio'];
        $fecha_fin=$_POST['fecha_fin'];
       
        mostrarComprasProducto($conn,$fecha_inicio,$fecha_fin);
    }else if (isset($_POST['salir'])){
        cerrarSesion();
        header("Location:pe_login.php");
    }
    close_conn($conn);
?>
</body>
</html>