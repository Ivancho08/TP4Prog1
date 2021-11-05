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
        $profesor = $alumno->getProfesor();

        $q = "INSERT INTO alumnos (dni, nombre, apellido, fecha_nac, profesor) VALUES (?, ?, ?, ?, ?)";
        try{
            $query = self::$conexion->prepare($q);

            $query->bind_param("isssi", $dni, $nombre, $apellido, $fecha_nac, $profesor);

            if ($query->execute()){
                return self::$conexion->insert_id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_all(Usuario $usuario){

        $idUsuario = $usuario->getId();
        $q = "SELECT dni, nombre, apellido, fecha_nac FROM alumnos WHERE profesor = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $idUsuario);
            $query->bind_result($dni, $nombre, $apellido, $fecha_nac);

            if ($query->execute()) {
                $listaAlumnos = array();
                while ($query->fetch()) {
                    $listaAlumnos [] = new Alumno($dni,$nombre,$apellido,$fecha_nac);
                }
                return $listaAlumnos;
            }
            return false;
        } catch (Exception $e){
            return false;
        }

    }


    public function get_one($dni){

        
        $q = "SELECT  nombre, apellido, fecha_nac FROM alumnos WHERE dni = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $dni);
            $query->bind_result($nombre, $apellido, $fecha_nac);

            if ($query->execute()) {
                if($query->fetch()){
                    return new Alumno ($dni,$nombre,$apellido,$fecha_nac);
                }
            }
            return false;
        } catch (Exception $e){
            return false;
        }

    }


    public function delete (Alumno $alumno){

        $n = $alumno->getDni();
        $q = "DELETE FROM alumnos WHERE dni = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $n);
        return ($query->execute());
    }




    public function traerFechas(Usuario $usuario){

        $idUsuario = $usuario->getId();
        $q = "SELECT fecha_nac FROM alumnos WHERE profesor = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $idUsuario);
            $query->bind_result($fecha_nac);

            if ($query->execute()) {
                $listaFechas = array();
                while ($query->fetch()) {
                    $listaFechas [] = $fecha_nac;
                }
                return $listaFechas;
            }
            return false;
        } catch (Exception $e){
            return false;
        }

    }
}