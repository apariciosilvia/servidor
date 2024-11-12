<?php

//EL INDEX NO HAY QUE TOCARLO PARA NADA EXCEPTO PARA LA ULTIMA PARTE DEL EJERCICIO QUE VALE 2 PUNTOS
session_start();

include_once('app/funciones.php');


if (!isset($_SESSION['intentos'])) {
  $_SESSION['intentos'] = 0; //SI NO EXISTE LA VARIABLE INTENTOS, LAA INICIALIZAMOS A 0
}

if (  !empty( $_GET['login']) && !empty($_GET['clave'])){
    if ( userOk($_GET['login'],$_GET['clave'])){ //SI LOS DATOS SON CORRECTOS

      $_SESSION['intentos'] = 0;

      if ( getUserRol($_GET['login']) == ROL_PROFESOR){
        $contenido = verNotaTodas($_GET['login']);
      } else {
        $contenido = verNotasAlumno($_GET['login']);
      }
      include_once ('app/resultado.php');
    } 
    // userOK falso
    else { // SI LOS DATOS SON INCORRECTOS
      $_SESSION['intentos']++;

      if ($_SESSION['intentos'] >= 5) {
          $contenido = "<center><b>Superado el número máximo de accesos erróneos</b><hr>Reinicie el navegador para volver a intentarlo</center>";
          include_once('app/intentos.php');
          exit; 
      } else {
          $contenido = "El número de usuario y la contraseña no son válidos.";
          include_once('app/acceso.php');
      }
      
    }
} else {
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
}
