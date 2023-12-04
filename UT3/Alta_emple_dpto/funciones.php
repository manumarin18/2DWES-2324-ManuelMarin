<?php
function conexion(){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "empleadosnm";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $conn; 
}

function visualizar_dpto($conn){
        $stmt = $conn->prepare("SELECT cod_dpto,nombre FROM dpto");
        $stmt->execute();
    
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
}

function empleados_dpto($conn,$valor){
    $stmt = $conn->prepare("
	SELECT emple.dni, emple.nombre, emple.salario, emple.fecha_nac
	FROM emple,dpto,emple_dpto WHERE emple_dpto.fecha_fin IS NULL 
    AND emple.dni = emple_dpto.dni AND dpto.cod_dpto = emple_dpto.cod_dpto
    AND dpto.cod_dpto=:codDPTO;");
	
	$stmt -> bindParam(':codDPTO',$valor);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll(); 
    
    return $result;
}


function alta_empleado($conn,$dni,$nombre,$salario,$fecha){
    $stmt = $conn->prepare("
	INSERT INTO EMPLE (dni,nombre,salario,fecha_nac)
    VALUES(:dni,:nombre,:salario,:fecha);");
    $stmt->bindParam(':dni',$dni);
    $stmt->bindParam(':nombre',$nombre);
    $stmt->bindParam(':salario',$salario);
    $stmt->bindParam(':fecha',$fecha);
    $stmt->execute();
}

function alta_emple_fecha($conn,$dni,$cod_dpto,$fecha_alt){
    $stmt = $conn->prepare("
	INSERT INTO EMPLE_DPTO (dni,cod_dpto,fecha_inicio,fecha_fin)
    VALUES(:dni,:cod_dpto,:fecha_alt,NULL);");
    $stmt->bindParam(':dni',$dni);
    $stmt->bindParam(':cod_dpto',$cod_dpto);
    $stmt->bindParam(':fecha_alt',$fecha_alt);
    $stmt->execute();

    echo "Alta Empleado correcta";
    
}

function contar_dpto($conn){
    $stmt = $conn->prepare("SELECT count(nombre) FROM dpto");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}

function calcular_dpto($tot){
    foreach($tot as $row) {
        $contDpto = $row["count(nombre)"];
    }

        $contDpto++;
        $contDpto=str_pad($contDpto,3,"0",STR_PAD_LEFT);
        $codiDpto="D".$contDpto;
        return $codiDpto;
}

function añadir_dpto($conn,$val,$nombr){
    $nuev = $conn->prepare("
	INSERT INTO DPTO (cod_dpto,nombre) 
	VALUES(:codDp,:nom);");     

    $nuev -> bindParam(':nom',$nombr);
    $nuev -> bindParam(':codDp',$val);

    $nuev->execute();

    echo "Departamento $nombr creado";
}


?>