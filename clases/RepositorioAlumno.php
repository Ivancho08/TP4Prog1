<?php
require_once '.env.php';
require_once 'clases/Usuario.php';
require_once 'clases/Alumno.php';

class RepositorioAlumno {

    private static $conexion = null;
    
    public function __construct(){

        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }



    public function store(Alumno $alumno){

        $dni = $alumno->getDni();
        $nombre = $alumno->getNombre();
        $apellido = $alumno->getApellido();
        $fecha_nac = $alumno->getFecha();

        $q = "INSERT INTO alumnos (dni, nombre, apellido, fecha_nac) VALUES (?, ?, ?, ?)";
        try{
            $query = self::$conexion->prepare($q);

            $query->bind_param("isss", $dni, $nombre, $apellido, $fecha_nac);

            if ($query->execute()){
                return self::$conexion->insert_id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}