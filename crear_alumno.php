<?php
require_once 'clases/Usuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
} else {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dar Alta Alumno</title>
</head>
<body>
    <h1>Datos Alumno</h1>
    <form action="nuevo_alumno.php" method="post">
       <label for="dni">DNI</label>
       <input type="number" name="dni" id="dni">
       <label for="nombre">NOMBRE</label> 
       <input type="text" name="nombre" id="nombre">
       <label for="apellido">APELLIDO</label>
       <input type="text" name="apellido" id="apellido">
       <label for="fecha_nac">FECHA DE NACIMIENTO</label>
       <input type="date" name="fecha_nac" id="fecha_nac">
       <input type="submit" value="Crear Alumno">
    </form>
    
</body>
</html>