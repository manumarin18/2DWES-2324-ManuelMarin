<HTML>
<HEAD><TITLE>LOGIN</TITLE>
</HEAD>
<BODY>
<?php
    require("funciones.php");
    $conn = conexion();
    session_start();
?>
<h3>Login</h3>
<form name="formu" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label type="text" name="nombre">Nombre <input type="text" name="nombre"></label>
    <br><br>
    <label type="text" name="contra">Contraseña <input type="password" name="contra"></label>
    <br><br>
    <input type="submit" value="Entrar" name="enviar" />
</form>

<?php
//Verificamos si se han enviado datos mediante el formulario (método POST).
if(!empty($_POST)){
    //Variable que indica si se debe realizar la autenticación.
    $realizar=true;

    //Si no se ha introducido el nombre de usuario, muestra un mensaje de error.
    if($_POST["nombre"]==""){
        echo "<p id='err'>ERROR: No has introducido el nombre de usuario</p>";
        $realizar=false;
    }

    //Si no se ha introducido la contraseña, muestra un mensaje de error.
    if($_POST["contra"]==""){
        echo "<p id='err'>ERROR: No has introducido la contraseña</p>";
        $realizar=false;
    }

    //Si se deben realizar las validaciones.
    if($realizar){
        //Obtenemos el nombre de usuario introducido en el formulario.
        $nb=$_POST["nombre"];

        //Verificamos la autenticación llamando a la función "login".
        //Si las credenciales son correctas, creamos una sesión y redirigimos a la página de inicio.
        //Si las credenciales son incorrectas, mostramos un mensaje de error.
        if(login($conn,$nb)==$_POST["contra"]){
            crearSession($nb);
            header("Location: pe_inicio.php");
        }else{
            echo "<p id='err'>ERROR: Usuario Incorrecto</p>";
        }
    }
}
?>

</BODY>
</HTML>