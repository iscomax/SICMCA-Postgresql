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

$tipoCalificacion;

if ( $calificacion == "NA" ) {
    $tipoCalificacion =1;
    $calificacion = 0;
}else if ( $calificacion == "NP"){
    $tipoCalificacion =2;
    $calificacion = 0;

}else{
    $tipoCalificacion =3;
}

$tipoCalificacion;
$calificacion;


    $alumno = $nombre." ".$paterno." ".$materno;
    $conexionB = new conexionSYS;
   $status= $conexionB->getStatusRegistro($id_grupo, $cuenta);

   if ($status>=1) {
    //echo '<script type="text/javascript"> window.alert("Esta calificacion ya esta registrada en el sistema DGAE"); </script>';  
   } else {
    $query= "INSERT into materia (id_moodle,id_grupo,nombre_curso,nombre_grupo,nombre_profesor,numero_cuenta,nombre_alumno,calificacion,estatus,tipo_calificacion )
    values ('$idCurso','$id_grupo','$cursoNombre','$grupo', '$profesor', '$cuenta', '$alumno','$calificacion', 1, $tipoCalificacion)";
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
   }
   




   

?>