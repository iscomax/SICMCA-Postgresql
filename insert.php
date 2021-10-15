<?php 
session_start();
require('./conexion/conexionSYS.php');
$id_usuario = $_POST["id_usuario"];
$idCurso = $_POST["idcurso"];
$profesor = $_POST["profesor"];
$cuenta = $_POST["cuenta"];
$nombre = $_POST["nombre"];
$paterno = $_POST["paterno"];
$materno = $_POST["materno"];
$cursoNombre = $_POST["cursoNombre"];
$grupo = $_POST["grupo"];
$calificacion = $_POST["calificacion"];
$reporte =$_POST["estatus"];
$id_grupo= $_POST["id_grupo"];
//echo $cuenta .$nombre .$paterno .$materno .$cursoNombre .$grupo .$calificacion ;
    $alumno = $nombre .$paterno .$materno;
    $conexionB = new conexionSYS;
    $query= "INSERT into materia (id_moodle,id_grupo,nombre_curso,nombre_grupo,nombre_profesor,numero_cuenta,nombre_alumno,calificacion,estatus)
    values ('$idCurso','$id_grupo','$cursoNombre','$grupo', '$profesor', '$cuenta', '$alumno','$calificacion', 1 )";
    $id_materia =$conexionB -> guardar($query);
    //echo"registro exitoso";
    $fechaActual = date('Y-m-d H:i:s');
    //echo $fechaActual;
    $query = "INSERT into bitacora (grupo,profesor,alumno,calificacion,fecha_hora,id_usuario,id_materia)values
    ('$grupo','$profesor','$alumno','$calificacion','$fechaActual','$id_usuario','$id_materia')";
    $resul= $conexionB->guardar($query);
    //echo "id Bitacora = ". $resul;
 /* unset($_POST["id_usuario"]);
  unset($_POST["idcurso"]);
  unset($_POST["profesor"]);
  unset($_POST["cuenta"]);
  unset($_POST["nombre"]);
  unset($_POST["paterno"]);
  unset($_POST["materno"]);
  unset($_POST["cursoNombre"]);
  unset($_POST["grupo"]);
  unset($_POST["calificacion"]);
  unset($_POST["estatus"]);
 header("location: profesor.php");*/

?>