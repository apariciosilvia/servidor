<?php
function ipCliente()
{
    return $_SERVER['REMOTE_ADDR'];
}

function fechaActual()
{
    return date('d-m-Y H:i:s');
}

function limpiarCodigo()
{
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars(trim($value));
    }
}

const RUTA = 'incidencias.txt';
$generarFecha = fechaActual();
$generarIp = ipCliente();
limpiarCodigo();

$fichero = @fopen(RUTA, 'r') or die('Error no se ha podido anotar su incidencia');
//$lineasFichero = fgets($fichero);
$contenidoFichero = file(RUTA);
foreach ($contenidoFichero as $key => $value) {
    $contenidoFichero[$key] = trim($contenidoFichero[$key]);
    $contenidoFichero[$key] = explode(',', $contenidoFichero[$key]);
}


$contenidoNuevo[] = [$generarFecha , $_POST['nombre'] , $_POST['resumen'] , $_POST['prioridad'] , $generarIp];

$contenidoFichero = array_merge($contenidoFichero, $contenidoNuevo);

array_multisort(array_column($contenidoFichero, 3),SORT_ASC, $contenidoFichero); //ORDENADOR POR PRIORIDAD
print_r($contenidoFichero);

if (volcarContenido($contenidoFichero)) {
    echo "<br> <br> <b>Muchas gracias Fernando, se ha anotado su incidencia</b>";
}

function volcarContenido($contenidoFichero){
    $fichero = @fopen(RUTA, 'w') or die('Error no se ha podido anotar su incidencia');

    foreach ($contenidoFichero as $valores) {
        $linea = "$valores[0],$valores[1],$valores[2],$valores[3],$valores[4]\n";
        fputs($fichero, $linea);
    }
    fclose($fichero);
    return true; 
}

