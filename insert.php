<?php 
session_start();
require('./conexion/conexionSYS.php');
require('./conexion/conexionDGAE.php');
require("./conexion/conexion.php");
require("./clases/cursos.php");

$id_usuario = $_POST["id_usuario"];
$idCurso = $_POST["idcurso"];
$profesor = $_POST["profesor"];
$cuenta = $_POST["cuenta"];
$nombre = $_POST["nombre"];
$paterno = $_POST["paterno"];
$materno = $_POST["materno"];
$cursoNombre = $_POST["cursoNombre"];
$grupo = $_POST["grupo"];
$calificacionT = $_POST["calificacion"];
$reporte =$_POST["estatus"];
$id_grupo= $_POST["id_grupo"];

$tipoCalificacion;

if ( $calificacionT == "NA" ) {
    $tipoCalificacion =1;
    $calificacion = 0;
}else if ( $calificacionT == "NP"){
    $tipoCalificacion =2;
    $calificacion = 0;

}else{
    $tipoCalificacion =3;
    $calificacion= $calificacionT;
}

$tipoCalificacion;
$calificacion;
$alumno = $nombre." ".$paterno." ".$materno;


$conexionDGAE= new conexionDGAE;
$conexionB = new conexionSYS;
$status= $conexionB->getStatusRegistro($id_grupo, $cuenta);


$curso = new cursos;
$curso->mostrarCurso($id_usuario, $id_grupo);
$cursoNombre=$curso->getNombreCurso();
$grupo= $curso->getNombreGrupo();


if ($status>=1) {
//echo '<script type="text/javascript"> window.alert("Esta calificacion ya esta registrada en el sistema DGAE"); </script>';  
} else {

    $result= $conexionDGAE->getDataAlumno($cuenta);  
    if ($result) {
        $nombreDGAE = $conexionDGAE->getNombreAlumno();
        $paternoDGAE = $conexionDGAE->getPaternoAlumno();
        $maternoDGAE = $conexionDGAE->getMaternoAlumno();
        /* **************************************************** */
        if ($nombre === $nombreDGAE && $paterno === $paternoDGAE && $materno === $maternoDGAE) {
            
                //sentencia de consulta
                $query= "INSERT into materia (id_moodle,id_grupo,nombre_curso,nombre_grupo,nombre_profesor,numero_cuenta,nombre_alumno,calificacion,estatus,tipo_calificacion )
                values ('$idCurso','$id_grupo','$cursoNombre','$grupo', '$profesor', '$cuenta', '$alumno','$calificacion', 1, $tipoCalificacion)";
                //insert en la BD
                $id_materia =$conexionB -> guardar($query);

                //ajustamos la hora 
                date_default_timezone_set("America/Mexico_City");
                $fechaActual = date('Y-m-d H:i:s');
                //sentencia de consulta
                $query = "INSERT into bitacora (grupo,profesor,alumno,calificacion,fecha_hora,id_usuario,id_materia)values
                ('$grupo','$profesor','$alumno','$calificacionT','$fechaActual','$id_usuario','$id_materia')";
                //insert en la BD
                $resul= $conexionB->guardar($query);
                //echo "id Bitacora = ". $resul; 
                

                //echo "registro existoso";
        } else {
            //echo "no se puede realizar el registro";
        }

    } else{
        //echo 'numero de cuenta invalido'; 
    }
    



    



}


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


/* $fecha = new DateTime('NOW');
echo 'Fecha/hora actual: ', $fecha->format('Y-m-d H:i:s'); */
//echo $fechaActual;

