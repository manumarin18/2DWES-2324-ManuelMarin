<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>IPs</title>
</head>
<body>
    <h1>IPs</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        IP notación decimal: <input type="text" name="ip" required><br><br>
        <input type="submit" value="Notación Binaria">
		<input type="reset" value="borrar"><br><br>
    </form>

    <?php
    //Función para validar una dirección IP
    function validarIP($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    //Función para convertir una IP de decimal a binario
    function convertirIP($ip) {
        $binario = '';
        $octetos = explode('.', $ip);
        
        for ($i = 0; $i < count($octetos); $i++) {
            $octeto = $octetos[$i];
            $binario .= str_pad(decbin($octeto), 8, '0', STR_PAD_LEFT);
            if ($i < count($octetos) - 1) {
                $binario .= '.';
            }
        }
        
        return $binario;
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
        //Obtenemos la IP ingresada y la limpiamos
        $ip = test_input($_POST['ip']);

        //Validamos la IP
        if (validarIP($ip)) {
            //Realizamos la conversión
            $binario = convertirIP($ip);
            echo "IP en notación decimal: $ip<br>";
            echo "IP en binario: $binario";
        } else {
            echo "La dirección IP ingresada no es válida.";
        }
    }
    ?>
</body>
</html>
