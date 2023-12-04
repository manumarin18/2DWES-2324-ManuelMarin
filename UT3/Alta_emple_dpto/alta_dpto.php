<HTML>
<HEAD><TITLE>ALTA DPTO</TITLE></HEAD>
<style>
h3{
	text-align:center;
}
</style>
<BODY>
<?php
    require("funciones.php");
?>
<a href="empleadosnm.php">HOME</a>
<br>
<h3>ALTA DPTO </h3>
<form name="formu" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label type="text" name="nbDpto">NB Dpto <input name="nbDpto"></label>
    <br><br>
    <input type="submit" value="Añadir" name="enviar" />
</form>
<?php
if(empty($_POST)){}
else if($_POST["nbDpto"]!=""){
    $conn=conexion();
    $tot_dpto=contar_dpto($conn);
    $val=calcular_dpto($tot_dpto);

    if ($_SERVER["REQUEST_METHOD"]== "POST"){
        $nombr = $_POST["nbDpto"];
    }

    añadir_dpto($conn,$val,$nombr);
    $conn = null;
}
?>
</BODY>
</HTML>