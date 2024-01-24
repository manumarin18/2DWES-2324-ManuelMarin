<HTML>
<HEAD><TITLE>PEDIDOS</TITLE>
</HEAD>
<BODY>
<?php
    require("funciones.php");
	//Establecemos conexion con la base de datos.
    $conn = conexion();
	//Iniciamos la sesión.
    session_start();
?>
<a href="pe_inicio.php">Home</a>
<h3>Realizar pedido:</h3>
<form name="formu" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    Producto  <select name="producto">
    <?php
	//Obtenemos los productos disponibles y se muestran en el menú desplegable.
        $producto=visualizarProductos($conn);
        mostrarProductos($producto);
    ?>
    </select>
    <br><br>
    <label type="text" name="cantidad">Cantidad <input type="number" min="0" name="cantidad"></label>
    <br><br>
    <input type="submit" value="Añadir Bolsa" name="enviar" />
    <input type="submit" value="Comprar" name="enviar" />
    <br><br>
    <label type="text" name="tarjeta">Tarjeta <input type="text" min="1" name="tarjeta" placeholder="AB12345"></label>
</form>
<?php
//Variable para indica si se debe realizar la compra.
$realizar=true;
//Obtenemos el carrito de la sesión.
$var=unserialize($_SESSION["carrito"]);
//Deshabilitamos mensajes de error para evitar que se muestren antes de tiempo.
error_reporting(0);

//Si se han enviado datos correctamente.
if(!empty($_POST)){
    //Obtenemos la fecha actual.
    $fecha=date('Y-m-d');
    
    //Si se ha seleccionado "Comprar" y la bolsa no está vacía, y se ha proporcionado una tarjeta.
    if($_POST["enviar"]=="Comprar" && empty($_SESSION["carrito"]==false) && !empty($_POST["tarjeta"])){
        //Obtenemos los datos necesarios.
        $var=unserialize($_SESSION["carrito"]);
        $tarjeta=$_POST["tarjeta"];
        $usuario=$_SESSION["usuario"];

        //Obtenemos el número de pedido y creamos la orden.
        $num_pedido=detallesCompra($conn);
        fechaPedido($conn,$fecha,$num_pedido,$usuario);
        
        //Recorremos los productos en el carrito.
        $cont=1;
        foreach($var as $nombre => $total){
            //Obtenemos el precio del producto y añadimos la compra al historial.
            $precio=precioProducto($conn,$nombre);
            addCompra($conn,$num_pedido,$nombre,$total,$precio,$cont);

            //Actualizamos el stock del producto.
            $cant=cantidadAlmacen($conn,$nombre)-$total;
            actualizaStock($conn,$nombre,$cant);
            $cont++;     
        }

        //Calculamos el total de la compra y registramos el pago.
        $cantidad=totalCompra($conn,$var);
        compraRealizada($conn,$usuario,$tarjeta,$fecha,$cantidad);
        
        //Reiniciamos el carrito y redirigimos a la página de confirmación de pago.
        $var="";
        $_SESSION["carrito"]=$var;
        echo' <script> location.replace("pe_altapago.php"); </script>';
       
    }
    else{
        //Si la cantidad no ha sido introducida y no se ha seleccionado "Comprar".
        if( $_POST["cantidad"]=="" && $_POST["enviar"]!="Comprar"){
            echo "<p id='err'>Error: No se ha introducido una cantidad</p>";
            $realizar=false;
        }
        if($realizar){
            //Indicamos si se debe seguir con el proceso de añadir productos al carrito.
            $seguir=true;

            //Si se ha enviado el formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"]== "POST"){
                $usr=$_SESSION["usuario"];
                $producto=$_POST["producto"];
                $cant=$_POST["cantidad"];
            }

            //Obtenemos la cantidad disponible en stock del producto seleccionado.
            $tot= totalProducto($conn,$producto);
            foreach($tot as $row) {
                $cont = $row["quantityInStock"];
                //Si no hay suficiente stock, se muestra un mensaje de error.
               if($cont<$cant){
                    echo "<p id='err'>Error: No hay suficiente stock</p>";
                    $seguir=false;
               }
            }

            //Si se debe seguir con el proceso.
            if($seguir){
                $existe=false;

                //Verificamos si el producto ya está en el carrito.
                foreach($var as $nombre => $total){
                    if(strcmp($nombre,$producto)==0){
                        $var[$producto] = $total+$cant;
                        $existe=true;
                    }
                }
                
                //Si el producto no estaba en el carrito lo añadimos.
                if(!$existe){
                    $var[$producto] = intval($cant);
                }

                //Serializamos el carrito actualizado y actualizamos la sesión.
                $arr=serialize($var);
                addCarrito($arr);
            }
        }   
    }
}

//Mostramos el contenido actual del carrito.
verCarrito($conn,$var);

//Cerramos la conexión a la base de datos.
$conn = null;
?>
</BODY>
</HTML>