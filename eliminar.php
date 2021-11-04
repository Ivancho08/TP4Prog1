<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioAlumno.php';

session_start();
if (isset($_SESSION['usuario']) && isset($_GET['n'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $ra = new RepositorioAlumno();
    $alumno = $ra->get_one($_GET['n']);
    $ra->delete($alumno);
    header("Location: home.php?mensaje=El alumno fue eliminado con éxito");


} else {
    header('Location: index.php');
}
?>