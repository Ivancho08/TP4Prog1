<?php
require_once 'clases/Usuario.php';

class Alumno
{
    protected $dni;
    protected $nombre;
    protected $apellido;
    protected $fecha_nac;
    protected $id;

    public function __construct ($dni, $nombre, $apellido, $fecha_nac, $id = null){

        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nac = $fecha_nac;
        $this->id = $id;
    }

    public function getDni(){
        return $this->dni;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getFecha(){
        return $this->fecha_nac;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($i){
        $this->id = $i;
    }

}