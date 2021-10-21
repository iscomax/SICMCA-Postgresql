<?php
session_start();
if (isset($_SESSION['login'])) {
  $id = $_SESSION['id_usuario'];
} else {
  header("location: index.php");
}
require("./conexion/conexionDGAE.php");
require("./conexion/conexion.php");
require("./clases/cursos.php");
$id_usuario =   $_SESSION['id_usuario'];

$id_curso = $_GET['id_curso'];
$id_grupo = $_GET['id_grupo'];
$cuenta = $_GET['numero_cuenta'];
$reporte = $_GET["r"];

$calificacion = $_GET['cal'];
$curso = new cursos;
$curso->mostrarCurso($id, $id_grupo);
$idCurso =$id_curso;
$cursoNombre=$curso->getNombreCurso();
$profesor= $curso->getProfesor();
$grupo= $curso->getNombreGrupo();
$alumno = new conexionDGAE;
$alumno->getDataAlumno($cuenta);
$nombre = $alumno->getNombreAlumno();
$paterno = $alumno->getPaternoAlumno();
$materno= $alumno->getMaternoAlumno();

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
  <!-- barra de navegacion ---------------------------------------------------------------------------------->
  <div id="navbar">
    <ul>
      <li><?php echo " <a href='profesor.php?id_usuario=$id'>Cursos</a>" ?></li>
      <li><?php echo " <a href='lista.php?id_curso=$idCurso&id_grupo=$id_grupo'>Grupos</a>" ?></li>
      <li><?php echo " <a href='buscar.php'>Buscar</a>" ?></li>
      <li style="float:right"><a class="active" href="./clases/destroy.php">Cerrar Sesión</a></li>
    </ul>
  </div>
<!------------------------------------------------------------------------------------------------------------>
  <div class="container cargar">
  <input name="id_grupo" id="id_grupo" value="<?php echo $id_grupo ?>" type="hidden">
    <input name="id_usuario" id="id_usuario" value="<?php echo $id ?>" type="hidden">
      <input name="profesor" id="profesor" value="<?php echo $profesor ?>" type="hidden">
      <input name="idcurso" id="idcurso" value="<?php echo $idCurso ?>" type="hidden">
      <input name="reporte" id="reporte" value="<?php echo $reporte ?>" type="hidden">

      <label for="fname">Número de Cuenta</label>
      <input type="text" id="cuenta" name="cuenta" value="<?php echo $cuenta ?>" disabled>

      <label for="lname">Nombre(s)</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" disabled>


      <label for="lname">Apellido Paterno</label>
      <input type="text" id="paterno" name="paterno" value="<?php echo $paterno ?>" disabled>

      <label for="lname">Apellido Materno</label>
      <input type="text" id="materno" name="materno" value="<?php echo $materno ?>" disabled>

      <label for="lname">Curso</label>
      <input type="text" id="curso" name="cursoNombre" value="<?php echo $cursoNombre ?>" disabled>

      <label for="lname">Grupo</label>
      <input type="text" id="grupo" name="grupo" value="<?php echo $grupo ?>" disabled>

      <label for="lname">Calificación</label>

      <input type="text" id="calificacion" name="calificacion" value="<?php echo $format_number1 = round($calificacion, 2) ?> " disabled>

    
     <?php
      echo "<a href='lista.php?id_curso=$idCurso&id_grupo=$id_grupo' type='button' class='button buttonRegistrar'  id='Enviar' name='enviar'  onclick='enviarDatos()' >Registrar</a>";
      ?>
        <!-- abrir modal -->
        <button type="button" class="button" id="myBtn">Editar</button>
      <?php
      echo "<a href='lista.php?id_curso=$idCurso&id_grupo=$id_grupo'    class='button buttonCancelar' type='button'>Cancelar</a>";
      ?>


    
    <!-- Modal -->
    <div id="myModal" class="modal">
      <!-- contenido modal -->
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">&times;</span>
          <h2>Editar</h2>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <label for="lname">Calificación</label>
            <input maxlength="2",   required autocomplete="off"  min="5"   max="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" type="text" id="calificacion2" name="calificacion2" value="<?php echo $format_number1 = round($calificacion, 2) ; ?>">
            <button id="editar" name="editar" class="button" type="button" onclick="" > Actualizar</button>
            <button type="button" name="cancelar" class="button" id="cancelar">Cancelar</button>

          </form>
        </div>
        <div class="modal-footer">
          <h3>UNAM</h3>
        </div>
      </div>

    </div>

  
  </div>
  <div id="respuesta">

  </div>
  <script src="./js/notificaciones.js"></script>
  <script src="./js/prueba.js"></script>
  <script src="./js/modal.js"></script>

</body>

</html>