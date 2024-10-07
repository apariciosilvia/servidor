<?php 
    define ('PIEDRA1',  "&#x1F91C;");
    define ('PIEDRA2',  "&#x1F91B;");
    define ('TIJERAS',  "&#x1F596;");
    define ('PAPEL',    "&#x1F91A;" );

    function piedraPapelTijeras() {
        return random_int(0, 2); 
    }

    $jugador1 = piedraPapelTijeras();
    $jugador2 = piedraPapelTijeras();

    $jugador1 = ($jugador1 == 0) ? "piedra" : (($jugador1 == 1) ? "papel" : "tijeras");
    $jugador2 = ($jugador2 == 0) ? "piedra" : (($jugador2 == 1) ? "papel" : "tijeras");

    if ($jugador1 == $jugador2) {
        $mensaje = "¡Empate!";
    } elseif (($jugador1 == "piedra" && $jugador2 == "tijeras") || ($jugador1 == "tijeras" && $jugador2 == "papel") || ($jugador1 == "papel" && $jugador2 == "piedra")) {
        $mensaje = "HA GANADO EL JUGADOR 1";
    } else {
        $mensaje = "HA GANADO EL JUGADOR 2";
    }
  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>piedraPapelTijeras</title>
    <!--<meta http-equiv="refresh" content="5">-->
    <style> 
        table {
            font-size: 10px; 
            width: 250px;
            margin-left: 0;    
        }
        th{
            font-size: 20px;
            padding: 5px;
            
        }
        td {
            font-size: 80px;
            padding: 5px;
            
        }

        span{
            font-size: 15px; 
            font-weight: bolder;
            padding-left: 5px;
        }
        div{
            width: 250px;
            text-align: center;
        }

    </style> 
</head>
<body>
    <h1> ¡Piedra, papel, tijeras! </h1>
    <p> Actualice la página para mostrar otra partida</p>

    <div>
        <table>
            <tr>
                <th>Jugador 1</th>
                <th>Jugador 2</th>
            </tr>
            <tr>
                <td><?= ($jugador1 == "piedra") ? PIEDRA1 : (($jugador1 == "papel") ? PAPEL : TIJERAS) ?></td>
                <td><?= ($jugador2 == "piedra") ? PIEDRA2 : (($jugador2 == "papel") ? PAPEL : TIJERAS) ?></td>
            </tr>
        </table>
    
        <span><?= $mensaje ?></span>
    </div>
    
</body>
</html>