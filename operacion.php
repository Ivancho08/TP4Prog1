<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioAlumno.php';

session_start();
if (isset($_SESSION['usuario']) && isset($_POST['nombre'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $ra = new RepositorioAlumno();
    $alumno = $ra->get_one($_POST['dni']);

    $respuesta['dni'] = $alumno->getDni();
    $respuesta
    $r = $alumno->modificar($_POST['nombre']);

    if ($r){
        $ra->actualizarNombre($alumno);
        $respuesta['resultado'] = "OK";
    } else {
        $respuesta['resultado'] = "Error al realizar la operacion";
    }

    $respuesta['dni'] = $alumno->getDni();
    $respuesta['nombre'] = $alumno->getNombre();
    echo json_encode($respuesta);
    



}