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

$id_usuario= $_GET['id_profesor'];
$id_grupo = $_GET['id_grupo'];
$id_curso = $_GET['id_curso'];

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


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/styles.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Coordinador</title>
</head>
<body>
   
<div id="navbar">
    <ul>
     <li><?php echo " <a href='./coordinador/cursos.php'>Cursos</a>" ?></li>
      <li ><?php echo" <a href='coordinador.php?id_usuario=$id_usuario'>Grupos</a>"?></li>
      <li><a href="./coordinador/bitacora.php">Bitácora</a></li>
      <li style="float:right"><a class="active" href="./clases/destroy.php">Cerrar Sesión</a></li>
    </ul>
 </div>
 

   <div class="containerTAB">
    <table class="paleBlueRows"  id="datatable">
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
                <?php
                $contador=0;
                try {
                    if (isset($lisCalificaiones) && !empty($lisCalificaiones) && sizeof($lisCalificaiones) > 0) {
                        foreach ($lisCalificaiones as $key => $curso) {

                            $email = $curso['email'];
                            $query = "select * from alumnos  where correo= '$email'";
                            $cuenta =   $conexionDGAE->obtenerCuenta($query);
                            
                            if ($grupo ==  $curso['name']) 
                            {
                                $numero_cuenta = $cuenta['numero_cuenta'];
                               // $query = "select * from curso where numero_cuenta=  $numero_cuenta";
                                $reporte= $conexionSYS->verificarStatus($id_grupo, $id_curso, $numero_cuenta);
                                // echo "numero_cuenta = " .$numero_cuenta;
                                //echo "vALOR = ". $reporte;
                                if ($reporte ==1) {
                                    $estatus = "Concluido";
                                    $calificacion =0;
                                    $calificacion= $conexionSYS->actualizarCalificacion($id_grupo, $id_curso, $numero_cuenta);
                                } else {
                                    $estatus = "Pendiente";
                                    $calificacion =$curso['finalgrade'];
                                }                             
                          
                                // echo $curso["courseid"] . "-" . $curso["fullname"] . "-" .  $curso["firstname"] . "-" . $curso["lastname"] . "<br/>";
                                echo
                              '
                            <tr>
                                <td>'.$id_curso.'</td>
                                <td>' . $cursoNombre . '</td>
                                <td>' . $grupo . '</td>
                                <td>' . $nombre_Profesor . " ".$apellidos_Profesor. '</td>
                                <td>
                                ' . $cuenta['numero_cuenta'] . '
                                </td>
                                <td> ' .$cuenta['nombre'] . " " . $cuenta['paterno'] ."" . $cuenta['materno'] . '</td>
                                <td> '.$format_number1 = round($calificacion, 2).'</td>
                                <td>'.$estatus.'</td>
                            </tr>
                            ';
                            }
                        }
                    }           
                
                   // echo $reporte;
                } catch (Exception $ex) {
                    //throw $th;
                }

                ?>
            </tbody>
        </table>
        <?php 
      echo "<a href='coordinador.php?id_usuario=$id_usuario' class='button' type=''>Regresar</a>";
    ?>
   </div>
  

</body>

</html>
