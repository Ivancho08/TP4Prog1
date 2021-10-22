<?php
require_once 'clases/Usuario.php';
require_once 'clases/Alumno.php';
require_once 'clases/RepositorioAlumno.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    //Crear alumno
    $alumno = new Alumno($_POST['dni'], $_POST['nombre'], $_POST['apellido'], $_POST['fecha_nac']);
    $ra = new RepositorioAlumno();
    $id = $rc->store($alumno);
    if($id === false){
        header('Location: home.php?mensaje=Error al crear el Alumno');
    } else {
        $alumno->setId($id);
        header('Location: home.php?mensaje=Alumno creado exitosamente');
    }


} else {
    header('Location: index.php');
}
?>

