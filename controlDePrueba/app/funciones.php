<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login,$clave):bool {
    global $usuarios;
    $comprobacion = false;
    foreach ($usuarios as $numUser => $datosUser) {
        if($login == $numUser && $clave == $datosUser[1]){
            $comprobacion = true;
        }
    }
    return $comprobacion;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;
    
    return $usuarios[$login][2];
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido/a alumno/a: " .$usuarios[$codigo][0];
    $msg .= "<hr>";
    $msg .= "<table><tr><th>Modulo</th><th>Nota</th></tr>";

    foreach ($notas as $numUser => $datosNotas) {
        if($codigo = $numUser){
            $msg .= "<tr><th>".$nombreModulos[0]. "</th>";
            $msg .= "<th>".$notas[$codigo][0]."</th></tr>";
        }
    }
    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    

    $msg .= " Bienvenido Profesor: ".$usuarios[$codigo][0] ;
    $msg .= "<hr>";
    $msg .= "<table><tr><th>Nombre</th>";

    for($cont=0; $cont< count($nombreModulos); $cont++){
        $msg .= " <th>".$nombreModulos[$cont]."</th>";
    }
    $msg .= "<tr>";
    foreach ($usuarios as $numUser => $datosUser)  {
        if($usuarios[$numUser][2] != ROL_PROFESOR){
            $msg .= "<tr> <th>".$datosUser[0]."</th>" ; 

            foreach ($notas as $numUserNotas => $datosNotas) {

                if($numUser == $numUserNotas ){
                    for($cont = 0; $cont < count($datosNotas); $cont++){
                        $msg .= "<th>".$datosNotas[$cont]."</th>" ;
                    }
                    $msg .="</tr>";
                }
            }
            
        } 
    }
    $msg .= "</table>";
    return $msg;
}