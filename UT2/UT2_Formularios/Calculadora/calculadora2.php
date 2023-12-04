<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php
//Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Obtenemos los valores de los operandos y la operación seleccionada
    $operando1 = $_POST['operando1'];
    $operando2 = $_POST['operando2'];
	
	//Comprobamos que la variable no es NULL con isset()
    if (isset($_POST['operacion'])) {
        $operacion = $_POST['operacion'];

        //Verificamos que los campos no estén vacíos  con empty()
        if (!empty($operando1) && !empty($operando2) && !empty($operacion)) {
            //Realizamos la operación correspondiente
            if ($operacion == 'suma') {
                $resultado = $operando1 + $operando2;
            } elseif ($operacion == 'resta') {
                $resultado = $operando1 - $operando2;
            } elseif ($operacion == 'multi') {
                $resultado = $operando1 * $operando2;
            } elseif ($operacion == 'divi') {
                //Verificamos que no se esté dividiendo entre cero
                if ($operando2 != 0) {
                    $resultado = $operando1 / $operando2;
                } else {
                    $resultado = "Error: División entre cero.";
                }
            }
            //Mostramos el resultado detallado
            echo "Resultado: " . $operando1 . " " . getOperacionSimbolo($operacion) . " " . $operando2 . " = " . $resultado;
        } else {
            //Mostramos mensaje de error si algún campo está vacío
            echo "Por favor, completa todos los campos.";
        }
    } else {
        //Mostramos mensaje de error si no se selecciona ninguna operación
        echo "Por favor, selecciona una operación.";
    }
}
	
	//Función para obtener el símbolo de la operación seleccionada
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