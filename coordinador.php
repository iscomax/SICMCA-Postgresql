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
    <title>Coordinador</title>
    <link rel="stylesheet" href="./Styles/styles.css">
    <style>
        table th {
                 text-align: center;
        }
    </style>
</head>

<body>
    <div id="navbar">
        <ul>
            <li></li>
            <li><?php echo " <a href='./coordinador/cursos.php'>Cursos</a>" ?></li>
            <li><?php echo " <a href='coordinador.php'>Grupos</a>" ?></li>
            <li><a href="./coordinador/bitacora.php">Bitácora</a></li>
            <li style="float:right"><a class="active" href="./clases/destroy.php">Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="titulos">
    <h1>Grupos</h1>
    </div>
    <div class="containerTAB">
        <table class="paleBlueRows"  id="datatable">
            <thead >
                <tr>
                    <th >Id Curso</th>
                    <th>Nombre del Curso</th>
                    <th>Nombre del Grupo</th>
                    <th>Nombre del Profesor</th>
                    <th>Pendientes <br> por Calificar</th>
                    <th>Calificados</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php
                try {
                    if (isset($listaCursos) && !empty($listaCursos) && sizeof($listaCursos) > 0) {
                        foreach ($listaCursos as $key => $curso) {
                            //echo $curso["instanceid"] . "-" . $curso["fullname"] . "-" .  $curso["firstname"] . "-" . $curso["lastname"] . "<br/>";
                            $id_curso = $curso['instanceid'];
                            $id_grupo =$curso['id'];
                            $numeroA =$vista_Coord->numeroAlumnos($id_grupo,$id_curso);
                            $numeroC=$conexionSYS->numeroCalificados($id_grupo);
                             //echo "total concluidos= ". $numeroC;
                            //echo "total de alumnos= ". $numeroA;
                            $pendientes = $numeroA-$numeroC;
                            echo
                            '
            <tr>
                <td>' . $curso['instanceid'] . '</td>
                <td>' . $curso['fullname'] . '</td>
                <td>' . $curso['name'] . '</td>
                <td>' . $curso['firstname'] . " " . $curso['lastname'] . '</td>
                <td>'.$pendientes.'</td>
                <td>'.$numeroC.'</td>
                <td>
                <a href="listaTotal.php?id_grupo=' . $curso['id'] . '&id_curso=' . $curso['instanceid'] . '&id_profesor=' . $curso['idp'] . '" class="button" type="button">Ver Grupo </a>
                        
                </td>
               
            </tr>
                        
            ';
                        }
                    }
                } catch (Exception $ex) {
                    //throw $th;
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>