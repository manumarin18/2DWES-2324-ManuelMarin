<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Calculadora</title>
</head>
<body>
    <h1>CALCULADORA</h1>
    <form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='POST'>
        Operando1:
        <input type='text' name='operando1' value='' size=15><br><br>
        Operando2:
        <input type='text' name='operando2' value='' size=15><br><br>
        Selecciona operación:<br>
        <input type='radio' name='operacion' value='suma'>Sumar<br>
        <input type='radio' name='operacion' value='resta'>Restar<br>
        <input type='radio' name='operacion' value='multi'>Multiplicar<br>
        <input type='radio' name='operacion' value='divi'>Dividir<br><br>
        <input type="submit" value="calcular">
        <input type="reset" value="borrar"><br><br>
    </form>

    <?php
    //Verificamos si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Obtenemos, validamos y limpiamos los datos de entrada
        $operando1 = test_input($_POST['operando1']);
        $operando2 = test_input($_POST['operando2']);
		//Comprobamos que la variable no es NULL con isset()
        if (isset($_POST['operacion'])) {
            $operacion = $_POST['operacion'];
			//Verificamos que los campos no estén vacíos  con empty()
            if (!empty($operando1) && !empty($operando2) && !empty($operacion)) {
                //Realizamos la operación seleccionada y mostramos el resultado
                if ($operacion == 'suma') {
                    $resultado = $operando1 + $operando2;
                    $operacionTexto = "Suma";
                } elseif ($operacion == 'resta') {
                    $resultado = $operando1 - $operando2;
                    $operacionTexto = "Resta";
                } elseif ($operacion == 'multi') {
                    $resultado = $operando1 * $operando2;
                    $operacionTexto = "Multiplicación";
                } elseif ($operacion == 'divi') {
					//Verificamos que no se esté dividiendo entre cero
                    if ($operando2 != 0) {
                        $resultado = $operando1 / $operando2;
                        $operacionTexto = "División";
                    } else {
                        $resultado = "Error: División entre cero.";
                        $operacionTexto = "División";
                    }
                }
				//Mostramos el resultado detallado
                echo "Resultado: " . $operando1 . " " . getOperacionSimbolo($operacion) . " " . $operando2 . " = " . $resultado;
            } else {
                //Mostramos mensaje de error si algún campo está vacío
                echo "Error: inserte los datos.";
            }
        } else {
            //Mostramos mensaje de error si no se selecciona ninguna operación
            echo "Error: seleccione operación.";
        }
    }

    //Función para validar y limpiar datos de entrada
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Función para obtener el símbolo de la operación
    function getOperacionSimbolo($operacion) {
        switch ($operacion) {
            case 'suma':
                return "+";
            case 'resta':
                return "-";
            case 'multi':
                return "x";
            case 'divi':
                return "/";
            default:
                return "";
        }
    }
    ?>
</body>
</html>

