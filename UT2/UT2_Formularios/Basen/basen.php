<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resultado de Conversión</title>
</head>
<body>
    
    <?php
    //Función para convertir un número de una base a otra
    function convertirBase($numero, $base_actual, $nueva_base) {
        return base_convert($numero, $base_actual, $nueva_base);
    }
	
	//Función para validar y limpiar datos de entrada
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Verificamos si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Obtenemos y limpiamos los datos de entrada
        $numero = test_input($_POST['numero']);
        $base_actual = test_input($_POST['base_actual']);
        $nueva_base = test_input($_POST['nueva_base']);

        //Comprobamos si los datos son numéricos
        if (is_numeric($numero) && is_numeric($base_actual) && is_numeric($nueva_base)) {
            //Realizamos la conversión
            $resultado = convertirBase($numero, $base_actual, $nueva_base);
            echo "Número $numero en base $base_actual = $resultado en base $nueva_base";
        } else {
            echo "Por favor, ingresa valores numéricos válidos.";
        }
    }
    ?>
</body>
</html>
