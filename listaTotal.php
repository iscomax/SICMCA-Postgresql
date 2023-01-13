<?php
require('./conexion/conexion.php');
require('./conexion/conexionSYS.php');
require('./conexion/conexionDGAE.php');
require('./clases/cursos.php');
session_start();
if(isset($_SESSION['login'])){ 
    $id = $_SESSION['id_usuario']; 
}else{
  header("location: index.php");
}


$id_grupo = $_GET['id_grupo'];
urldecode($id_grupo);
$id_grupo = base64_decode($id_grupo);

$id_curso = $_GET['id_curso'];
urldecode($id_curso);
$id_curso = base64_decode($id_curso);

$id_usuario= $_GET['id_profesor'];
urldecode($id_usuario);
$id_usuario = base64_decode($id_usuario);



$cursos = new cursos;
$lisCalificaiones = $cursos->listaCalificaciones($id_curso);
$info_curso = $cursos->mostrarCurso($id_usuario,$id_grupo );



//echo "profesor=".$id_usuario;
//echo "idgrupo=".$id_grupo;
//echo "idcurso=".$id_curso;
//print_r($info_curso);

foreach ($info_curso as $key => $info) {
    $cursoNombre = $info['fullname'];
    $grupo =$info['name'];
    $nombre_Profesor= $info['firstname'];
    $apellidos_Profesor =$info['lastname'];
}
$profesor =  $nombre_Profesor." ". $apellidos_Profesor;
//echo "ID= ".$id_usuario;
$conexionDGAE = new conexionDGAE;
//$query = "select * from alumnos";
//$listaAlumnos = $conexionDGAE->obtenerDatos($query);

//print_r($lisCalificaiones);

$conexionSYS = new conexionSYS;
//$query = "select *from curso";
//$reporte= $conexionSYS->obtenerDatos($query);
//print_r($reporte);
$id_usuario = $_SESSION['id_usuario'];
$datosUsuario= $conexionSYS->obtnerUsuario($id_usuario);
//print_r($datosUsuario);
foreach ($datosUsuario as $key => $dato) {
    $nombre = $dato['nombre']." ". $dato['apellidos'];
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinador</title>
   
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

    <!-- styles propios -->
    <link rel="stylesheet" href="./Styles/navbar.css">
    <link rel="stylesheet" href="./Styles/styles.css">
  

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
     <!-- fuentes -->
     <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;500&display=swap" rel="stylesheet"> 
</head>
<body>
<?php
    $ruta1 = './coordinador/cursos.php';
    $ruta2 = 'coordinador.php?id_usuario=$id_usuario';
    $ruta3 = './coordinador/bitacora.php'; 
    $ruta4 = './clases/destroy.php';
    $rutLogo='./img/logo-unam.png';
    $rutLogoF='./img/logo-dgtic.png';
?>
   
  

   <?php include('./components/navbarCord.php');?>
    <!--  titulo de la sección  *************************-->
    <div class="container-fluid title ">
        <div class="row">
                <div class="col-12">
                        <h1 ><i class="bi bi-journal-bookmark-fill" style="font-size: 50px;"></i> <?php echo   $cursoNombre." ".$grupo;?></h1>
                </div>
        </div>
    </div>

   <div class="container  table-gruposBox">
        <table  id="loadTable" class=" table table-striped table-bordered table-hover" width="100%" >
            <thead>
                <tr>
                    <th>Id Curso</th>
                    <th>Nombre del Curso</th>
                    <th>Nombre del Grupo</th>
                    <th>Nombre del Profesor</th>
                    <th>Número de Cuenta</th>
                    <th>Nombre del Alumno</th>
                    <th>Calificación Final</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($lisCalificaiones) && !empty($lisCalificaiones) && sizeof($lisCalificaiones) > 0): ?>
                    <?php    foreach ($lisCalificaiones as $key => $curso): ?>
                        <?php 
                            $email = $curso['email'];
                            $query = "select * from alumnos  where correo= '$email'";
                            $cuenta =   $conexionDGAE->obtenerCuenta($query);

                        ?>
                        <?php  if ($grupo ==  $curso['name']) :?>
                            <?php
                                $numero_cuenta = $cuenta['numero_cuenta'];
                                // $query = "select * from curso where numero_cuenta=  $numero_cuenta";
                                 //$reporte= $conexionSYS->verificarStatus($id_grupo, $id_curso, $numero_cuenta);
                                 $reporte = $conexionSYS->verificarStatus($numero_cuenta, $id_grupo);
                                // echo "numero_cuenta = " .$numero_cuenta;
                                //echo "vALOR = ". $reporte;
                                if ($reporte) {
                                    $estatus = "Concluido";
                                    $calificacion =0;
                                    $result= $conexionSYS->actualizarCalificacion($numero_cuenta, $id_grupo);
                                    $calificacion = $result[0];
                                    $tipo_calificacion = $result[1];
                                    if ($tipo_calificacion== 1) {
                                        $calificacion="NA";
                                    } else if ($tipo_calificacion== 2){
                                        $calificacion="NP";
                                    } else if ($tipo_calificacion== 3){
                                        $calificacion = round($calificacion, 2);
                                    }
                                } else {
                                    $estatus = "Pendiente";
                                    $calificacion = round( $curso['finalgrade'],2);
                                }   
                            ?>
                            <tr>
                                <td><?php echo $id_curso?></td>
                                <td><?php echo $cursoNombre ?></td>
                                <td><?php echo $grupo?></td>
                                <td><?php echo $nombre_Profesor. " ".$apellidos_Profesor?></td>
                                <td><?php echo $cuenta['numero_cuenta']?></td>
                                <td><?php echo $cuenta['nombre'] . " " . $cuenta['paterno'] ."" . $cuenta['materno'] ?></td>
                                <td><?php echo $calificacion?></td>
                                <td><?php echo $estatus?></td>
                            </tr>
                        <?php endif ?>
                    <?php  endforeach?>
                <?php  endif?>

            </tbody>
        </table>
   </div>
        <?php 
     /*  echo "<a href='coordinador.php?id_usuario=$id_usuario' class='button' type=''>Regresar</a>"; */
    ?>
      <!-- contenedor -->
      <div class="container container_grafica_grupo_cord">
        <div class="row grafica_row">
             <div class="col-12">
                 <div id="contenedor" class="">

                </div>
            </div>
        </div>
    </div>
    <?php include('./components/footer.php');?>
<!--     <script src="./js/dataTable.js"></script> -->
  <script src="./js/statusGrupo.js"></script> 

</body>

</html>
