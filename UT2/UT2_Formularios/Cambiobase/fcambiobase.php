<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cambio de Base</title>
</head>
<body>
    <h1>Conversor numérico</h1>
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='POST'>
        Número decimal: <input type="text" name="decimal"><br><br>
		Convertir a: <type="text" name=""><br>
        <input type="radio" name="base" value="binario">Binario<br>
        <input type="radio" name="base" value="octal">Octal<br>
        <input type="radio" name="base" value="hexadecimal">Hexadecimal<br>
        <input type="radio" name="base" value="todos">Todos<br><br>
        <input type="submit" value="Calcular">
        <input type="reset" value="Borrar"><br><br>
    </form>

    <?php
    //Función para convertir decimal a binario
    function convertirBase($decimal, $base) {
        switch ($base) {
            case "binario":
                return decbin($decimal);
            case "octal":
                return decoct($decimal);
            case "hexadecimal":
                return dechex($decimal);
            default:
                $binario = decbin($decimal);
                $octal = decoct($decimal);
                $hexadecimal = dechex($decimal);
                return ["Binario" => $binario, "Octal" => $octal, "Hexadecimal" => $hexadecimal];
        }
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
        $decimal = test_input($_POST['decimal']);
        $base = $_POST['base'];

        if (is_numeric($decimal)) {
            $decimal = (int)$decimal;
            $resultado = convertirBase($decimal, $base);

            //Mostramos los resultados en una tabla
            echo "<table border='1'>";

            if (is_array($resultado)) {
            $bases = array_keys($resultado);
            for ($i = 0; $i < count($bases); $i++) {
                $base = $bases[$i];
                $valor = $resultado[$base];
                echo "<tr>
                        <td>$base</td>
                        <td>$valor</td>
                      </tr>";
            }
        } else {
            echo "<tr>
                    <td>$base</td>
                    <td>$resultado</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Error: número decimal inválido.";
    }
}
    ?>
</body>
</html>
