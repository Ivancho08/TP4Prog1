<?php
require_once 'clases/Usuario.php';
require_once 'clases/Alumno.php';
require_once 'clases/RepositorioAlumno.php';


session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $rc = new RepositorioAlumno();
    $alumnos = $rc->get_all($usuario);


} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Sistema Alta Alumnos</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema Alta Alumnos</h1>
      </div>    
      <div class="text-center">
        <?php
        if (isset($_GET['mensaje'])) {
          echo '<p class="alert alert-primary">'.$_GET['mensaje'].'</p>';
        }
        ?>
        <h3> <?php echo $nomApe;?></h3>
        <h3>Listado de Alumnos</h3>
        <table class="table table-striped">
            <tr>
                <th>DNI</th><th>Nombre</th><th>Apellido</th><th>Fecha de Nacimiento</th><th>Modificar</th><th>Eliminar</th>
            </tr>
        <?php
        if (count($alumnos)==0){
          echo "<tr><td colspan='5'>No tiene alumnos a cargo</td></tr>";
        } else {
          foreach($alumnos as $unAlumno) {
            $n = $unAlumno->getDni();
            echo '<tr>';
            echo "<td>$n</td>";
            echo "<td>".$unAlumno->getNombre()."</td>";
            echo "<td>".$unAlumno->getApellido()."</td>";
            echo "<td>".$unAlumno->getFecha()."</td>";
            echo "<td><button type='button' onclick='modificar($n)'>Modificar</button></td>";
            echo "<td><a href='eliminar.php?n=$n'>Eliminar</a></td>";
            echo '</tr>';
          }
        }
        ?>
        </table>

        <a class="btn btn-primary" href="crear_alumno.php">Crear Nuevo Alumno</a>
        <p><a href="logout.php">Cerrar sesión</a></p>
      </div> 
    </body>
</html>