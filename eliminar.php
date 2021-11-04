<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioAlumno.php';

session_start();
if (isset($_SESSION['usuario']) && isset($_GET['n'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $rc = new RepositorioAlumno();
    $cuenta = $rc->get_one($_GET['n']);
    $rc->delete($alumno);
    header("Location: home.php?mensaje=El alumno fue eliminado con éxito");


} else {
    header('Location: index.php');
}
?>