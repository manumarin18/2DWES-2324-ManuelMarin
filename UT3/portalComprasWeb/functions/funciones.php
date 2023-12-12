<?php
	function limpieza($datos) {
	  $datos = trim($datos);
	  $datos = stripslashes($datos);
	  $datos = htmlspecialchars($datos);
	  return $datos;
	}

	function crear_conexion(){
		$servername = "localhost"; //"ó ip"
		$username = "root";
		$password = "rootroot";
		$dbname="comprasweb";
		try {
		$conexion = new PDO("mysql:host=$servername;dbname=comprasweb",$username,$password);
		$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $conexion;
		}
		catch(PDOException $e){
			echo "Conexion fallida: " . $e->getMessage();
		}
	}
	
//------------------------------------------------------------------------------------------------------------------
	
	//Validaciones
	
	function validacion($nif){
		$numero=substr($nif,0,7);
		$letra=substr($nif,-1);
		$correcto=true;
		if(strlen($nif)==8 && $nif!=""){
			for($i=0;$i<strlen($numero);$i++){
				if(!is_numeric(substr($numero,$i,1))){
					$correcto=false;
				}
			}
			if(!ctype_alpha($letra)){
				$correcto=false;
			}
			else{
				$correcto=false;
			}
			return $correcto;
		}
	}
	
// -----------------------------------------------------------------------------------------------------------------	

	//Generar códigos de campo
	
	function generarCodigo(){
		try {
			$conexion=crear_conexion();
			$stmt = $conexion -> prepare("SELECT MAX(ID_CATEGORIA) as ultimoCodigo FROM categoria");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach($stmt->fetchAll() as $row){
				$ultimoCodigo=$row['ultimoCodigo'];
			}
			//var_dump($ultimoCodigo);
		
			if(empty($ultimoCodigo)){
				$CodigoDepartamento="C-000";
			}
			else{
				$codigo=substr($ultimoCodigo,2,3);
				$num=$codigo;
				$num+=1;
				$auxCodigoDepartamento="C-".str_pad($num,3,"0",STR_PAD_LEFT); 
				$CodigoDepartamento=$auxCodigoDepartamento;
			}
			return $CodigoDepartamento;
		}
		
		catch(PDOException $e) {
			echo "Error: ". $e->getMessage();
		}
		$conexion = null;
	}

	function generarCodigo2(){
		try {
			$conexion=crear_conexion();
			$stmt = $conexion -> prepare("SELECT MAX(ID_PRODUCTO) as ultimoCodigo FROM producto");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach($stmt->fetchAll() as $row){
				$ultimoCodigo=$row['ultimoCodigo'];
			}
			//var_dump($ultimoCodigo);
		
			if(empty($ultimoCodigo)){
				$CodigoDepartamento="P0000";
			}
			else{
				$codigo=substr($ultimoCodigo,1,4);
				$num=$codigo;
				$num+=1;
				$auxCodigoDepartamento="P".str_pad($num,4,"0",STR_PAD_LEFT); 
				$CodigoDepartamento=$auxCodigoDepartamento;
			}
			
			return $CodigoDepartamento;
			
		}
		
		catch(PDOException $e) {
			echo "Error: ". $e->getMessage();
		}
		
		$conexion = null;
		
	}

	function generarCodigo3() {
		try {
			$conexion = crear_conexion();
			$stmt = $conexion->prepare("SELECT MAX(NUM_ALMACEN) as ultimoCodigo FROM almacen");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

			$ultimoCodigo = $stmt->fetchColumn();

			$nuevoCodigo = empty($ultimoCodigo) ? 1 : $ultimoCodigo + 1;

			return $nuevoCodigo;
		} catch (PDOException $e) {
			
			echo "Error: " . $e->getMessage();
		} finally {
		   
			$conexion = null;
		}
	}

// -----------------------------------------------------------------------------------------------------------------	

	//Mostrar selects
	
	function mostrarSelect(){
		try {
			$conexion=crear_conexion();
			$stmt = $conexion->prepare("SELECT id_categoria,nombre FROM categoria");
			$stmt->execute();
			$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			echo "<select name='categoria'>";
			foreach($stmt->fetchAll() as $consulta){
			  echo '<option value="'.$consulta["id_categoria"].'">'.$consulta["nombre"].'</option>';
	
			}
			echo "</select>";
		}
		catch(PDOException $e){
			echo "Error:". $e->getMessage();
		}
		$conexion = null;
	}

	function mostrarSelect2(){
		try {
			$conexion=crear_conexion();
			$stmt = $conexion->prepare("SELECT id_producto,nombre FROM producto");
			$stmt->execute();
			$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			echo "<select name='producto'>";
			foreach($stmt->fetchAll() as $consulta){
			  echo '<option value="'.$consulta["id_producto"].'">'.$consulta["nombre"].'</option>';
	
			}
			echo "</select>";
		}
		catch(PDOException $e){
			echo "Error:". $e->getMessage();
		}
		$conexion = null;
	}
	
	function mostrarSelect3(){
		try {
			$conexion=crear_conexion();
			$stmt = $conexion->prepare("SELECT num_almacen,localidad FROM almacen");
			$stmt->execute();
			$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			echo "<select name='almacen'>";
			foreach($stmt->fetchAll() as $consulta){
			  echo '<option value="'.$consulta["num_almacen"].'">'.$consulta["localidad"].'</option>';
	
			}
			echo "</select>";
		}
		catch(PDOException $e){
			echo "Error:". $e->getMessage();
		}
		$conexion = null;
	}
	
	function mostrarSelect4(){
		try {
			$conexion=crear_conexion();
			$stmt = $conexion->prepare("SELECT nif,nombre FROM cliente");
			$stmt->execute();
			$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			echo "<select name='cliente'>";
				
				foreach($stmt->fetchAll() as $consulta){
				  echo '<option value="'.$consulta["nif"].'">'.$consulta["nif"].'</option>';
				}
				
			echo "</select>";
		}
		catch(PDOException $e){
			echo "Error:". $e->getMessage();
		}
		$conexion = null;
	}

// -----------------------------------------------------------------------------------------------------------------	

	//Iinsertar nuevos campos

	function insertar_categoria($conexion,$categoria){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$codigo=generarCodigo();
			//var_dump($codigo);

			$stmt = $conexion->prepare("INSERT INTO categoria (id_categoria,nombre)
			VALUES ('$codigo', '$categoria')");
			$stmt->execute();
			
			//var_dump($stmt);
			
			echo "<br>";
			echo "Categoria añadida con éxito.";
		}
		catch(PDOException $e) {
			echo "<br>";
			echo "Error al insertar categoria: ". $e->getMessage();
		}
		$conexion = null;	
	}
	
	function insertar_cliente($conexion,$NIF,$Nombre,$Apellido,$CP,$Direccion,$Ciudad){
		try {
			if(empty($NIF)){
				$nifErr = "<p>Es obligatorio poner un NIF </p>";
				echo $nifErr;
			} 
			else{
				if(!validacion($NIF)){
					$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conexion->prepare("INSERT INTO cliente (nif,nombre,apellido,cp,direccion,ciudad)
					VALUES ('$NIF','$Nombre','$Apellido','$CP','$Direccion','$Ciudad')");
					$stmt->execute();		
					echo "<br>";
					echo "<p>Cliente añadido con éxito.</p>";
				}
				else{
					echo "<p>Formato incorrecto de NIF </p>";
				}
			}
		}
		catch(PDOException $e) {
			echo "<br>";
			echo "Error al insertar cliente: ". $e->getMessage();
		}
		$conexion = null;	
	}

	function insertar_Producto($conexion,$producto,$precio,$categoria){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$codigo=generarCodigo2();
			//var_dump($codigo);

			$stmt = $conexion->prepare("INSERT INTO producto (id_producto,nombre,precio,id_categoria)
			VALUES ('$codigo','$producto','$precio','$categoria')");
			$stmt->execute();
			echo "<br>";
			echo "Producto añadido con éxito.";
		}
		catch(PDOException $e) {
			echo "<br>";
			echo "Error al insertar producto: ". $e->getMessage();
		}
		$conexion = null;	
	}

	function alta_almacen($conexion,$localidad){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$codigo=generarCodigo3();
			//var_dump($codigo);

			$stmt = $conexion->prepare("INSERT INTO almacen (num_almacen,localidad)
			VALUES ('$codigo','$localidad')");
			$stmt->execute();
			echo "<br>";
			echo "Almacen añadido con éxito.";
		}
		catch(PDOException $e) {
			echo "Error al insertar almacen: ". $e->getMessage();
		}
		$conexion = null;	
	}
	
	function aprovisionarProductos($conexion,$cantidad,$producto,$numAlmacen){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$codigo=generarCodigo3();

			$stmt = $conexion->prepare("INSERT INTO almacena (num_almacen,id_producto,cantidad)
			VALUES ('$numAlmacen','$producto','$cantidad')");
			$stmt->execute();
			echo "<br>";
			echo "Cantidad almacenada con éxito.";
		}
		catch(PDOException $e) {
			echo "Error al insertar cantidad: ". $e->getMessage();
		}
		$conexion = null;	
	}
	
	function compraDeProductos($conexion,$cliente,$producto,$fechaCompra,$unidades){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conexion->prepare("INSERT INTO compra (nif,id_producto,fecha_compra,unidades)
			VALUES ('$cliente','$producto','$fechaCompra','$unidades')");
			$stmt->execute();
			echo "<br>";
			echo "Compra realizada con éxito.";
			
		}
		catch(PDOException $e) {
			echo "<br>";
			echo "Error al comprar el producto: ". $e->getMessage();
		}
		$conexion = null;
	}
	
	
// -----------------------------------------------------------------------------------------------------------------	
	
	//Consulta de campos
	
	function consultarStock($conexion,$producto){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conexion->prepare("SELECT cantidad FROM almacena WHERE id_producto='$producto'");
			$stmt->execute();
		
			foreach($stmt->fetchAll() as $row){
				echo "<br>";
				echo "Cod_Producto: ".$producto." Cantidad: ".$row["cantidad"]."<br>";
			}
		}
		catch(PDOException $e) {
			echo "<br>";
			echo "Error al insertar cantidad: ". $e->getMessage();
		}
		$conexion = null;	
	}
	
	function consultarProductos($conexion,$almacen){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conexion->prepare("select id_producto,cantidad from almacena almacen where num_almacen='$almacen'");
			$stmt->execute();
		
			foreach($stmt->fetchAll() as $consulta){
				echo "<br>";
				echo "<b>Cod_Producto:</b> ".$consulta["id_producto"]."<br>"." <b>Cantidad:</b> ".$consulta["cantidad"]."<br>";
			}
		}
		catch(PDOException $e) {
			echo "<br>";
			echo "Error al insertar cantidad: ". $e->getMessage();
		}
		$conexion = null;	
	}
	
	function consultarCompras($conexion,$almacen){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conexion->prepare("select id_producto,cantidad from almacena almacen where num_almacen='$almacen'");
			$stmt->execute();
		
			foreach($stmt->fetchAll() as $consulta){
				echo "<br>";
				echo "<b>Cod_Producto:</b> ".$consulta["id_producto"]."<br>"." <b>Cantidad:</b> ".$consulta["cantidad"]."<br>";
			}
		}
		catch(PDOException $e) {
			echo "<br>";
			echo "Error al insertar cantidad: ". $e->getMessage();
		}
		$conexion = null;	
	}
	
	function disponibilidadAlmacen($conexion,$producto){
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stock="";
			
			$stmt = $conexion->prepare("select sum(cantidad) as stock from almacena where id_producto='$producto'");
			$stmt->execute();
		
			foreach($stmt->fetchAll() as $consulta){
				$stock=$consulta["stock"];
			}
			
			return $stock;
		}
		catch(PDOException $e) {
			echo "<br>";
			echo "Error: ". $e->getMessage();
		}
		$conexion = null;	
	}
	
	function consultarCompras2($conexion,$cliente,$fechaIni,$fechaFin){
		$total=0;
		
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conexion->prepare("SELECT CLIENTE.NOMBRE AS CLIENTE,PRODUCTO.NOMBRE AS PRODUCTO,PRODUCTO.PRECIO,COMPRA.FECHA_COMPRA FROM CLIENTE,PRODUCTO,COMPRA
        WHERE CLIENTE.NIF = COMPRA.NIF AND PRODUCTO.ID_PRODUCTO = COMPRA.ID_PRODUCTO
        AND CLIENTE.NIF = '$cliente' AND COMPRA.FECHA_COMPRA >= '$fechaIni' AND COMPRA.FECHA_COMPRA <= '$fechaFin'");
		$stmt->execute();
		
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
			echo "Cliente: ".$row['CLIENTE']." || Producto: ".$row['PRODUCTO']." || Precio: ".$row['PRECIO']."€ ||FechaCompra ".$row['FECHA_COMPRA'];
			$total += $row['PRECIO'];
			echo "<br>";
       }
	   echo "Total: ".$total."€";
    }

// -----------------------------------------------------------------------------------------------------------------	
	
	//Actualizar campos
	
	function actualizarAlmacen($conexion, $producto, $unidades) {
		try {
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexion->beginTransaction();

			//Obtener los almacenes ordenados por número
			$stmt = $conexion->prepare("SELECT NUM_ALMACEN, CANTIDAD FROM ALMACENA 
											WHERE ID_PRODUCTO = ? ORDER BY NUM_ALMACEN");
			$stmt->execute([$producto]);

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$almacen = $row['NUM_ALMACEN'];
				$stockAlmacen = $row['CANTIDAD'];

				if ($stockAlmacen >= $unidades) {
					//Si el almacén tiene suficientes unidades, restarlas y salir del bucle
					$stmtUpdate = $conexion->prepare("UPDATE ALMACENA SET CANTIDAD = CANTIDAD - ? 
														WHERE ID_PRODUCTO = ? AND NUM_ALMACEN = ?");
					$stmtUpdate->execute([$unidades, $producto, $almacen]);
					break;
				} else {
					//Si el almacén no tiene suficientes unidades, restar las disponibles y continuar al siguiente almacén
					$stmtUpdate = $conexion->prepare("UPDATE ALMACENA SET CANTIDAD = '0' 
														WHERE ID_PRODUCTO = ? AND NUM_ALMACEN = ?");
					$stmtUpdate->execute([$producto, $almacen]);
					$unidades -= $stockAlmacen;
				}
			}

			$conexion->commit();

		} catch (PDOException $e) {
			$conexion->rollBack();
			echo "Error: " . $e->getMessage();
		}
	}

?>

