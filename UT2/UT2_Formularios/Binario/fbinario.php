<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Decimal a Binario</title>
</head>
<body>
   <h1>Conversor Decimal a Binario</h1>
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='POST'>
        Número decimal: <input type="text" name="decimal"><br><br>
        <input type="submit" value="enviar">
        <input type="reset" value="borrar"><br><br>
    </form>

    <?php
     //Función para convertir decimal a binario
    function convertir($decimal) {
        if ($decimal == 0) {
            return "0"; //Si el número es 0, su representación binaria es 0.
        }
        $binario = "";
        while ($decimal > 0) {
            $resto = $decimal % 2; //Calculamos el resto de la división por 2.
            $binario = $resto . $binario; //Agregamos el resto al principio del resultado.
            $decimal = (int)($decimal / 2); //Dividimos el número decimal por 2 y tomamos la parte entera.
        }
        //Añadimos ceros a la izquierda para que se muestre completo (8 bits)
        $binario = str_pad($binario, 8, "0", STR_PAD_LEFT);
        return $binario;
    }
	
	//Función para validar y limpiar datos de entrada
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	//Verificamos el formulario se envíe
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	//Obtenemos, validamos y limpiamos los datos de entrada
        $decimal = test_input($_POST['decimal']);
        //Comprobamos que la variable no es NULL con isset()
        if (isset($_POST['decimal'])) {
            $decimal = $_POST['decimal'];
        //Comprobamos si se ingresó un número decimal válido con is_numeric()
        if (is_numeric($decimal)) {
            $decimal = (int)$decimal; //Convertimos a entero si es necesario
            $binario = convertir($decimal); //Llamamos a la función para la conversión
            echo "Decimal: " . $decimal . "<br>";
            echo "Binario: " . $binario;
        } else {
            echo "Error: número decimal inválido.";
        }
    }
}
	
	
    ?>
</body>
</html>
