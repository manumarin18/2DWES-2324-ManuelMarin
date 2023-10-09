<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<H1> CALCULADORA </h1>
<form name='mi_formulario' action='<?php echo $_SERVER["PHP_SELF"]; ?>' method='POST'>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $operando1 = $_POST['operando1'];
    $operando2 = $_POST['operando2'];
    if (isset($_POST['operacion'])) {
        $operacion = $_POST['operacion'];
        if (!empty($operando1) && !empty($operando2) && !empty($operacion)) {
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
                if ($operando2 != 0) {
                    $resultado = $operando1 / $operando2;
                    $operacionTexto = "División";
                } else {
                    $resultado = "Error: División entre cero.";
                    $operacionTexto = "División";
                }
            }
            echo "Resultado: " . $operando1 . " " . getOperacionSimbolo($operacion) . " " . $operando2 . " = " . $resultado;
        } else {
            echo "Por favor, completa todos los campos.";
        }
    } else {
        echo "Por favor, selecciona una operación.";
    }
}

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
