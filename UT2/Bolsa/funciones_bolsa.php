<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
<?php

//Leemos el archivo y lo mostramos
function leerarchi($fichero){ 
    $file = file($fichero);
    foreach ($file as $item ) {
        echo $item ;
        echo "<br>";
    }
}
//Leemeos la linea de la empresa que le pasamos
function leerlinea($fichero,$emp){ 
    $fichero1 = file($fichero);
        //echo $fichero1[0]."<br>";
        foreach ($fichero1 as $value ) {
            if (strpos($value ,$emp) !== false) {
                echo $value;
            }
        }
}

//Leemos la columna que le pasamos 
function valores($fichero,$emp,$tipo){ 
    $fichero1 = file($fichero);

    foreach ($fichero1 as $value ) {
        if (strpos($value ,$emp) !== false) {
            switch ($tipo) {
                case 'ulti':
                    $res = substr($value,24-1, 34-25);
                    break;
                case 'var':
                    $res = substr($value,32, 41-34);
                    break;
                case 'var1':
                    $res = substr($value,40,49-41);
                    break;
                case 'ac':
                    $res = substr($value,48, 61-49);
                    break;
                case 'max':
                    $res = substr($value,60, 70-61);
                    break;
                case 'min':
                    $res = substr($value,69, 79-70);
                    break;
                case 'vol':
                    $res = substr($value,78, 92-79);
                    break;
                case 'capi':
                    $res = substr($value,91, 101-92);
                    break;
            }
        }
    }
    return $res;

}

//Creamos la funcion para que nos cree el select de empresas
function select($fichero){     
    $fichero1 = file($fichero);
    $cont = 0;
    foreach ($fichero1 as $value ) {
        if($cont == 0)$cont++;
        else{$valor = substr($value,0, 24-1);
        echo "<option value=$valor>$valor</option>";
        }
    }
}

function total($fichero,$tipo){ 
    $fichero1 = file($fichero);
    $res = "0";
    $cont = 0;
            switch ($tipo) {
                case 'totvol':
                    foreach ($fichero1 as $value ) {
                        if($cont == 0)$cont++;
                            else{
                                $res1 = substr($value,78, 92-79);
                                $res1 = (int)str_replace('.', '', $res1);
                                $res = $res+$res1;
                            }
                    }
                    break;
                case 'totcap':
                    foreach ($fichero1 as $value ) {
                        if($cont == 0)$cont++;
                        else{
                            $res1 = substr($value,91, 101-92);
                            $res1 = (int)str_replace('.', '', $res1);
                                $res = $res+$res1;
                        }
                    }
                    break;
            
        
    }
    return $res;
}
?>
</body>
</html>