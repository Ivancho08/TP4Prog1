<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioAlumno.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $ra = new RepositorioAlumno();
    $listaFecha = $ra->traerFechas($usuario);

    $listaEdades = array();
    $sumaEdades = 0;
    for($i=0; $i < count($listaFecha); $i++){
        $listaEdades[$i] =date("Y") - date("Y", strtotime($listaFecha[$i]));
    }

    for($i = 0; $i < count ($listaEdades); $i++){
        $sumaEdades = $sumaEdades + $listaEdades[$i];
    }

    $promedioEdades = floor($sumaEdades/count($listaEdades));
    
    echo "El promedio de edades es de: $promedioEdades años";
    


}



?>