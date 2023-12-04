<HTML>
<HEAD><TITLE>ALTA EMPLEADO</TITLE></HEAD>
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
<h3>ALTA EMPLEADO</h3>
<form name="formu" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label type="text" name="dni">DNI <input name="dni"></label>
    <br>
    <br>
    <label type="text" name="nb">Nombre <input name="nb"></label>
    <br>
    <br>
    <label type="text" name="sal">Salario <input name="sal"></label>
    <br>
    <br>
    <label type="date" name="fecha">Fecha Nacimiento <input name="fecha"></label>
    <br>
    <br>
    <label type="date" name="fecha_alt">Fecha Alta <input name="fecha_alt"></label>
    <br>
    <br>
    DPTO <select name="dep">
        <?php
        $conn=conexion();
        $departamentos=visualizar_dpto($conn);
        foreach($departamentos as $row) {
            echo "<option value=".$row["cod_dpto"].">". $row["nombre"]. "</option>";
        }
        $conn = null;
        ?>
    </select>
    <br>
    <br>
    <input type="submit" value="Añadir" name="enviar" />
    <input type="reset" value="Limpiar" name="enviar" />
</form>


<?php
if(empty($_POST)){}
else{
    $dni=$_POST["dni"];
    $nombre=$_POST["nb"];
    $salario=$_POST["sal"];
    $fecha=$_POST["fecha"];
    $fecha_alt=$_POST["fecha_alt"];
    $cod_dpto=$_POST["dep"];
    if($dni=="" || $nombre=="" || $salario=="" || $fecha=="" || $fecha_alt==""){
        echo "ERROR: Uno de los campos no ha sido rellenados";
    }else{
        $conn=conexion();
        alta_empleado($conn,$dni,$nombre,$salario,$fecha);
        alta_emple_fecha($conn,$dni,$cod_dpto,$fecha_alt);

    $conn=null;
    }
}
?>

</BODY>
</HTML>