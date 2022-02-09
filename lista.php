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
urldecode($id_grupo);
$id_grupo = base64_decode($id_grupo);

$id_curso = $_GET['id_curso'];
urldecode($id_curso);
$id_curso = base64_decode($id_curso);
 
$cursos = new cursos;
$calificaciones = $cursos->listaCalificaciones($id_curso);
$info_curso = $cursos->mostrarCurso($id_usuario, $id_grupo);
//print_r($calificaciones);
//echo "idgrupo=".$id_grupo;
//echo "idcurso=".$id_curso;
//print_r($info_curso);

foreach ($info_curso as $key => $info) {
    $id_curso_tabla= $info['instanceid'];
    $cursoNombre = $info['fullname'];
    $grupo = $info['name'];
    $nombre_Profesor = $info['firstname'];
    $apellidos_Profesor = $info['lastname'];
    $facultad =  $info['facultad'];
}

$carrera= $cursos->getCarreraCurso($id_curso);


$profesor =  $nombre_Profesor . " " . $apellidos_Profesor;
$cursoArray= array();
$cursoArray[] = ["nombre" => $profesor, "cursoNombre" => $cursoNombre, "grupo"=>$grupo];


$conexionDGAE = new conexionDGAE;
$query = "select * from alumnos";
$listaAlumnos = $conexionDGAE->obtenerDatos($query);
//print_r($listaAlumnos);

$conexionSYS = new conexionSYS;
$variable = '5';
//$conexionSYS->encryption($variable);

//$query = "select *from curso";
//$reporte= $conexionSYS->obtenerDatos($query);
//print_r($reporte);
$nombre = $profesor;
$errorNumeroCuenta="";
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link rel="stylesheet" href="Styles/modal.css"> -->
    <title>SICMCA-Grupos</title>
   <!-- iconos -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--bootstrap 5 local-->
    <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
    <script src="./js/bootstrap/popper.min.js"></script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>
    
    
 
    <!-- data Table-->
    <link rel="stylesheet" href="./dataTable/datatables.css">
    <script src="./dataTable/datatables.js"></script>
    
    <!--data datle bootstrap 5 -->
    <link rel="stylesheet" href="./dataTable/DataTables-1.11.3/css/dataTables.bootstrap5.css">
    <script src="./dataTable/DataTables-1.11.3/js/dataTables.bootstrap5.js"></script>

    <!-- styles -->
    <link rel="stylesheet" href="./Styles/navbar.css">
    <link rel="stylesheet" href="./Styles/styles.css">
    <link rel="stylesheet" href="./Styles/modal.css">
  

    <!-- botones  -->
    <script src="./dataTable/Buttons-2.1.1/js/dataTables.buttons.js"></script>
    <script src="./dataTable/JSZip-2.5.0/jszip.js"></script>
    <script src="./dataTable/pdfmake-0.1.36/pdfmake.js"></script>
    <script src="./dataTable/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="./dataTable/Buttons-2.1.1/js/buttons.html5.js"></script>
     <!-- graficos  -->
     <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.0/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

    <script src="https://cdn.datatables.net/searchpanes/1.2.0/js/dataTables.searchPanes.min.js"></script>

    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.src.js"></script>
</head>

<body>
<?php
    $ruta1 = './profesor/cursos.php';
    $ruta2 = 'profesor.php';
    $ruta3 = 'buscar.php'; 
    $ruta4 = './clases/destroy.php';
    $rutLogo='./img/logo-unam.png';
    $rutLogoF='./img/logo-dgtic.png';
?>
    <?php include('./components/navbar.php');?>
  
    <!--  titulo de la sección  *************************-->
    <div class="container-fluid  titleBox">
        <div class="container mt-3">
            <div class="mt-4 title  rounded">
                <i class="bi bi-journal-bookmark-fill" style="font-size: 50px;"></i>
                <h1><?php echo  $cursoNombre." ".$grupo;?></h1>
            </div>
        </div>
    </div>
    <div class="container-fluid  titleBox">
       <div class="container  d-flex justify-content-start">
            <div class=" titleCurso rounded">
                 <span class="fw-bold">Nombre del profesor:</span> 
                <span><?php echo $profesor ?></span><br>
                <span class="fw-bold">Facultad:</span> 
                <span><?php echo $facultad ?></span><br>
                <span class="fw-bold">Carrera:</span> 
                <span><?php echo $carrera?></span><br>
                <span class="fw-bold">Ciclo Escolar:</span>
                <span>2021-2</span><br> 
            </div>
        </div>
    </div>
       <!-----------Botones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

       <div class="container botonesBox">
        <div class="row ">
            <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-6  d-flex justify-content-evenly " >
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reporteG">Reporte General</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reporteA">Reporte Aprobados</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reporteP">Reporte Reprobados</button>
               
                </div>
            </div> 
            <div class="col-12 col-md-3"></div> 
        </div>

<!-- ********************************************************************************************************************************** -->
  
    <!-----------tabla++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
      <div class="container table-grupoBox">
        <table id="tablaCursos" class="table table-striped table-bordered table-hover " width="100%">
            <thead>
                <tr>
                    <th>Id Curso</th>
                    <th>Nombre <br> del Curso</th>
                    <th>Nombre <br> del Grupo</th>
                   
                    <th>Número de Cuenta</th>
                    <th>Nombre del Alumno</th>
                    <th>Calificación Moodle</th>
                    <th>Calificación Final</th>
                    <th>Aprobado / Reprobado</th>
                    <th>Pendiente / Concluido</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                 <?php
                  $tipo = "";
                  $countPendientes = 0;
                  $countConcluidos = 0;
                  $reprobadosArray = array();
                  $aprobadosArray = array(); 
              
                ?>
                <?php if(isset($calificaciones) && !empty($calificaciones) && sizeof($calificaciones) > 0):?>
                    <?php foreach($calificaciones as $key => $curso):?>
                        <?php
                                $email = $curso['email'];
                                $query = "select * from alumnos  where correo= '$email'";
                                $cuenta =   $conexionDGAE->obtenerCuenta($query);
                                //print_r($cuenta);
                               if (empty($cuenta['numero_cuenta'])) {
                                    $errorNumeroCuenta="Exiten números de cuenta No registrados DGAE";
                                }
                        ?>
                        <?php if ($grupo ==  $curso['name'] && !empty($cuenta['numero_cuenta']) ):?>
                                <?php
                                 $calificacion;
                                 $numero_cuenta = $cuenta['numero_cuenta'];
                                
                                try {
                                    $reporte = $conexionSYS->verificarStatus($id_grupo, $id_curso, $numero_cuenta);
                            
                                     // echo "numero_cuenta = " .$numero_cuenta;
                                  // echo "vALOR = ". $reporte;
                                  if ($reporte) {
                                    $estatus = "Concluido";
                                    $countConcluidos++;
                                    $calificacion = 0;
                                    $result = $conexionSYS->actualizarCalificacion($id_grupo, $id_curso, $numero_cuenta);
                                    $calificacion = $result[0];
                                    $tipo_calificacion = $result[1];
                                  
                                    
                                } else {
                                    $estatus = "Pendiente";
                                    $countPendientes++;
                                    $calificacion = 0;
                                    //$reporte=0;
                                }

                                if ($estatus == "Pendiente") {
                                    $calfinal = $curso['finalgrade'];
                                    $tipo = $conexionSYS->statusAprobados($calfinal);
                                } else {
                                    $calfinal = $calificacion;
                                    $tipo = $conexionSYS->statusAprobados($calfinal);
                                    if ($tipo_calificacion== 1) {
                                        $calificacion="NA";
                                    } else if ($tipo_calificacion== 2){
                                        $calificacion="NP";
                                    } else if ($tipo_calificacion== 3){
                                        $calificacion = round($calificacion, 2);
                                    }
                                }
                                if ($calfinal >= 6) {
                                    $aprobadosArray[] = ["cuenta" => $numero_cuenta, "nombre" => $cuenta['nombre'] . " " . $cuenta['paterno'] . " " . $cuenta['materno'], "calMoodle" => round($curso['finalgrade'], 2), "calFinal" => $calificacion];
                                } else {
                                    $reprobadosArray[] = ["cuenta" => $numero_cuenta, "nombre" => $cuenta['nombre'] . " " . $cuenta['paterno'] . " " . $cuenta['materno'], "calMoodle" => round($curso['finalgrade'], 2), "calFinal" => $calificacion];
                                } 
                                } catch (\Throwable $th) {
                                    //throw $th; 
                                  //  echo $th;
                                }
                         
                        ?>
                          <tr>
                                    <td><?php echo $id_curso_tabla; ?></td>
                                    <td><?php echo $cursoNombre; ?></td>
                                    <td><?php echo $grupo; ?></td>
                                  
                                    <td><?php echo $cuenta['numero_cuenta'] ; ?></td>
                                    <td><?php echo  $cuenta['nombre'] . " " . $cuenta['paterno'] . "<br> " . $cuenta['materno'] ; ?></td>
                                    <td><?php echo $format_number1 = round($curso['finalgrade'], 2); ?></td>
                                    <td><?php echo $calificacion ?></td>
                                    <td><?php echo $tipo ; ?></td>
                                    <td><?php echo $estatus ; ?></td>
                                    <td>
                                    <?php 

                                        $id_curso_code = base64_encode($id_curso);
                                        $id_curso_code= urldecode( $id_curso_code);
                                
                                        $id_grupo_code = base64_encode( $id_grupo);
                                        $id_grupo_code= urldecode($id_grupo_code);

                                        $numero_cuenta_code = base64_encode( $numero_cuenta);
                                        $numero_cuenta_code= urldecode($numero_cuenta_code);

                                        $calfinal_code = base64_encode( $calfinal);
                                        $calfinal_code = urldecode($calfinal_code);

                                        $reporte_code = base64_encode( $reporte);
                                        $reporte_code = urldecode($reporte_code);
                                      
                                    ?>
                                        <a href="cargar.php?id_curso=<?php echo $id_curso_code?>&id_grupo=<?php echo $id_grupo_code?>&numero_cuenta=<?php echo $numero_cuenta_code;?>&cal=<?php echo $calfinal_code;?>&r=<?php echo $reporte_code;?>" class="btn btn-primary" type="button">Subir Calificación</a>
                                    </td>
                            </tr>
                        <?php endif?>
                    <?php endforeach?>
                <?php endif?>
                <?php
                 $curso_Aprobados = $conexionSYS->getAprobados();
                 $curso_Reprobados = $conexionSYS->getReprobados();
                 $total_alumnos = $conexionSYS->getTotalAlumnos();
                 $califcacionesArray = $conexionSYS->getCalificacionesArray();
                 $promedio_Curso = $conexionSYS->promedioCurso($califcacionesArray);
                 $conexionSYS->setReprobadosArray($reprobadosArray);
              
                 // print_r($aprobadosArray); 
                ?>
            </tbody>
        </table>
        
    </div>
<?php

 /*  
if (!empty($errorNumeroCuenta)) {
    echo '<script type="text/javascript"> window.alert("Exiten números de cuenta No registrados DGAE"); </script>';    
}*/

?>

        <?php include('./components/reporteGeneral.php');?>
        <?php include('./components/reporteAprobados.php');?>
        <?php include('./components/reporteReprobados.php');?>

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
                  <!--   <a  style="text-decoration:none" type="button" name="exportarR" class="button " id="exportarR" href="#" target=""  >Exportar</a> -->
                    <button type="button" name="exit" class="button" id="exit">Cerrar</button>
                </div>
            </div>
            <div class="modal-footer">
                <h3 style="text-align: center;">UNAM</h3>
            </div>
        </div>
    </div>
  <!-- contenedor -->
  <div class="container container_grafica_grupo">
        <div class="row justify-content-center grafica_row">
             <div class="col-12">
                 <div id="contenedor" class="">

                </div>
            </div>
        </div>
    </div>


    <?php include('./components/footer.php');?>
    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
   
    <script src="./js/modalAprobados.js"></script>
    <script src="./js/modalReprobados.js"></script>
    <script src="./js/modalReporte.js"></script>
    <script src="./js/grupoProfesor.js"></script>
</body>

</html>