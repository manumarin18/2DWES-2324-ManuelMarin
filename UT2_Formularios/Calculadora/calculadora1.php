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
    if (isset($_POST['operacion'])) {
        $operacion = $_POST['operacion'];

        //Verificamos que los campos no estén vacíos
        if (!empty($operando1) && !empty($operando2) && !empty($operacion)) {
            //Realizamos la operación correspondiente según la opción seleccionada
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
            //Mostramos el resultado
            echo "Resultado operación: " . $resultado;
        } else {
            //Mostramos mensaje de error si algún campo está vacío
            echo "Por favor, completa todos los campos.";
        }
    } else {
        //Mostramos mensaje de error si no se selecciona ninguna operación
        echo "Por favor, selecciona una operación.";
    }
}
?>
</body>
</html>
