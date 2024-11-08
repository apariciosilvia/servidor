<?php 
session_start(); //INICIAMOS LA SESION SIEMPRE QUE QUERAMOS USAR SESIONES

$compraRealizada = "";
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(isset($_GET['cliente'])){ //SI HAY CLIENTE
            $_SESSION['cliente'] =  $_GET['cliente'];
            include_once('./ficheros_plantillas/compra.php');
            exit();
        } else{ //SI NO HAY CLIENTE
            include_once('./ficheros_plantillas/bienvenida.php');
            exit();
        }
    }

    /*if(isset($_GET['cliente']) && !empty($_GET['cliente'])){ //SI HAY CLIENTE Y NO ESTA VACIO
        $_SESSION['cliente'] =  $_GET['cliente'];
        include_once('./ficheros_plantillas/compra.php');
    }

    if (!isset($_SESSION['cliente'])) {  //SI NO HAY CLIENTE
        include_once('./ficheros_plantillas/bienvenida.php');
    }

    if(empty($_GET['cliente'])){
        include_once('./ficheros_plantillas/bienvenida.php');
        exit();
    }*/

    function mostrarPedido($frutas){
        $informacionFrutas = "Este es su pedido: <br><table style='border-collapse: collapse;  border: 1px solid black; text-align: left;'><tr><th>";
        foreach ($frutas as $fruta => $cantidad) {
            if($cantidad != 0){
                $informacionFrutas .= "$fruta $cantidad<br>";   
            }
        }
        return $informacionFrutas .= "</th></tr></table><br>"; //CERRAMOS LA LISTA
    }

    function resumenPedido($frutas){
        $informacionFrutas = "Este es su pedido: <br><table style='border-collapse: collapse;  border: 1px solid black; text-align: left;'><tr><th>";
        foreach ($_SESSION['frutas'] as $fruta => $total) {
            if ($total > 0) {
                $informacionFrutas .= "$fruta $total<br>";
            }
        }
        return $informacionFrutas .= "</th></tr></table><br>";  
    }

    if (!isset($_SESSION['frutas'])) { //SI NO EXISTE LA TABLA(ARRAY) DE PEDIDOS LA INICIALIZAMOS A 0
        $_SESSION['frutas'] = [
            "Platanos" => 0,
            "Naranjas" => 0,
            "Limones" => 0,
            "Manzanas" => 0,
        ];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //VERIFICAMOS SI EL FORMULARIO ES ENVIADO POR POST
        $frutaSeleccionada = $_POST['fruta']; //ALAMACENAMOS LA FRUTA SELECCIONADA
        $cantidad = (int)$_POST['cantidad']; //FORZAMOS QUE LA CANTIDAD DE FRUTA SELECCIONADA SEA UN NUMERO ENTERO Y ALMACENAMOS LA CANTIDAD
        $accion = $_REQUEST['accion']; //GUARDAMOS QUE OPCION SE HA ELEGIDO SI ANOTAR O TERMINAR
        
        //SI LA ACCION ELEGIDA ES ANOTAR:
        if ($accion === " Anotar ") {

            $_SESSION['frutas'][$frutaSeleccionada] += $cantidad; //SUMAMOS LA CANTIDAD DE FRUTA SELECCIONADA
            $compraRealizada = mostrarPedido($_SESSION['frutas']);
            include_once('./ficheros_plantillas/compra.php');

        } //SI LA ACCION ELEGIDA ES TERMINAR:
        elseif ($accion === " Terminar ") {

            $compraRealizada .= resumenPedido($_SESSION['frutas']);  //CERRAMOS LA LISTA
            include_once('./ficheros_plantillas/despedida.php');

            session_destroy(); //LIMPIAMOS DESTROZANDO LA SESION
        } //SI LA ACCION ELEGIDA ES ANULAR:
        elseif ($accion === " Anular ") {

            $_SESSION['frutas'][$frutaSeleccionada] = 0;
            $compraRealizada = mostrarPedido($_SESSION['frutas']);
            include_once('./ficheros_plantillas/compra.php');

        }
    }
?>