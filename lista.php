<?php
require('./conexion/conexion.php');
require('./conexion/conexionSYS.php');
require('./conexion/conexionDGAE.php');
require('./clases/cursos.php');
session_start();
if (isset($_SESSION['login'])) {
    $id = $_SESSION['id_usuario'];
} else {
    header("location: index.php");
}
$id_usuario =   $_SESSION['id_usuario'];
$id_grupo = $_GET['id_grupo'];
$id_curso = $_GET['id_curso'];

$cursos = new cursos;
$calificaciones = $cursos->listaCalificaciones($id_curso);
$info_curso = $cursos->mostrarCurso($id_usuario, $id_grupo);
//print_r($calificaciones);
//echo "idgrupo=".$id_grupo;
//echo "idcurso=".$id_curso;
//print_r($info_curso);

foreach ($info_curso as $key => $info) {
    $cursoNombre = $info['fullname'];
    $grupo = $info['name'];
    $nombre_Profesor = $info['firstname'];
    $apellidos_Profesor = $info['lastname'];
}

$profesor =  $nombre_Profesor . " " . $apellidos_Profesor;

$cursoArray= array();
$cursoArray[] = ["nombre" => $profesor, "cursoNombre" => $cursoNombre, "grupo"=>$grupo];

//echo "ID= ".$id_usuario;
$conexionDGAE = new conexionDGAE;
$query = "select * from alumnos";
$listaAlumnos = $conexionDGAE->obtenerDatos($query);

$conexionSYS = new conexionSYS;
//$query = "select *from curso";
//$reporte= $conexionSYS->obtenerDatos($query);
//print_r($reporte);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/styles.css">
    <link rel="stylesheet" href="Styles/modal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>

</head>

<body>

    <div id="navbar">
        <ul>
            <li><?php echo " <a href='profesor.php?id_usuario=$id_usuario'>Cursos</a>" ?></li>
            <li><a href="#news">Grupos</a></li>
            <li><?php echo " <a href='buscar.php?id_usuario=$id_usuario&id_grupo=$id_grupo&id_curso=$id_curso'>Buscar</a>" ?></li>
            <li style="float:right"><a class="active" href="./clases/destroy.php">Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="titulos">
        <h1>Grupo</h1>
    </div>
    <div class="containerTAB">
        <table class="paleBlueRows" id="datatable">
            <thead>
                <tr>
                    <th>Id Curso</th>
                    <th>Nombre del Curso</th>
                    <th>Nombre del Grupo</th>
                    <th>Nombre del Profesor</th>
                    <th>Número de Cuenta</th>
                    <th>Nombre del Alumno</th>
                    <th>Califiación Moodle</th>
                    <th>Califiación Final</th>
                    <th>Aprobado / <br>Reprobado</th>
                    <th>Pendiente / Concluido</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php

                try {
                    $tipo = "";
                    $countPendientes = 0;
                    $countConcluidos = 0;
                    $reprobadosArray = array();
                    $aprobadosArray = array();
                    if (isset($calificaciones) && !empty($calificaciones) && sizeof($calificaciones) > 0) {
                        foreach ($calificaciones as $key => $curso) {

                            $email = $curso['email'];
                            $query = "select * from alumnos  where correo= '$email'";
                            if (is_null($query)) {
                                echo "no existe numero de cuenta ";
                            }
                           $cuenta =   $conexionDGAE->obtenerCuenta($query);
                            if ($grupo ==  $curso['name']) {
                                $calificacion;
                                $numero_cuenta = $cuenta['numero_cuenta'];

                                $reporte = $conexionSYS->verificarStatus($id_grupo, $id_curso, $numero_cuenta);
                                // echo "numero_cuenta = " .$numero_cuenta;
                                // echo "vALOR = ". $reporte;
                                if ($reporte) {
                                    $estatus = "Concluido";
                                    $countConcluidos++;
                                    $calificacion = 0;
                                    $calificacion = $conexionSYS->actualizarCalificacion($id_grupo, $id_curso, $numero_cuenta);
                                    //  echo "calificacion: ". $calificacion;
                                } else {
                                    $estatus = "Pendiente";
                                    $countPendientes++;
                                    $calificacion = 0;
                                }

                                if ($estatus == "Pendiente") {
                                    $calfinal = $curso['finalgrade'];
                                    $tipo = $conexionSYS->statusAprobados($calfinal);
                                } else {
                                    $calfinal = $calificacion;
                                    $tipo = $conexionSYS->statusAprobados($calfinal);
                                }
                                if ($calfinal >= 6) {
                                    $aprobadosArray[] = ["cuenta" => $numero_cuenta, "nombre" => $cuenta['nombre'] . " " . $cuenta['paterno'] . " " . $cuenta['materno'], "calMoodle" => round($curso['finalgrade'], 2), "calFinal" => $calificacion];
                                } else {
                                    $reprobadosArray[] = ["cuenta" => $numero_cuenta, "nombre" => $cuenta['nombre'] . " " . $cuenta['paterno'] . " " . $cuenta['materno'], "calMoodle" => round($curso['finalgrade'], 2), "calFinal" => $calificacion];
                                }
                                // echo $curso["courseid"] . "-" . $curso["fullname"] . "-" .  $curso["firstname"] . "-" . $curso["lastname"] . "<br/>";
                                echo
                                '
                            <tr>
                                <td>' . $id_curso . '</td>
                                <td>' . $cursoNombre . '</td>
                                <td>' . $grupo . '</td>
                                <td>' . $nombre_Profesor . " " . $apellidos_Profesor . '</td>
                                <td>
                                ' . $cuenta['numero_cuenta'] . '
                                </td>
                                <td> ' . $cuenta['nombre'] . " " . $cuenta['paterno'] . " " . $cuenta['materno'] . '</td>
                                <td> ' . $format_number1 = round($curso['finalgrade'], 2) . '</td>
                                <td> ' . $format_number1 = round($calificacion, 2) . '</td>
                                <td>' . $tipo . '</td>
                                <td>' . $estatus . '</td>
                                <td>
                                <a href="cargar.php?id_curso=' . $id_curso . '&id_grupo=' . $id_grupo . '&numero_cuenta=' . $numero_cuenta . '&cal=' . $calfinal . '&r=' . $reporte . '" class="button" type="button">Subir Calificación</a>
                                </td>
                            </tr>
                            ';
                            }
                        }
                    }
                    $curso_Aprobados = $conexionSYS->getAprobados();
                    $curso_Reprobados = $conexionSYS->getReprobados();
                    $total_alumnos = $conexionSYS->getTotalAlumnos();
                    $califcacionesArray = $conexionSYS->getCalificacionesArray();
                    $promedio_Curso = $conexionSYS->promedioCurso($califcacionesArray);
                    $conexionSYS->setReprobadosArray($reprobadosArray);
                 
                    // print_r($aprobadosArray);
                } catch (Exception $ex) {
                    //throw $th;
                }

                ?>
            </tbody>
        </table>
        <div>
            <!-----------Botones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <?php
            echo "<a href='profesor.php?id_usuario=$id_usuario' class='button buttonRegresar' type='button'> Regresar</a>";
            ?>
            
            <!-- abrir modal -->
            <button type="button" class="button" id="myBtn">Reporte General</button>
            <!-- abrir modal -->
            <button type="button" class="button" id="lista">Reporte  Aprobados</button>
            <!-- abrir modal -->
            <button type="button" class="button" id="listaR">Reporte Reprobados </button>

            <link rel="" href="">

        </div>
    </div>
    <!-- Modal reporte General++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div id="myModal" class="modal">
        <!-- contenido modal -->
        <div class="modal-content-reporte">
            <div class="modal-header">
                <span class="close ">&times;</span>
                <h2 style="text-align: center;">Reporte General de Calificaciones</h2>
            </div>
            <div class="modal-body">
           

                <table class="paleBlueRows" id="datatable">
                    <tbody>
                        <tr>
                            <td>Nombre del Profesor</td>
                            <td><?php echo $nombre_Profesor . " " . $apellidos_Profesor ?></td>
                        </tr>
                        <tr>
                            <td>Nombre del Curso</td>
                            <td><?php echo $cursoNombre ?></td>
                        </tr>
                        <tr>
                            <td>Nombre Grupo</td>
                            <td><?php echo $grupo ?></td>
                        </tr>
                        <tr>
                            <td>Número de Alumnos</td>
                            <td><?php echo $total_alumnos ?></td>
                        </tr>
                        <tr>
                            <td>Alumnos Aprobados</td>
                            <td><?php echo $curso_Aprobados ?></td>
                        </tr>
                        <tr>
                            <td>Alumnos Reprobados</td>
                            <td><?php echo $curso_Reprobados ?></td>
                        </tr>
                        <tr>
                            <td>Promedio de calificación por curso</td>
                            <td><?php echo $promedio_Curso ?></td>
                        </tr>
                        <tr>
                            <td>Calificaciones Pendientes</td>
                            <td><?php echo $countPendientes ?></td>
                        </tr>
                        <tr>
                            <td>Calificaciones Concluidas</td>
                            <td><?php echo $countConcluidos ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="buttonReporte">
                        <?php 
                            $generalArray[] = ["alumnos" => $total_alumnos,"aprobados" => $curso_Aprobados,"reprobados" => $curso_Reprobados,
                            "promedio" => $promedio_Curso,"pendientes" => $countPendientes,"concluidos" => $countConcluidos];
                            $data =  base64_encode(serialize($generalArray));
                            $data= urldecode($data);
                            $dataP= base64_encode(serialize($cursoArray));
                            $dataP= urldecode($dataP);
                        ?>
                    <a type="button" name="exportar" class="button " id="exportar" href="#" target="">Exportar</a>
           
                    <button type="button" name="cerrar" class="button" id="cerrar">Cerrar</button>
                </div>
            </div>
            <div class="modal-footer">
                <h3 style="text-align: center;">UNAM</h3>
            </div>
        </div>
    </div>
    <!-- Modal reporte aprobados++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div id="aprobados" class="modal">
        <!-- contenido modal -->
        <div class="modal-content-reporte">
            <div class="modal-header">
                <span class="close aprobadosCerrar">&times;</span>
                <h2 style="text-align: center;">Reporte Alumnos Aprobados</h2>
            </div>
            <div class="modal-body">
                <table class="paleBlueRows" id="datatable" style="margin-top: 3%;">
                    <tbody>
                        <tr>
                            <td> Nombre del Profesor</td>
                            <td><?php echo $nombre_Profesor . " " . $apellidos_Profesor ?></td>
                        </tr>
                        <tr>
                            <td>Nombre del Curso</td>
                            <td><?php echo $cursoNombre ?></td>
                        </tr>
                        <tr>
                            <td>Nombre del Grupo</td>
                            <td><?php echo $grupo ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="paleBlueRows" id="datatable" style="margin-top: 4%;">
                    <tbody>
                        <tr>
                            <td><strong>Número de Cuenta</strong></td>
                            <td> <strong>Nombre del Alumno</strong> <strong></strong> </td>
                            <td> <strong>Calificación Moodle</strong> <strong></strong> </td>
                            <td> <strong>Califiación Final</strong><strong></strong> </td>
                        </tr>

                        <?php foreach ($aprobadosArray  as $key => $alumno) : ?>
                            <tr>
                                <td><?php echo $alumno['cuenta'] ?></td>
                                <td><?php echo $alumno['nombre'] ?></td>
                                <td><?php echo $alumno['calMoodle'] ?></td>
                                <td><?php echo $alumno['calFinal'] ?></td>

                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
                <div class="buttonReporte">
                         <?php 
                            $data =  base64_encode(serialize($aprobadosArray));
                            $data= urldecode($data);
                            $dataP= base64_encode(serialize($cursoArray));
                            $dataP= urldecode($dataP);
                        ?>
                       <!--./reportesPDF/reporteAprobados.php?data=<?php echo $data?>&dataP=<?php echo $dataP?>-->  
                    <a type="button" name="exportarA" class="button " id="exportarA" href="#" target="">Exportar</a>
                    <button type="button" name="salir" class="button" id="salir">Cerrar</button>
                </div>
            </div>
            <div class="modal-footer">
                <h3 style="text-align: center;">UNAM</h3>
            </div>
        </div>
    </div>
    <!-- Modal reporte reprobrados++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div id="reprobados" class="modal">
        <!-- contenido modal -->
        <div class="modal-content-reporte">
            <div class="modal-header">
                <span class="close reprobadosCerrar">&times;</span>
                <h2 style="text-align: center;">Reporte Alumnos Reprobados</h2>
            </div>
            <div class="modal-body">
            <table class="paleBlueRows" id="datatable" style="margin-top: 3%;">
                    <tbody>
                        <tr>
                            <td>Nombre del Profesor</td>
                            <td><?php echo $nombre_Profesor . " " . $apellidos_Profesor ?></td>
                        </tr>
                        <tr>
                            <td>Nombre del Curso</td>
                            <td><?php echo $cursoNombre ?></td>
                        </tr>
                        <tr>
                            <td>Nombre del Grupo</td>
                            <td><?php echo $grupo ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="paleBlueRows" id="datatable" style="margin-top: 4%;">
                    <tbody>
                        <tr>
                            <td><strong>Número de Cuenta</strong></td>
                            <td> <strong>Nombre del Alumno</strong> <strong></strong> </td>
                            <td> <strong>Califiación Moodle</strong> <strong></strong> </td>
                            <td> <strong>Califiación Final</strong><strong></strong> </td>
                        </tr>

                        <?php foreach ( $reprobadosArray  as $key => $alumno) : ?>
                            <tr>
                                <td><?php echo $alumno['cuenta'] ?></td>
                                <td><?php echo $alumno['nombre'] ?></td>
                                <td><?php echo $alumno['calMoodle'] ?></td>
                                <td><?php echo $alumno['calFinal'] ?></td>

                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
                <div class="buttonReporte">
                        <?php 
                            $data =  base64_encode(serialize($reprobadosArray));
                            $data= urldecode($data);
                            $dataP= base64_encode(serialize($cursoArray));
                            $dataP= urldecode($dataP);
                        ?>
                        <!--./reportesPDF/reporteReprobados.php?data=<?php echo $data?>&dataP=<?php echo $dataP?>-->
                    <a  style="text-decoration:none" type="button" name="exportarR" class="button " id="exportarR" href="#" target=""  >Exportar</a>
                    <button type="button" name="exit" class="button" id="exit">Cerrar</button>
                </div>
            </div>
            <div class="modal-footer">
                <h3 style="text-align: center;">UNAM</h3>
            </div>
        </div>
    </div>
    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

    <script src="./js/modalAprobados.js"></script>
    <script src="./js/modalReprobados.js"></script>
    <script src="./js/modalReporte.js"></script>
    <script src="./js/reportes.js"></script>
</body>

</html>