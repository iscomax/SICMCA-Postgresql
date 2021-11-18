
<?php 
session_start();
if (isset($_SESSION['login'])) {
} else {
    header("location: index.php");
}
require('../conexion/conexion.php');
require('../clases/cursos.php');
require('../conexion/conexionSYS.php');
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
            <li></li>
            <li><?php echo " <a href=''>Cursos</a>" ?></li>
            <li><?php echo " <a href='../coordinador.php'>Grupos</a>" ?></li>
            <li><a href="bitacora.php">Bitácora</a></li>
            <li style="float:right"><a class="active" href="../clases/destroy.php">Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="titulos">
    <h1>Cursos</h1>
    </div>
    <div class="containerTAB">
        <table class="paleBlueRows" id="datatable">
            <thead>
                <tr>
                    <th>Id Curso</th>
                    <th>Nombre del Curso</th>
                    <th>Nombre del Profesor</th> 
                </tr>
            </thead>

            <tbody>
                <?php if (isset($listaCursos) && !empty($listaCursos) && sizeof($listaCursos) > 0): ?>
                  <?php foreach ($listaCursos as $key => $curso): ?>
                    <?php $id_curso = $curso['instanceid'];
                            $id_grupo =$curso['id'];
                            $numeroA =$vista_Coord->numeroAlumnos($id_grupo,$id_curso);
                            $numeroC=$conexionSYS->numeroCalificados($id_grupo);
                    ?>
                    <tr>
                        <td><?php echo $curso['instanceid'] ?></td>
                        <td><?php echo  $curso['fullname'] ?></td>
                        <td> <?php echo $curso['firstname']." ".$curso['lastname'] ?> </td>   
                    </tr>
                  <?php endforeach?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>
</html>