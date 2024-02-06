<?php
include "funciones/funciones.php";

session_start();
if (comprobarSession()) {
    header("Location:pe_inicio.php");
} else {
    cerrarSesion();
}
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
    <h1>Login cliente:</h1>

    <form method="POST" name="login_cliente" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="usu" value="" placeholder="introduce UN NUMERO DE USUSARIO" />
        </br></br>
        <input type="text" name="pass" value="" placeholder="introduce CONTRASEÑA" />
        </br></br>
        <input type="submit" name="login" value="Entrar">
    </form>

<?php

$conn = create_conn();
if (isset($_POST['login'])) {
    logearse($conn);
   // $_SESSION["carrito".$_SESSION['customerNumber']];
   // $carrito = $_SESSION["carrito" . $_SESSION['customerNumber']];
   
}
close_conn($conn);

?>

</body>
</html>