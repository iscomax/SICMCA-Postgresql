<?php 
session_start();
if (isset($_SESSION['login'])) {
} else {
    header("location: index.php");
}
require('./conexion/conexion.php');
require('./clases/cursos.php');
require('./conexion/conexionSYS.php');

try {
    $vista_Coord = new cursos;
    $vista_Coord->totalCursos();
    $listaCursos = $vista_Coord->totalCursos();

    $conexionSYS = new conexionSYS();
    //print_r($listaCursos);
} catch (Exception $ex) {
    //throw $th;
}



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="../Styles/styles.css">
</head>
<body>
<div id="navbar">
        <ul>
            <li>Coordinador</li>
            <li><?php echo " <a href=''>Cursos</a>" ?></li>
            <li><?php echo " <a href='../coordinador.php'>Grupos</a>" ?></li>
            <li><a href="./coordinador/bitacora.php">Bitácora</a></li>
            <li style="float:right"><a class="active" href="../clases/destroy.php">Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="titulos">
    <h1>Cursos</h1>
    </div>
</body>
</html>