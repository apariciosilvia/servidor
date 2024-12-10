<?php

class biciElectrica
{
    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $bateria; // Carga de la batería en tanto por ciento (entero)
    private $operativa; // Estado de la bicleta ( true operativa- false no disponible)

    public function __construct(int $id, int $coordx, int $coordy, int $bateria, bool $operativa) {
        $this -> id = $id;
        $this -> coordx = $coordx;
        $this -> coordy = $coordy;
        $this -> bateria = $bateria;
        $this -> operativa = $operativa;
    }

    public function __get($nombre) {
        return $this->$nombre;
    }

    public function __set($nombre, $valor) {
        $this->$nombre = $valor;
    }

    public function __toString() {
        return "Identificador: " . $this->id . " Bateria: " . $this->bateria;
    }

    public function distancia($x, $y) {
        $coordx = $this->coordx;
        $coordy = $this->coordy;
    
        // Aplicamos la fórmula de la distancia euclidiana
        //sqrt --> calcula la raiz cuadrada
        //pow -->  calcular un número elevado a una potencia
        return $distancia = sqrt(pow($x - $coordx, 2) + pow($y - $coordy, 2));
    }
}
