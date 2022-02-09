<?php 
require('../conexion/conexion.php');
require('../conexion/conexionSYS.php');
require('../conexion/conexionDGAE.php');
require('../clases/cursos.php');
session_start();
if(isset($_SESSION['login'])){ 
    $id_usuario = $_SESSION['id_usuario']; 
}else{
  header("location: index.php");
}
try {
    $id_curso= $_GET['id_curso'];
    urldecode($id_curso);
    $id_curso = base64_decode($id_curso);

    $id_profesor= $_GET['id_profesor'];
    urldecode($id_profesor);
    $id_profesor_lim = base64_decode($id_profesor);

    $curso_Grupos = new cursos();
    $listaCursos = $curso_Grupos->mostrarGrupos($id_profesor_lim,$id_curso);
   $nombre_curso= $curso_Grupos->getNombreCurso();

    foreach ($listaCursos as $key => $curso) {
        $facultad = $curso['facultad']; 
        $nombre_Profesor = $curso['firstname'] . " " . $curso['lastname'];
    }

    $conexionSYS = new conexionSYS();
    $datosUsuario= $conexionSYS->obtnerUsuario($id_usuario);
    //print_r($datosUsuario);
    foreach ($datosUsuario as $key => $dato) {
        $nombre = $dato['nombre']." ". $dato['apellidos'];
    }

    
} catch (Exception $ex) {
    //throw $th;
}

$ciclo="2021-2";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SICMCA-Cursos</title>
     <!-- iconos -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--bootstrap 5 local-->
    <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
    <script src="../js/bootstrap/popper.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>
   
    
    
    <!-- data Table-->
    <link rel="stylesheet" href="../dataTable/datatables.css">
    <script src="../dataTable/datatables.js"></script>
    
    <!--data datle bootstrap 5 -->
    <link rel="stylesheet" href="../dataTable/DataTables-1.11.3/css/dataTables.bootstrap5.css">
    <script src="../dataTable/DataTables-1.11.3/js/dataTables.bootstrap5.js"></script>

    <!-- styles propios -->
    <link rel="stylesheet" href="../Styles/navbar.css">
    <link rel="stylesheet" href="../Styles/styles.css">
  

    <!-- botones  -->
    <script src="../dataTable/Buttons-2.1.1/js/dataTables.buttons.js"></script>
    <script src="../dataTable/JSZip-2.5.0/jszip.js"></script>
    <script src="../dataTable/pdfmake-0.1.36/pdfmake.js"></script>
    <script src="../dataTable/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../dataTable/Buttons-2.1.1/js/buttons.html5.js"></script>
     <!-- graficos  -->
     <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.0/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

    <script src="https://cdn.datatables.net/searchpanes/1.2.0/js/dataTables.searchPanes.min.js"></script>

    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.src.js"></script>
</head>
<body>
    <?php
    $ruta1='cursos.php';
    $ruta2='../coordinador.php';
    $ruta3= 'bitacora.php';
    $ruta4='../clases/destroy.php';
    $rutLogo='../img/logo-unam.png';
    $rutLogoF='../img/logo-dgtic.png';
    ?>
<?php include('../components/navbarCord.php');?>

    <!--  titulo de la sección  *************************-->
    <div class="container-fluid  titleBox">
        <div class="container mt-3">
            <div class="mt-4 title  rounded">
                <i class="bi bi-mortarboard-fill" style="font-size: 50px;"></i>
                <h1>Curso <?php echo $nombre_curso ?></h1>
            </div>
        </div>
    </div>
    <div class="container-fluid  titleBox">
       <div class="container  d-flex justify-content-start">
            <div class=" titleCurso rounded">
                <span class="fw-bold">Nombre del profesor:</span> 
                <span><?php echo $nombre_Profesor ?></span><br>
                <span class="fw-bold">Ciclo Escolar:</span>
                <span>2021-2</span><br> 
            </div>
        </div>
    </div>
   
<!-- tabla grupos ******************************-->
<div class="container  table-gruposBox">
        <table id="cursosProfesor" class=" table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>Id Curso</th>
                    <th>Facultad</th>
                    <th>Carrera</th>
                    <th>Nombre  del Curso</th>
                    <th>Nombre  del Grupo</th>
                    <th>Pendientes por <br> Calificar</th>
                    <th>Calificados</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($listaCursos) && !empty($listaCursos) && sizeof($listaCursos) > 0) : ?>
                    <?php foreach ($listaCursos as $key => $curso) : ?>
                        <?php $id_grupo = $curso['id'];
                        $id_curso = $curso['instanceid'];
                        $carrera2= $curso_Grupos->getCarreraCurso($id_curso);
                        $numeroA = $curso_Grupos->numeroAlumnos($id_grupo, $id_curso);
                        $numeroC = $conexionSYS->numeroCalificados($id_grupo);
                        //echo "total concluidos= ". $numeroC;
                        // echo "total de alumnos= ". $numeroA;
                        $pendientes = $numeroA - $numeroC;
                        //echo $curso["instanceid"] . "-" . $curso["fullname"] . "-" .  $curso["firstname"] . "-" . $curso["lastname"] . "<br/>";
                        //echo $facultad = $curso['facultad'];      
                        ?>
                        <tr>
                            <td><?php echo $curso['instanceid'] ?></td>
                            <td><?php echo $curso['facultad'] ?></td>
                            <td><?php echo $carrera2 ?></td>
    
                            <td><?php echo  $curso['fullname']  ?></td>
                            <td><?php echo  $curso['name']?></td>
                            <td><?php echo  $pendientes ?></td>
                            <td><?php echo  $numeroC ?></td>
                            <td>
                            <?php 
                                $id_profesor = base64_encode( $id_profesor_lim);
                                $id_profesor= urldecode($id_profesor);

                                $id_grupo = base64_encode( $curso['id']);
                                $id_grupo= urldecode($id_grupo);

                                $id_curso = base64_encode($curso['instanceid']);
                                $id_curso= urldecode($id_curso);
                             ?>
                                <a href="../listaTotal.php?id_grupo=<?php echo $id_grupo ?>&id_curso=<?php echo $id_curso?>&id_profesor=<?php echo $id_profesor?>" class="btn  btn-primary" type="button">Ver Grupo</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <h1>Moodle mal configurado</h1>
                        | <table class="paleBlueRows" id="datatable">
                            <thead>
                                <tr>
                                    <th>Id Curso</th>
                                    <th>Nombre del Curso</th>
                                    <th>Nombre del Grupo</th>
                                    <th>Nombre del Profesor</th>
                                    <th>Pendientes por <br> Calificar</th>
                                    <th>Calificados</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    if (isset($listaCursos) && !empty($listaCursos) && sizeof($listaCursos) > 0) {
                                        foreach ($listaCursos as $key => $curso) {
                                            $id_grupo = $curso['id'];
                                            $id_curso = $curso['instanceid'];
                                            $numeroA = $cursos->numeroAlumnos($id_grupo, $id_curso);
                                            $numeroC = $conexionSYS->numeroCalificados($id_grupo);
                                            //echo "total concluidos= ". $numeroC;
                                            // echo "total de alumnos= ". $numeroA;
                                            $pendientes = $numeroA - $numeroC;
                                            //echo $curso["instanceid"] . "-" . $curso["fullname"] . "-" .  $curso["firstname"] . "-" . $curso["lastname"] . "<br/>";
                                            echo
                                            '
                                                <tr>
                                                    <td>' . $curso['instanceid'] . '</td>
                                                    <td>' . $curso['fullname'] . '</td>
                                                    <td>' . $curso['name'] . '</td>
                                                    <td>' . $curso['firstname'] . " " . $curso['lastname'] . '</td>
                                                    <td>' . $pendientes . '</td>
                                                    <td>' . $numeroC . '</td>
                                                    <td>
                                                    <a href="../listaTotal.php?id_grupo=' . $curso['id'] . '&id_curso=' . $curso['instanceid'] . '" class="button" type="button">ver grupo</a>
                                                
                                                    </td>
                                                </tr>
                                                ';
                                        }
                                    }
                                } catch (Exception $ex) {
                                    //throw $th;
                                }
                                // $id_grupo=1;


                                ?>
                            </tbody>
                        </table>
                <?php endif ?>


            </tbody>

        </table>

    </div>
     <!-- contenedor -->
     <div class="container container_grafica_curso_cord">
        <div class="row grafica_row">
             <div class="col-12">
                 <div id="contenedor" class="">

                </div>
            </div>
        </div>
    </div>
  <?php include('../components/footer.php');?>
  <script src="../js/cursoProfesor.js"></script>
</body> 

</html>