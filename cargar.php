<?php
session_start();
if (isset($_SESSION['login'])) {
  $id = $_SESSION['id_usuario'];
} else {
  header("location: index.php");
}
require('./conexion/conexionSYS.php');
require("./conexion/conexionDGAE.php");
require("./conexion/conexion.php");
require("./clases/cursos.php");
$id_usuario =   $_SESSION['id_usuario'];

$id_curso = $_GET['id_curso'];
urldecode($id_curso);
$id_curso = base64_decode($id_curso);


$id_grupo = $_GET['id_grupo'];
urldecode($id_grupo);
$id_grupo = base64_decode($id_grupo);

$cuenta = $_GET['numero_cuenta'];
urldecode($cuenta);
$cuenta = base64_decode($cuenta);

$reporte = $_GET["r"];
urldecode($reporte);
$reporte = base64_decode($reporte);

$calificacion = $_GET['cal'];
urldecode($calificacion);
$calificacion = base64_decode($calificacion);


$curso = new cursos;
$curso->mostrarCurso($id, $id_grupo);
$idCurso =$id_curso;
$cursoNombre=$curso->getNombreCurso();
$profesor= $curso->getProfesor();
$grupo= $curso->getNombreGrupo();
$alumno = new conexionDGAE;
$alumno->getDataAlumno($cuenta);
$nombreA = $alumno->getNombreAlumno();
$paterno = $alumno->getPaternoAlumno();
$materno= $alumno->getMaternoAlumno();

$conexionBD = new conexionSYS();
$reporte = $conexionBD->getStatusRegistro($id_grupo, $cuenta);
$calificacionBD= $conexionBD->getCalificacion($id_grupo, $cuenta); 

if ($reporte>=1) {
  $format_number1= $calificacionBD;
  $mensaje='Esta calificación ya está registrada en el sistema DGAE';  
}else{
  $format_number1 = round($calificacion, 2) ;
  $mensaje='';
}

/*

$cuenta = $_POST["cuenta"];
$nombre = $_POST["nombre"];
$paterno = $_POST["paterno"];
$materno = $_POST["materno"];

$calificacion = $_POST["calificacion"];

$reporte = $_POST["reporte"];
$alumno = $nombre . " " . $paterno . " " . $materno;
*/
//echo "idgrupo=".$id_grupo;
//echo "idcurso=".$idCurso;
$nombre= $profesor;
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SICMCA Subir Calificación</title>
        <!-- fuentes -->
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;500&display=swap" rel="stylesheet"> 
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
</head>

<body>
  
  <!-- barra de navegacion ---------------------------------------------------------------------------------->
  <!-- lista.php?id_curso=$idCurso&id_grupo=$id_grupo -->
  <?php
    $ruta1 = './profesor/cursos.php?id_usuario=$id';
    $ruta2 = 'profesor.php?id_usuario=$id';
    $ruta3 = 'buscar.php?id_usuario=$id'; 
    $ruta4 = './clases/destroy.php';
    $rutLogo='./img/logo-unam.png';
    $rutLogoF='./img/logo-dgtic.png';
?>
<?php include('./components/navbar.php');?>

    <!--  titulo de la sección  *************************-->
    <div class="container-fluid title ">
        <div class="row">
            <div class="col-12">
                    <h1 ><i class="bi bi-upload" style="font-size: 50px;"></i> Subir calificación</h1>
            </div>
        </div>
    </div>
<div class="container boxForm">
  <div class="row">
    <div class="col-12 col-md-2"></div>
    <div class="col-12 col-md-8">
        <!-------form----------------------------------------------------------------------------------------------------->
        <div class="container formCargar">
            <input name="id_grupo" id="id_grupo" value="<?php echo $id_grupo ?>" type="hidden">
            <input name="id_usuario" id="id_usuario" value="<?php echo $id ?>" type="hidden">
            <input name="profesor" id="profesor" value="<?php echo $profesor ?>" type="hidden">
            <input name="idcurso" id="idcurso" value="<?php echo $idCurso ?>" type="hidden">
            <input name="reporte" id="reporte" value="<?php echo $reporte ?>" type="hidden">
            <!-- ******************************************************************************* -->
            <div class="row d-flex justify-content-around ">
                <div class="col-12 col-md-6">
                    <label for="" class="">Número de Cuenta</label>
                    <input type="text" class="form-control" id="cuenta" name="cuenta" value="<?php echo $cuenta ?>" disabled>
                </div>
                <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-3"></div>
            </div>
            <div class="row d-flex d-flex justify-content-around" >
                <div class="col-12 col-md-6">
                    <label for="lname">Nombre(s)</label>
                    <input type="text" id="nombre" class="form-control" name="nombre" value="<?php echo $nombreA ?>" disabled>
                </div>
                <div class="col-12 col-md-3">
                    <label for="lname">Apellido Paterno</label>
                    <input type="text" id="paterno" class="form-control" name="paterno" value="<?php echo $paterno ?>" disabled>
                </div>
                <div class="col-12 col-md-3">
                    <label for="lname">Apellido Materno</label>
                    <input type="text" id="materno" class="form-control" name="materno" value="<?php echo $materno ?>" disabled>
                </div>
            </div>
            <div class="row d-flex justify-content-around ">
                <div class="col-12 col-md-6">
                    <label for="lname">Curso</label>
                    <input type="text" id="curso" class="form-control" name="cursoNombre" value="<?php echo $cursoNombre ?>" disabled>
                </div>
                <div class="col-12 col-md-3">
                    <label for="lname">Grupo</label>
                    <input type="text" id="grupo" class="form-control" name="grupo" value="<?php echo $grupo ?>" disabled>
                </div>
                <div class="col-12 col-md-3"></div>
            </div>
            <!--  -->
            <div class="row d-flex justify-content-center ">
                <div class="col-12 col-md-10 col-lg-6">
                <label for="lname">Calificación</label>
                    <div class="input-group ">
                        <input type="text" id="calificacion" class="col-12 col-md-2" name="calificacion" value="<?php echo $format_number1 ?> " disabled>
            
                        <?php 
                          $id_grupo = base64_encode( $id_grupo);
                          $id_grupo= urldecode($id_grupo);
                          $id_curso = base64_encode($idCurso);
                          $id_curso= urldecode($id_curso);  
                        ?>
                     <!-- lista.php?id_grupo=<?php echo $id_grupo ?>&id_curso=<?php echo $id_curso?> -->

                        <a href=""
                        class="btn  text-wrap col-4 col-md-3  btn-success" type="button" id='Enviar'  name='enviar' onclick='enviarDatos()'> Registrar</a>
                        <!-- open modal -->
                        <a class="btn  btn-warning col-4 col-md-3" id="" data-bs-toggle="modal" data-bs-target="#myModal" type="button">Editar</a>

                        <a href="lista.php?id_grupo=<?php echo $id_grupo ?>&id_curso=<?php echo $id_curso?>" class="btn btn-primary  text-wrap col-4 col-md-3" type="button">Cancelar</a>
                        <span><?php echo $mensaje?></span>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-5 ">
                    
                </div>
            </div>
        </div>
        <!-- ------------------- -->
    </div>
    <div class="col-12 col-md-2"></div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center">Editar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body d-flex justify-content-evenly">
         <form action="" class="d-flex justify-content-evenly"; method="post">
            <label for="lname">Calificación</label>
            <input maxlength="2" style="width: 14%;"    required autocomplete="off"  min="5"   max="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" type="text" id="calificacion2" name="calificacion2" value="<?php echo $format_number1 = round($calificacion, 2) ; ?>">
            <button id="editar" name="editar" class="btn btn-primary" type="button" data-bs-dismiss="modal" onclick="" > Actualizar</button>
            <button id="np" name="np" class="btn btn-success" type="button"  onclick="" > NP</button>
            <button id="na" name="na" class="btn btn-success" type="button"  onclick="" > NA</button>
          <!--   <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button> -->
          </form>
      </div>


      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>

    </div>
  </div>
</div>
<div id="respuesta">
    
    </div>
<!-- footer -->
<?php  include('./components/footer.php');?>

<!--  -->

<script language="JavaScript">
window.history.forward(1); //Esto es para cuando le pulse atras
</script>


  <script src="./js/notificaciones.js"></script>
  <script src="./js/prueba.js"></script>
  <script src="./js/np.js"></script>


</body>

</html>