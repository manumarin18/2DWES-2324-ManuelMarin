<HTML>
<HEAD><TITLE>INICIO</TITLE>
</HEAD>
<BODY>
<?php
    require("funciones.php");
    $conn = conexion();
?>
<h3>Inicio</h3>
<form name="formu" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input id="salir" type="submit" value="Cerra Sesion" name="enviar" />
</form>
<a href="pe_altaped.php">Realizar pedido</a><br><br>


<?php
    if($_POST){
        session_unset();
        header("Location: pe_login.php");
    }
?>

</BODY>
</HTML>