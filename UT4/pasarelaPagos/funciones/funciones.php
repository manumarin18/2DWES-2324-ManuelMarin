<?php
//---------------------Conexión con la base de datos----------------------//
function create_conn()
{
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "pedidos";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error: no se ha podido establecer la conexión " . $e->getMessage();
    }

    return $conn;
}

function close_conn($conn){
    $conn = null;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//--------------------Funciones---------------------------------//

function comprobarSession()
{           //----------comporbamos que existe la sesion en curso------//
    if (isset($_SESSION['customerNumber'])) {
        return true;
    }

    return false;
}

function redirigirSesionFalse()
{ //si no hay una sesión iniciada y queremos entrar en la página de comprar o de elegir que hacer nos redirige a la pagina de login----//

    if (comprobarSession() == false) {

        header("Location:pe_login.php");
    }
}

function logearse($conn)
{
    try {
        //-----nos logamos con el usuario y la contraseña introducidos por caja de texto-----//
        $usu = test_input($_POST['usu']);
        $pass = test_input($_POST['pass']);
        $stmt = $conn->prepare("SELECT * FROM customers WHERE customerNumber = '$usu' AND contactLastName = '$pass'");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        // var_dump($result);
    } catch (PDOException $e) {
        $e->getMessage();
    }
    if (count($result) > 0) {
        session_start();

        foreach ($result as $key => $valor) {
            $identificador =  $valor['customerNumber'];
        }
        echo $identificador;
        $_SESSION['customerNumber'] = $identificador;
        $_SESSION["carrito" . $identificador] = array();
        //-----si el login tiene exito, nos dirigimos a la pagina de inicio/menu de acciones-----//
        header("Location:pe_inicio.php");
    } else {
        echo "no existe el usuario";
        //cerrarSesion();
    }
}

function cerrarSesion()
{
    //--------matamos la sesion------//
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
}

function crearSelect($conn, $selecQuery)
{
    try {
        $stmt = $conn->prepare($selecQuery);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $stmt->fetchAll();
    } catch (PDOException $e) {
        $e->getMessage();
    }
    return $resultado;
}
function crearSelectProdu($nombre_productos)
{
    //  var_dump($nombre_productos);

    echo "<select name='productos'>";
    foreach ($nombre_productos as $asociativo => $nombre) {

        echo "<option value=" . $nombre['productCode'] . ">" . $nombre['productName'] . "</option>";
    }
    echo "</select>";
}

function crearSelectCustomerNumber($customerNumber)
{

    echo "<select name='customerNumbers'>";
    foreach ($customerNumber as $number) {

        echo "<option value=" . $number['customerNumber'] . ">" . $number['customerNumber'] . "</option>";
    }
    echo "</select>";
}
function crearSelectProductName($productsName)
{

    echo "<select name='productsName'>";
    foreach ($productsName as $name) {

        echo "<option value='" . $name['productCode'] . "'>" . $name['productName'] . "</option>";
    }
    echo "</select>";
}
function crearSelectProductLine($productsLine)
{
    // var_dump($productsLine);
    echo "<select name='productLines'>";
    foreach ($productsLine as $line) {

        echo "<option value='" . $line["productLine"] . "'>" . $line["productLine"] . "</option>";
    }
    echo "</select>";
}

function comprobarDisponibilidad($conn, $id, $cantidad)
{
    //----------comprobamos la disponibilidad de producto con respecto a la cantidad pedida------//
    // echo $cantidad;
    try {
        $stmt = $conn->prepare("SELECT quantityInStock from products where productCode = :idProducto");
        $stmt->bindParam(':idProducto', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $array = $stmt->fetchAll();
        //var_dump($array);
    } catch (PDOException $e) {
        $e->getMessage();
    }
    if ($array[0]["quantityInStock"] < $cantidad) {
        return false;
    } else {
        return true;
    }
}
//------------pe_altaped---------------//
function crearOrdenPedidoYdetalles($conn, $eleccionPago)
{
    try {
        //------- NUMERO MAXIMO de orderNumber para poder incrementarlo cada vez que se crea un pedido----------//
        $stmt1 = $conn->prepare("SELECT max(orderNumber) FROM orders");
        $stmt1->execute();
        $orderNumber = intval($stmt1->fetchColumn()) + 1;
    } catch (PDOException $e) {
        $e->getMessage();
    }
    //-------------- INSERTAR EN EN LA TABLA ORDERS------------//
    $customerNumber = $_SESSION['customerNumber']; //rescatamos el valor de la sesion 
    $carrito = $_SESSION["carrito" . $_SESSION['customerNumber']];
    $carrito = $carrito;
    $fecha = date("y-m-d");

    try {
        $stmt = $conn->prepare("INSERT INTO orders (orderNumber,orderDate,requiredDate,status,customerNumber) 
           VALUES (:orderNumber,:orderDate,:requiredDate,'In Process',:customerNumber)");

        $stmt->bindParam(':orderNumber', $orderNumber);
        $stmt->bindParam(':orderDate', $fecha);
        $stmt->bindParam(':requiredDate', $fecha);
        $stmt->bindParam(':customerNumber', $customerNumber);
        $stmt->execute();
    } catch (PDOException $e) {
        if ($e->getCode() == 1062) {
            // error de clave primaria duplicada 
            echo "esta clave ya existe por favor vuelva a intentarlo, se generará otra clave automaticamente";
        } else {
            $e->getMessage();
        }
    }

    //-------------- INSERTAR EN LA TABLA ORDERSDETAILS------------//
    $orderLineNumber = 0;
    $precioTotalProducto = 0;
    $precioTotalPedido = 0;
    foreach ($carrito as $key => $valor) {
        $orderLineNumber++;
        $unidades = $valor;
        $productCode = $key;
        $precio = consultaPrecio($conn, $productCode);
        try {
            $stmt2 = $conn->prepare("INSERT INTO orderdetails (orderNumber,productCode,quantityOrdered,priceEach,orderLineNumber) 
            VALUES (:orderNumber,:productCode,:quantityOrdered,:priceEach,:orderLineNumber)");
            $stmt2->bindParam(':orderNumber', $orderNumber);
            $stmt2->bindParam(':productCode', $productCode);
            $stmt2->bindParam(':quantityOrdered', $unidades);
            $stmt2->bindParam(':priceEach', $precio);
            $stmt2->bindParam(':orderLineNumber', $orderLineNumber);
            $stmt2->execute();
        } catch (PDOException $e) {
            $e->getMessage();
        }
        //------calculo de el pago total--------//
        $precioTotalProducto = $precio * $unidades;
        // echo " " . $precioTotalProducto . "<br>";
        $precioTotalPedido += $precioTotalProducto;
        restarCantidadAlmacen($conn, $productCode, $unidades);
    }
	echo "<br>";
    echo "El número de pedido: " . $orderNumber;


    //-------------- INSERTAR EN EN LA TABLA PAYMENTS------------//
    //----generar fecha aleatoria minimo mañana maximo un año----//
    $min = strtotime("tomorrow");
    $max = strtotime("+1 year");
    $espacioDeTiempo = mt_rand($min, $max);
    $FechaAleatoria = date("Y-m-d", $espacioDeTiempo);
    //------generar checkNumber y comprobar que no existe------------//
    //  $checkNumber= generaCheckNumber();
    $letras = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $checkNumber = substr(str_shuffle($letras), 0, 2) . str_pad(rand(0, 99999), 5, "0", STR_PAD_LEFT);
    // while(!checkNumbernoRepetido($conn, $checkNumber,$customerNumber)){
    //     $checkNumber= generaCheckNumber();
    // }    
    try {
        $stmt3 = $conn->prepare("INSERT INTO payments (customerNumber,checkNumber,paymentDate,amount) 
        VALUES (:customerNumber,:checkNumber,:paymentDate,:amount)");
        $stmt3->bindParam(':customerNumber', $customerNumber);
        $stmt3->bindParam(':checkNumber', $checkNumber);
        $stmt3->bindParam(':paymentDate', $FechaAleatoria);
        $stmt3->bindParam(':amount', $precioTotalPedido);
        $stmt3->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    pasarelaDePago($orderNumber, $precioTotalPedido, $eleccionPago);

    if (isset($_SESSION["carrito" . $_SESSION['customerNumber']])) {
        unset($_SESSION["carrito" . $_SESSION['customerNumber']]);
        $_SESSION["carrito" . $_SESSION['customerNumber']] = array();
    }

    close_conn($conn);
}
function consultaPrecio($conn, $id)
{
    try {
        $stmt1 = $conn->prepare("SELECT buyPrice FROM products where productCode = :idproducto");
        $stmt1->bindParam(':idproducto', $id);
        $stmt1->execute();
        $precio = doubleval($stmt1->fetchColumn());
    } catch (PDOException $e) {
        $e->getMessage();
    }
    return $precio;
}

function restarCantidadAlmacen($conn, $productCode, $unidades)
{
    try {
        $sql = "UPDATE products SET quantityInStock = quantityInStock - $unidades WHERE productCode = :productCode";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':productCode', $productCode);
        $stmt->execute();
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

function verCarrito($conn,$arr){
    $precioFinal=0;
    $stmt = $conn->prepare("SELECT productName, productCode,buyPrice FROM products;");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    
    foreach($arr as $nombre => $total){
        foreach($result as $dat){
            if($dat["productCode"]==$nombre){
                $precioFinal=$dat['buyPrice']*$total+$precioFinal;
				echo "<br>";
                echo "<b>".$dat['productName']."</b> Unidades <b>$total</b> TOTAL: <b>".$dat['buyPrice']*$total."€ </b><br>";
            }
        }
    }
    if($precioFinal==0){
		echo "<br>";
        echo "Tu carrito está vacio.";
    }else{
        echo "<br>Total compra: <b>$precioFinal €</b>";
    }
}

//------------ MOSTRAR INFORMACION POR NUMERO PEDIDO pe_consped.php -----------//

function mostrar_informacion($conn)
{

    try {
        $orderNumber = "";
        $id = $_POST['customerNumbers'];
        $stmt = $conn->prepare("SELECT orders.orderNumber,orders.orderDate,orders.status from orders where customerNumber = :idProducto");
        $stmt->bindParam(':idProducto', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $array = $stmt->fetchAll();
        //var_dump($array);
    } catch (PDOException $e) {
        $e->getMessage();
    }
    foreach ($array as $key => $valor) {
        echo "<h3>PEDIDO</h3>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Order Number </th><th>Order Date</th><th>Status</th>";
        echo "</tr>";
        $orderNumber = $array[$key]['orderNumber'];
        echo "<tr>";
        echo "<td>" . $array[$key]['orderNumber'] . "</td>";
        echo "<td>" . $array[$key]['orderDate'] . "</td>";
        echo "<td>" . $array[$key]['status'] . "</td>";
        echo "</tr>";

        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>orderLineNumber </th><th>productName</th><th>quantityOrdered</th><th>priceEach</th>";
        echo "</tr>";
        try {
            $stmt1 = $conn->prepare("SELECT orderLineNumber,products.productName,quantityOrdered,priceEach from orderdetails,products,orders
        where orderdetails.orderNumber =  '$orderNumber' and orders.orderNumber = orderdetails.orderNumber and orderdetails.productCode = products.productCode  order by orderLineNumber");
            $stmt1->execute();
            $stmt1->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt1->fetchAll();
        } catch (PDOException $e) {
            $e->getMessage();
        }
        echo "<h3>DETALLES PEDIDO</h3>";
        foreach ($resultado as $key1 => $valor1) {
            echo "<tr>";
            echo "<td>" . $resultado[$key1]['orderLineNumber'] . "</td>";
            echo "<td>" . $resultado[$key1]['productName'] . "</td>";
            echo "<td>" . $resultado[$key1]['quantityOrdered'] . "</td>";
            echo "<td>" . $resultado[$key1]['priceEach'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</table>";
    }
}
//-------------MOSTRAR STOCK DE UN PRODUCTO POR SU CODE pe_consprodstock--------//

function mostrarStock($conn)
{
    try {
        $code = $_POST['productsName'];
        $stmt = $conn->prepare("SELECT  productCode, productName, quantityInStock from products where productCode = :code");
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $array = $stmt->fetchAll();
    } catch (PDOException $e) {
        $e->getMessage();
    }
    //var_dump($array);
	echo "<br>";
    echo $array[0]['productName'], ": ", "<b>". $array[0]['quantityInStock'], " en stock.";
}

//-------------MOSTRAR STOCK DE PRODUCTOS POR SU FAMILIA pe_consprodstock--------//


function mostrarStockFamilia($conn)
{

    $line = $_POST['productLines'];
    try {
        $stmt = $conn->prepare("SELECT productName,quantityInStock from products where productLine = :productLine ORDER BY quantityInStock desc");
        $stmt->bindParam(':productLine', $line);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $array = $stmt->fetchAll();
    } catch (PDOException $e) {
        $e->getMessage();
    }
    // var_dump($array);
    echo "<h3>" . $line . "</h3>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>PRODUCT NAME</th><th>QUANTITY IN STOCK</th>";
    echo "</tr>";
    foreach ($array as $key => $valor) {
        echo "<tr>";
        echo "<td>" . $array[$key]['productName'] . "</td>";
        echo "<td>" . $array[$key]['quantityInStock'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}


//--------------UNIDADES TOTALES DE PRODUCTOS VENDIDOS ENTRE DOS FECHAS pe_topprod.php-----//

function mostrarComprasProducto($conn, $fecha_inicio, $fecha_fin)
{
    try {
        $stmt = $conn->prepare("SELECT products.productName, SUM(orderdetails.quantityOrdered) as TotalQuantity 
    FROM orderdetails,products,orders 
        WHERE orders.orderNumber = orderdetails.orderNumber AND orderdetails.productCode = products.productCode AND orders.orderDate 
        BETWEEN :fecha_inicio and :fecha_fin GROUP BY products.productName;");
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam('fecha_fin', $fecha_fin);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
    } catch (PDOException $e) {
        $e->getMessage();
    }
    // var_dump($result);
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>PRODUCT NAME</th><th>QUANTITY IN STOCK</th>";
    echo "</tr>";
    foreach ($result as $key => $valor) {
        echo "<tr>";
        echo "<td>" . $result[$key]['productName'] . "</td>";
        echo "<td>" . $result[$key]['TotalQuantity'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
// Realizar un programa php pe_conspago.php que muestre para un determinado cliente la
// relación de pagos realizados entre dos fechas, así como el importe total de los mismos. Si no
// se indicaran las fechas, la información sería el histórico de pagos de dicho cliente.
function mostrarPagosProducto($conn, $fecha_inicio, $fecha_fin, $numeroCliente)
{

    try {
        $stmt = $conn->prepare("SELECT payments.checkNumber , payments.amount,payments.paymentDate 
    FROM payments
    WHERE payments.customerNumber = :numeroCliente 
    AND (
        (:fecha_inicio IS NULL OR :fecha_inicio = '') OR
        (:fecha_fin IS NULL OR :fecha_fin = '') OR
        (payments.paymentDate BETWEEN :fecha_inicio AND :fecha_fin)
    )");
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam('fecha_fin', $fecha_fin);
        $stmt->bindParam(':numeroCliente', $numeroCliente);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        //  var_dump($result);
    } catch (PDOException $e) {
        $e->getMessage();
    }
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>checkNumber</th><th>amount</th><th>paymentDate</th>";
    echo "</tr>";
    foreach ($result as $key => $valor) {
        echo "<tr>";
        echo "<td>" . $result[$key]['checkNumber'] . "</td>";
        echo "<td>" . $result[$key]['amount'] . "</td>";
        echo "<td>" . $result[$key]['paymentDate'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
//-------------------Pasarela de Pago redirección-------------------//

function pasarelaDePago($orderNumber, $precioTotalPedido, $eleccionPago)
{
    include 'funciones/API_PHP/redsysHMAC256_API_PHP_7.0.0/apiRedsys.php';

    $precioTotalPedido = str_replace(".", "", $precioTotalPedido);
    $miObj = new RedsysAPI;
    $clave = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
    $code = '999008881';
    $order = $orderNumber;
    $currency = '978';
    $transactionType = '0';
    $urlweb_ok = 'http://localhost/ut4/pasarelaPagos/pe_inicio.php';
    $urlweb_ko = 'http://localhost/ut4/pasarelaPagos/pe_inicio.php';

    $miObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
    $miObj->setParameter("DS_MERCHANT_ORDER", $order);
    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $code);
    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $transactionType);
    $miObj->setParameter("DS_MERCHANT_URLOK", $urlweb_ok);
    $miObj->setParameter("DS_MERCHANT_URLKO", $urlweb_ko);

    if ($eleccionPago == 'tarjeta') {

        $amount = $precioTotalPedido; //$precioTotalPedido      
        $terminal = '1';
        $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
        $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
    } else if ($eleccionPago == 'bizum') {

        $terminal = '7';
        $miObj->setParameter("DS_MERCHANT_AMOUNT", "55");
        $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
        $miObj->setParameter("DS_MERCHANT_PAYMETHODS", "z");
    }

    $params = $miObj->createMerchantParameters();
    $signature = $miObj->createMerchantSignature($clave);
?>
    <form id="realizarPago" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="post">
        <input type='hidden' name='Ds_SignatureVersion' value='HMAC_SHA256_V1'>
        <input type='hidden' name='Ds_MerchantParameters' value='<?php echo $params; ?>'>
        <input type='hidden' name='Ds_Signature' value='<?php echo $signature; ?>'>
        <input type='submit' name='comprarTarjeta' value="Confirmar Compra" />
    </form>
<?php

}
