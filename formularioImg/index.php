<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include_once 'captura.html'; //SI SE ENVIA POR GET SALE EL HTML
} else if ($_SERVER["REQUEST_METHOD"] == "POST") { //SI SE ENVIA POR POST
    $nombre = strip_tags($_POST['nombre']);
    $alias = strip_tags($_POST['alias']); //CONTROLAMOS INYECCION DE CODIGO DE NOMBRE Y ALIAS
    $edad = $_POST['edad'];
    $elegir = $_POST['elegir'];

    echo "<html><head><title>Información del Jugador</title>
          <link rel='stylesheet' href='estilo.css'></head>
          <body style='background-color: yellow'>
              <h1 class='titulo'>Datos del jugador</h1>
              <div class='respuesta'> 
                  <div class='contenidoJugador'>
                      <b>Nombre: </b> $nombre<br>
                      <b>Alias: </b> $alias<br>
                      <b>Edad: </b> $edad<br>
                      <b>Armas seleccionadas:  </b>";

    if (isset($_POST['elegirArma'])) {
        foreach ($_POST['elegirArma'] as $arma) {
            echo "$arma, ";
        }
    } else {
        echo "<i>No se han seleccionado armas.</i>";
    }

    echo "</b><br>
          <b>¿Prácticas con artes mágicas? </b>$elegir
          </div>";

    $calaveraRuta = './calavera.png'; 
    $guardarimagen = $calaveraRuta; //POR DEFECTO SE MOSTRARA CALAVERA

    if ($_FILES['fichero']['name']) {
        $tipoFichero = $_FILES['fichero']['type'];
        $tamañoFichero = $_FILES['fichero']['size'];

        if ($tipoFichero == 'image/png' && $tamañoFichero <= 10240) {
            $nombreFichero = $_FILES['fichero']['name'];
            $rutaFichero = 'uploads/' . $nombreFichero;
            $temporalFichero = $_FILES['fichero']['tmp_name'];
            move_uploaded_file($temporalFichero, $rutaFichero);
            $guardarimagen = $rutaFichero; 
            echo "<div class='contenidoFoto'><p>Imagen subida correctamente</p></div>";
        } else {
            if($tipoFichero == 'image/png'){
                echo "<div class='contenidoFoto'><p>EL ARCHIVO ES MAYOR DE 10KB</p></div>";
            } else{
                echo "<div class='contenidoFoto'><p>EL ARCHIVO NO ES PNG</p></div>";
            }
        }
    } else {
        echo "<div class='contenidoFoto'><p>NO SE ELEGIDO NINGUNA FOTO</p></div>";
    }
    //MOSTRAMOS EL CONTENIDO DE FOTO PROPOCIONADA O POR DEFECTO
    echo "<div class='contenidoFoto'>
            <img id='foto' src='$guardarimagen' alt='Imagen del jugador'> 
          </div>";
    echo "</div></body></html>";
}
/*<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Jugador</title>
    <style>
        .titulo{
            text-align: center;
            font-weight: bolder;
        }
        .respuesta{
            display: flex;
        }
        .contenidoJugador{
            text-align: left;
            padding-left: 20%;
            width: 45%;
        }
        .contenidoFoto{
            width: 45%;
            padding-top: 0;
            padding-left: 4%;
        }
        #mensaje{
            margin-bottom: 5%;
        }
        #foto{
            border: 2px solid black;
            padding: 2%;
            border-radius: 1px;
        }

    </style>
</head>
<body>
<body>
<h1 class="titulo">Datos del jugador</h1>
    <div class="respuesta"> 
        <div class="contenidoJugador">
            <b>Nombre: '.$nombre.'</b> <br>
            <b>Alias: '.$alias.'</b> <br>
            <b>Edad: '.$edad.'</b> <br>
            <b>Armas seleccionadas: 
                '.foreach ($armas as $armasSeleccionadas){
                    echo  "$armasSeleccionadas, ";
                    }.'</b> <br>
            <b>¿Prácticas con artes mágicas? '.$elegir.' </b>
        </div>
        <div class="contenidoFoto">
            <div id="mensaje">
                <b>'$mensaje'</b>
            </div>
            <div id="foto">
                <img src="./calavera.png" width="100px" height="150px" alt="">
            </div>
        </div>
    </div>
</body>
</html> */
?>


