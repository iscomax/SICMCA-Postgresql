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
//$id_usuario = $_POST['id_usuario'];
//$id_grupo = $_POST['id_grupo'];
//$id_curso = $_POST['id_curso'];

if (empty($_POST["num_cuenta"]))
{

    $num_cuentaPOST="null";
} 
else
{
    $num_cuentaPOST=$_POST["num_cuenta"];
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
<?php if( $num_cuentaPOST!="null"):
    ?>

        <table class="paleBlueRows" id="datatable" >
            <thead>
                <tr>
                    <th>Id Curso</th>
                    <th>Nombre del Curso</th>
                    <th>Grupo</th>
                    <th>Profesor</th>
                    <th>Número de Cuenta</th>
                    <th>Nombre del Alumno</th>
                    <th>Calificación Moodle</th>
                    <th>Calificación Final</th>
                    <th>Estatus</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $numero_Cuenta = $num_cuentaPOST;
                    if ($numero_Cuenta !="null" ):
                    $alumno = $conexionDGAE->getAlumnoby($numero_Cuenta);
                    $alumnoCorrreo = $alumno['correo'];
                    $busqueda = $cursos->getListaBy($alumnoCorrreo);
                ?>
                <?php   foreach ($busqueda  as $key => $curso): ?>
                <?php 
                      $id_curso =$curso["courseid"];
                      $id_grupo=$curso["id"];
                      $indice = array_search($id_grupo,$idGrupoArray,true);
                      $grupo = $idGrupoArray[$indice];
                ?>

                      <?php if ($grupo== $id_grupo ):?>
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
                            <button class="calificacion"  name="calificacion" id="calificacion" onclick="">Subir Califiacion</button>
                        </td>
                    </tr>
                    <?php else: ?>
                      <h1>lo sentimos no hay resultados</h1>
                    <?php endif;?>
                                                    
                <?php endforeach; ?>
              
                <?php endif;?> 
            </tbody>
        </table>
<?php endif?> 

