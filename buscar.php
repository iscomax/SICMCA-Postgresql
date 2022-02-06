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
    $nombreP = $dato['firstname'];
    $apellido = $dato['lastname'];
}
$nombre_Profesor = $nombreP . " " . $apellido;
$conexionDGAE = new conexionDGAE;
$conexionSYS = new conexionSYS;
$nombre = $nombre_Profesor;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SICMCA-Busquedas</title>
 <!-- iconos -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--bootstrap 5 local-->
    <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
    <script src="./js/bootstrap/bootstrap.min.js"></script>
    <script src="./js/bootstrap/popper.min.js"></script>
    
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
<?php
    $ruta1 = './profesor/cursos.php';
    $ruta2 = 'profesor.php';
    $ruta3 = 'buscar.php'; 
    $ruta4 = './clases/destroy.php';
    $rutLogo='./img/logo-unam.png';
    $rutLogoF='./img/logo-dgtic.png';
?>
  <?php include('./components/navbar.php');?>

     <!--  titulo de la sección  *************************-->
     <div class="container-fluid  titleBox">
        <div class="container mt-3">
            <div class="mt-4 title  rounded">
                <i class="bi bi-search" style="font-size: 50px;"></i>
                <h1>Búscar por Número de Cuenta</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col -12 col-md-12  d-flex justify-content-center">
            <form action="buscar.php" method="get" class="row g-3">
                    <div class="col-12 col-md-3">
                        <p>Buscar Alumno</p>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="" class="visually-hidden"></label>
                        <input  type="text" minlength="9" maxlength="9" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="num_cuenta" id="num_cuenta" class="form-control"  placeholder="Número de Cuenta">
                    </div>
                    <div class="col-12 col-md-2 ">
                           <!--  <button class="button" id="buscar" type="submit" >Buscar</button>-->
                        <button type="submit" onclick="searchByNumCuenta()" class="btn btn-primary mb-3 ">Buscar</button>
                    </div>
                    <div class="col-12 col-md-2 ">
                        <a href="profesor.php?id_usuario=<?php echo $id?>" class="btn btn-primary mb-3" >Regresar</a>
                    </div>
            </form>

            </div>
        </div>
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
    <div class="container table-busqueda">
        <table id="loadTable" class=" table table-striped table-bordered table-hover" width="100%"  >
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
                    <th>Pendiente/Concluido</th>
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
                        $result= $conexionSYS->actualizarCalificacion($id_grupo,$id_curso, $numero_Cuenta);
                        $calificacion = $result[0];
                        $tipo_calificacion = $result[1];
                    } else {
                        $estatus = "Pendiente";
                        $calificacion =0;
                      // $calificacion =$curso['finalgrade'];
                    }
                    
                    if ($estatus=="Pendiente" ) {
                        $calfinal =$curso['finalgrade'];
                
                    } else{
                        $calfinal = $calificacion;
                      
                        if ($tipo_calificacion== 1) {
                            $calificacion="NA";
                        } else if ($tipo_calificacion== 2){
                            $calificacion="NP";
                        } else if ($tipo_calificacion== 3){
                            $calificacion = round($calificacion, 2);
                        }
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
                        <td id="calificacion_final" ><?php echo $calificacion?></td>
                        <td id="estatus" ><?php echo $estatus?></td>
                        <td id="buttonEnviar" >
                        <?php 

                        $id_curso_code = base64_encode($id_curso);
                        $id_curso_code= urldecode( $id_curso_code);

                        
                         $id_grupo_code = base64_encode( $id_grupo);
                        $id_grupo_code= urldecode($id_grupo_code);
                        //echo $numero_Cuenta;
                        $numero_cuenta_code = base64_encode( $numero_Cuenta);
                        $numero_cuenta_code= urldecode($numero_cuenta_code);
                        //echo $calfinal;
                        $calfinal_code = base64_encode( $calfinal);
                        $calfinal_code = urldecode($calfinal_code);
              
                        $reporte_code = base64_encode( $reporte);
                        $reporte_code = urldecode($reporte_code);

                        ?>
            
                        <a href="cargar.php?id_curso=<?php echo $id_curso_code?>&id_grupo=<?php echo $id_grupo_code?>&numero_cuenta=<?php echo $numero_cuenta_code?>&cal=<?php echo $calfinal_code;?>&r=<?php echo $reporte_code?>" class="btn btn-primary" type="button">Subir Calificación</a>
                        
                        </td>
                    </tr>
                    <?php endif?>                                    
                <?php endforeach ?>
                <?php endif?> 
            </tbody>
        </table>
      
    </div>
    <?php endif;?>
    
    <div class="footer-busqueda">
        <?php include('./components/footer.php');?>
    </div>



    <script src="./js/prueba.js"></script>
    <script src="./js/dataTable.js"></script>
</body>

</html>