<?php

include 'BiciElectrica.php';

function cargarbicis() {

    $rutaFichero = 'Bicis.csv'; //RUTA DEL ARCHIVO CSV
    $fichero = fopen($rutaFichero, "r");
    $bicicletas = [];

    while ($informacion = fgetcsv($fichero)) {
        $bici = new BiciElectrica(
            $informacion[0], //ID BICI
            $informacion[1], //CORDENADA X
            $informacion[2], //CORDENADA Y
            $informacion[3], //BATERIA
            $informacion[4]  //OPERATIVA DE LA BICI
        );

        $bicicletas[] = $bici;
    }
    fclose($fichero);

    return $bicicletas;
}

function mostrartablabicis($tabla) {

    $msg = "<table>";
        $msg .= "<tr>";
            $msg .= "<th>ID</th>";
            $msg .= "<th>COORD X</th>";
            $msg .= "<th>COORD Y</th>";
            $msg .= "<th>BATERIA</th>";
        $msg .= "</tr>";

        foreach($tabla as $bici){
            if($bici->operativa == 1){ //SOLO SI LA BICI ESTA OPERATIVA
            $msg .= "<tr>";
                $msg .= "<td>$bici->id</td>";
                $msg .= "<td>$bici->coordx</td>";
                $msg .= "<td>$bici->coordy</td>";
                $msg .= "<td>$bici->bateria</td>";
            $msg .= "</tr>";
            }
        }
    $msg .= "</table>";

    return $msg;
}

function bicimascercana($coordx, $coordy, $tabla) {
    $biciMasCercana = null;
    $distanciaMinima = PHP_FLOAT_MAX; //MAYOR VALOR PARA UN FLOAT 

    foreach ($tabla as $bici) {
        if ($bici->operativa == 1) { //SOLO SI LA BICI ESTA OPERATIVA
            $distancia = $bici->distancia($coordx, $coordy);
            if ($distancia < $distanciaMinima) {
                $distanciaMinima = $distancia;
                $biciMasCercana = $bici;
            }
        }
    }

    return $biciMasCercana; //DEVUELVE EL OBJETO DE LA BICI MÁS CERCANA
}

// Programa principal
$tabla = cargarbicis();
if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
    $biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MOSTRAR BICIS OPERATIVAS</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>

</head>

<body>
    <h1> Listado de bicicletas operativas </h1>
    <?= mostrartablabicis($tabla); ?>
    <?php if (isset($biciRecomendada)) : ?>
        <h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
        <button onclick="history.back()"> Volver </button>
    <?php else : ?>
        <h2> Indicar su ubicación: <h2>
                <form>
                    Coordenada X: <input type="number" name="coordx"><br>
                    Coordenada Y: <input type="number" name="coordy"><br>
                    <input type="submit" value=" Consultar ">
                </form>
            <?php endif ?>
</body>

</html>