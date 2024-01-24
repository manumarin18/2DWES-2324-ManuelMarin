<HTML>
<HEAD><TITLE>INICIO</TITLE>
</HEAD>
<BODY>
<?php
    require("funciones.php");
    $conn = conexion();
?>
<h3>Pagos</h3>
<a href="pe_inicio.php">INICIO</a>
<br><br>
<?php
    //Obtenemos el número de pedido restando 1 al resultado de la función detallesCompra.
    $num = detallesCompra($conn) - 1;
    //Mostramos un mensaje indicando que el pedido con el número correspondiente se realizó correctamente.
    echo "Pedido <b>".$num."</b> realizado correctamente";
?>

</BODY>
</HTML>