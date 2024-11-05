<?php
function usuarioOk($usuario, $contraseña) :bool {
  
   // strlen --> devuelve la longitud de una cadena
   if (strlen($usuario) < 8) {
      return false;
  }

  // strrev --> coge el texto y devuelve su versión invertida
  $usuarioReverso = strrev($usuario);

  // verificamos que la contraseña sea igual al nombre de usuario al revés
  return ($contraseña === $usuarioReverso);
    
}

function letraMasRepetida($texto) {
   $texto = strtolower(preg_replace("/[^a-zA-Z]/", "", $texto)); 
   $frecuencias = count_chars($texto, 1); 
   arsort($frecuencias); // arsort --> ordena por frecuencia en orden descendente
   $letraMasComun = chr(array_key_first($frecuencias)); 
   return $letraMasComun;
}

function palabraMasRepetida($texto) {
   $palabras = str_word_count(strtolower($texto), 1); // strtolower --> convierte a minúsculas 
                                                      // str_word_count --> divide en palabras
   $frecuencias = array_count_values($palabras);
   arsort($frecuencias); 
   $palabraMasComun = array_key_first($frecuencias); 
   return $palabraMasComun;
}