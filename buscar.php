<?php
require('./conexion/conexion.php');
require('./conexion/conexionSYS.php');
require('./conexion/conexionDGAE.php');
include './clases/cursos.php';
session_start();
if (isset($_SESSION['login'])) {
    $id = $_SESSION['id_usuario'];
} else {
    header("location: index.php");
}
//$id_usuario = $_GET['id_usuario'];
//$id_grupo = $_GET['id_grupo'];
//$id_curso = $_GET['id_curso'];

if (empty($_GET["num_cuenta"]))
{
   //echo "vacio";
    $num_cuentaPOST="null";
} 
else
{
    //echo "iniciar busqueda";
   $num_cuentaPOST=$_GET["num_cuenta"];
   if (strlen( $num_cuentaPOST)<9 || strlen( $num_cuentaPOST)>9){
    
     //  echo "El número de cuenta es de 9 Digitos";
        $validar = false;
    }else{
        $validar= true; 
    }
}

$cursos = new cursos;

$listaCursos = $cursos->listaCursos($id);
foreach ($listaCursos as $key) {
    $idGrupoArray[] = $key['id'];
}
//print_r($idGrupoArray);


$datos_Profesor = $cursos->obtenerProfesor($id);

foreach ($datos_Profesor as $key => $dato) {
    $nombre = $dato['firstname'];
    $apellido = $dato['lastname'];
}
$nombre_Profesor = $nombre . " " . $apellido;
$conexionDGAE = new conexionDGAE;
$conexionSYS = new conexionSYS;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./Styles/styles.css">
</head>

<body>
  
<div id="navbar">
    <ul>
    <li><?php echo" <a href='./profesor/cursos.php?id_usuario=$id'>Cursos</a>"?></li>
      <li ><?php echo" <a href='profesor.php?id_usuario=$id'>Grupos</a>"?></li>
   
      <li ><?php echo"<a href='buscar.php?id_usuario=$id'>Buscar</a>"?></li>
      <li style="float:right"><a class="active" href="./clases/destroy.php">Cerrar Sesión</a></li>
    </ul>
  </div>

  <div class="titulos">
      <h1>Búsqueda Individual</h1>
  </div>

    <div class="buscarbar" id="buscarbar">
        <form action="buscar.php" method="get">
        <label for="buscar">Buscar Alumno</label>
        <input type="text" minlength="9" maxlength="9" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="num_cuenta" id="num_cuenta" placeholder="Número de Cuenta" style="width: 15%;" value="">
      <!--  <button class="button" id="buscar" type="submit" >Buscar</button>-->
        <button class="button"  onclick="searchByNumCuenta()">Buscar</button>
        <?php echo" <a href='profesor.php?id_usuario=$id' class='button buttonRegresar'  >Regresar</a>"?>
        </form>
    </div>

    <?php if( $num_cuentaPOST!="null" and $validar==true):?>
        <?php
            $numero_Cuenta = $num_cuentaPOST;
            if ($numero_Cuenta !="null" ):
            $alumno = $conexionDGAE->getAlumnoby($numero_Cuenta);
            $alumnoCorrreo = $alumno['correo'];
            if ($alumnoCorrreo==null) {
                echo '<script type="text/javascript">
                window.alert("Numero de cuenta no registrado en la BD");
                window.location="buscar.php";
                </script>';
                // header("location: buscar.php");
                // die();
                
            }else{
                $busqueda = $cursos->getListaBy($alumnoCorrreo);
            }
            
        ?>
    <div class="containerTAB">
        <table class="paleBlueRows" id="datatable" >
            <thead>
                <tr>
                    <th>Id Curso</th>
                    <th>Nombre del Curso</th>
                    <th>Nombre del Grupo</th>
                    <th>Nombre del Profesor</th>
                    <th>Número de Cuenta</th>
                    <th>Nombre del Alumno</th>
                    <th>Calificación Moodle</th>
                    <th>Calificación Final</th>
                    <th>Pendiente/ <br> Concluido</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
               
                <?php   foreach ($busqueda  as $key => $curso): ?>
                
                <?php 
                      $id_curso =$curso["courseid"];
                      $id_grupo=$curso["id"];
                      $indice = array_search($id_grupo,$idGrupoArray,true);
                      $grupo = $idGrupoArray[$indice];
                      //echo $grupo;
                ?>
                <?php if ($grupo== $id_grupo ): ?>
                    <?php 
                    $calificacion;
                    $reporte= $conexionSYS->verificarStatus($id_grupo,$id_curso, $numero_Cuenta);
                    if ($reporte) {
                        $estatus = "Concluido";
                        $calificacion =0;
                        $calificacion= $conexionSYS->actualizarCalificacion($id_grupo,$id_curso, $numero_Cuenta);
                      //  echo "calificacion: ". $calificacion;
                    } else {
                        $estatus = "Pendiente";
                        $calificacion =0;
                      // $calificacion =$curso['finalgrade'];
                    }
                    
                    if ($estatus=="Pendiente" ) {
                        $calfinal =$curso['finalgrade'];
                    } else{
                        $calfinal = $calificacion;
                    }
                    ?>              
                    <tr>
                        <td id="id_curso"><?php echo $curso["courseid"] ?></td>
                        <td id="nombre_Curso"><?php echo $curso["fullname"] ?></td>
                        <td id="nombre_Grupo"><?php echo $curso["name"] ?></td>
                        <td id="nombre_Profesor"><?php echo $nombre_Profesor ?></td>
                        <td id="numero_Cuenta" ><?php echo $numero_Cuenta?></td>
                        <td id="nombre_Alumno" ><?php echo $curso["firstname"]." ".$curso["lastname"] ?></td>
                        <td id="calificacion_Moodle" ><?php echo $format_number1 = round($curso['finalgrade'], 2)?></td>
                        <td id="calificacion_final" ><?php echo $format_number1 = round($calificacion, 2)?></td>
                        <td id="estatus" ><?php echo $estatus?></td>
                        <td id="buttonEnviar" >
                            <?php echo'<a href="cargar.php?id_curso='.$id_curso.'&id_grupo='.$id_grupo.'&numero_cuenta='.$numero_Cuenta.'&cal='.$calfinal.'&r='.$reporte.'"class="button buttonBuscar" type="button">Subir Calificación</a>' ?>
                        
                        </td>
                    </tr>
                    <?php endif?>                                    
                <?php endforeach ?>
                <?php endif?> 
            </tbody>
        </table>
        <div>
            <?php
            echo "<a href='profesor.php?id_usuario=$id' class='button buttonRegresar' type=''>Regresar</a>";
            ?>
            <a href='profesor.php?id_usuario=$id_usuario' class='button buttonRegresar' type=''>Reporte General</a>
        </div>
    </div>
    <?php endif;?>
    
    <script src="./js/prueba.js"></script>
</body>

</html>