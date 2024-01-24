<?php
//Función que establece una conexión a la base de datos MySQL y devuelve el objeto de conexión.
function conexion(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "pedidos";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
	//En caso de error, imprime el mensaje de error y el código de error.
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        echo "<h1>ERROR CODE</h1>".$error=$e->getCode();
    }
    return $conn; 
}
//Función que realiza el login, recibe la conexión y el nombre de usuario, devuelve el apellido del usuario.
function login($conn,$nombre){
    $stmt = $conn->prepare("SELECT CustomerNumber,ContactLastName FROM Customers
    WHERE CustomerNumber = :nombre ");

    $stmt -> bindParam(':nombre',$nombre);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dat){
        return $dat["ContactLastName"];
    }
}
//Función que crea una sesión con el DNI del usuario y el carrito de compras.
function crearSession($dni){
    $_SESSION["usuario"]=$dni;
    $_SESSION["carrito"]=$prod;
}
//Función que borra la sesión del usuario y el carrito de compras mediante cookies.
function borrarSesion($dni,$prod){
    setcookie( "usuario", $dni,  time() - (86400 * 30));
    setcookie( "carrito", $prod,  time() - (86400 * 30));
}
//Función que obtiene y devuelve un array con los productos disponibles en el almacén.
function visualizarProductos($conn){
    $stmt = $conn->prepare("SELECT productCode,productName FROM products WHERE quantityInStock >= 0;");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}
//Función que imprime opciones de productos en un formulario desplegable.
function mostrarProductos($dep){
    foreach($dep as $row) {
        echo "<option value=".$row["productCode"].">". $row["productName"]. "</option>";
    }
}
//Función que actualiza el carrito de compras en la sesión.
function addCarrito($tmt){
    $_SESSION["carrito"]=$tmt;
}
//Función que obtiene la cantidad en stock de un producto.
function totalProducto($conn,$produc){
    $stmt = $conn->prepare("SELECT quantityInStock FROM products WHERE productCode = :idP;");

    $stmt -> bindParam(':idP',$produc);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}
//Función que muestra los productos en el carrito y calcula el precio total.
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
                echo "<b>".$dat['productName']."</b> Unidades <b>$total</b> TOTAL: <b>".$dat['buyPrice']*$total."€ </b><br>";
            }
        }
    }
    if($precioFinal==0){
        echo "Tu carrito está vacio";
    }else{
        echo "<br>Total compra: <b>$precioFinal €</b>";
    }
}
//Función que obtiene el número de pedido para realizar detalles de la compra.
function detallesCompra($conn){
    $stmt = $conn->prepare("SELECT MAX(orderNumber) FROM orders");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dat){
        return ($dat["MAX(orderNumber)"]+1);
    }

}
//Función que añade detalles de la compra a la base de datos.
function addCompra($conn,$num_pedido,$nombre,$total,$precio,$lin){
    $stmt = $conn->prepare("INSERT INTO orderdetails (orderNumber,productCode,quantityOrdered,priceEach,orderLineNumber)
    VALUES(:num_pedido,:codigo,:cantidad,:price,:linea)");

    $stmt -> bindParam(':num_pedido',$num_pedido);
    $stmt -> bindParam(':codigo',$nombre);
    $stmt -> bindParam(':cantidad',$total);
    $stmt -> bindParam(':price',$precio);
    $stmt -> bindParam(':linea',$lin);
    $stmt->execute();
}
//Función que registra la fecha del pedido.
function fechaPedido($conn,$fecha,$num,$user){
    $stmt = $conn->prepare("INSERT INTO orders (orderNumber,orderDate,requiredDate,status,customerNumber)
    VALUES(:num,:fech,:fech,'Waiting ',:usr)");

    $stmt -> bindParam(':num',$num);
    $stmt -> bindParam(':fech',$fecha);
    $stmt -> bindParam(':estado',$estado);
    $stmt -> bindParam(':usr',$user);
    $stmt->execute();
}
//Función que obtiene el precio de un producto.
function precioProducto($conn,$id){
    $stmt = $conn->prepare("SELECT buyPrice FROM products WHERE productCode = :code");
    $stmt -> bindParam(':code',$id);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dat){
        return ($dat["buyPrice"]);
    }
}
//Función que obtiene la cantidad en stock de un producto.
function cantidadAlmacen($conn,$produc){
    $stmt = $conn->prepare("SELECT quantityInStock FROM products
    WHERE productCode = :idP;");

    $stmt -> bindParam(':idP',$produc);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    foreach($result as $dat){
        return ($dat["quantityInStock"]);
    }
}
//Función que actualiza el stock después de realizar una compra.
function actualizaStock($conn,$id,$cant){
    $stmt = $conn->prepare("UPDATE products SET quantityInStock = :cant WHERE
        productCode = :id");

        $stmt -> bindParam(':cant',$cant);
        $stmt -> bindParam(':id',$id);
        $stmt->execute();
}
//Función que registra la compra realizada en la tabla de pagos.
function compraRealizada($conn,$user,$tarjeta,$fecha,$cantidad){
    $stmt = $conn->prepare("INSERT INTO payments(customerNumber,checkNumber,paymentDate,amount)
    VALUES(:usr,:tarjeta,:fech,:cant)");
    
    $stmt -> bindParam(':usr',$user);
    $stmt -> bindParam(':tarjeta',$tarjeta);
    $stmt -> bindParam(':fech',$fecha);
    $stmt -> bindParam(':cant',$cantidad);
    $stmt->execute();
}
//Función que calcula y muestra el total de la compra.
function totalCompra($conn,$arr){
    $precioFinal=0;
    $stmt = $conn->prepare("SELECT productName, productCode,buyPrice FROM products;");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    
    foreach($arr as $nombre => $total){
        foreach($result as $dat){
            if($dat["productCode"]==$nombre){
                $precioFinal=$dat['buyPrice']*$total+$precioFinal;
                echo "<b>".$dat['productName']."</b> Unidades <b>$total</b> TOTAL: <b>".$dat['buyPrice']*$total."€ </b><br>";
            }
        }
    }
    return $precioFinal;
}

?>