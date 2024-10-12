<?php
    define ('uno', "&#9856;");
    define ('dos', "&#9857;");
    define ('tres', "&#9858;");
    define ('cuatro', "&#9859;");
    define ('cinco', "&#9860;");
    define ('seis', "&#9861;");

    function tirarDados() {
        return random_int(1, 6); 
    }

    function mostrarDado($numero) {
        switch($numero) {
            case 1: return uno;
            case 2: return dos;
            case 3: return tres;
            case 4: return cuatro;
            case 5: return cinco;
            case 6: return seis;
        }
    }

    function jugador1Dados() {
        $jugadorUno = [];
        for($i = 0; $i < 5; $i++) {
            $jugadorUno[] = tirarDados();
        }
        return $jugadorUno;
    }

    function jugador2Dados() {
        $jugadorDos = [];
        for($i = 0; $i < 5; $i++) {
            $jugadorDos[] = tirarDados();
        }
        return $jugadorDos;
    }

    function calcularPuntos($dados) {
        sort($dados); //menor a mayor
        array_shift($dados); //eliminamos el menor (el primer elemento)
        array_pop($dados); //eliminamos el mayor (el ultimo elemento)
        $suma = array_sum($dados);
        return $suma;
    }

    $jugador1 = jugador1Dados();
    $jugador2 = jugador2Dados();

    $resultadoJugador1 = array_map('mostrarDado', $jugador1); //array_map() aplica una función a cada elemento de un array(la funcion mopstrar dado se aplica a cada argumento del array jugador1)
    $resultadoJugador2 = array_map('mostrarDado', $jugador2);

    $puntosJugador1 = calcularPuntos($jugador1);
    $puntosJugador2 = calcularPuntos($jugador2);

    if ($puntosJugador1 > $puntosJugador2){
        $mensaje = "Ha ganado el Jugador 1.";
    } elseif ($puntosJugador1 < $puntosJugador2){
        $mensaje = "Ha ganado el Jugador 2.";
    } else {
        $mensaje = "¡EMPATE!";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Cinco Dados</title>
</head>
<style>
    div{
        width:fit-content;
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 20px;
        padding-right: 20px;
        display: flex;
        align-items: center;
    }

    .rojo{
        background-color: red;
        font-size: 50px;
    }

    .azul{
        background-color: blue;
        font-size: 50px;
    }
</style>
<body>
    <h1>Cinco Dados</h1>
    <p>Actualice la página para mostrar una nueva tirada.</p>
    <div><b>Jugador 1:&nbsp;</b><span class="rojo"><?= implode(' ', $resultadoJugador1) ?> </span><b>&nbsp;<?=$puntosJugador1?> puntos</b></div>   <!--implode() es una función en PHP que convierte un array en una cadena de texto. -->
    <div><b>Jugador 2:&nbsp;</b><span class="azul"><?= implode(' ', $resultadoJugador2) ?></span><b>&nbsp;<?=$puntosJugador2?> puntos</b></div>
    <p><b>Resultado:&nbsp;</b> <?= $mensaje ?></p>
</body>
</html>