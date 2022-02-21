<?php 
require('../conexion/conexionSYS.php');
session_start();
if(isset($_SESSION['login'])){  
}else{
  header("location: index.php");  
}
$id_usuario;
$id_curso =4;
$calificacion= 8;
$conexionB = new conexionSYS;
$bitacora = $conexionB->mostrarBItacora();
if (isset($_POST['id_bitacora'])) {
 //echo "eliminar bitacora";
 $id_bitacora =$_POST['id_bitacora'];

 $result = $conexionB->eliminarBitacora($id_bitacora);
}

$id_usuario = $_SESSION['id_usuario'];
$datosUsuario= $conexionB->obtnerUsuario($id_usuario);
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
  <title>Bitácora</title>
   <!-- fuentes -->
   <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;500&display=swap" rel="stylesheet"> 
 <!-- iconos -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--bootstrap 5 local-->
    <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
    <script src="../js/bootstrap/popper.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>
 
    
    
    <!-- data Table-->
    <link rel="stylesheet" href="../dataTable/datatables.css">
    <script src="../dataTable/datatables.js"></script>
    
    <!--data datle bootstrap 5 -->
    <link rel="stylesheet" href="../dataTable/DataTables-1.11.3/css/dataTables.bootstrap5.css">
    <script src="../dataTable/DataTables-1.11.3/js/dataTables.bootstrap5.js"></script>

    <!-- styles propios -->
    <link rel="stylesheet" href="../Styles/navbar.css">
    <link rel="stylesheet" href="../Styles/styles.css">
  

    <!-- botones  -->
    <script src="../dataTable/Buttons-2.1.1/js/dataTables.buttons.js"></script>
    <script src="../dataTable/JSZip-2.5.0/jszip.js"></script>
    <script src="../dataTable/pdfmake-0.1.36/pdfmake.js"></script>
    <script src="../dataTable/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../dataTable/Buttons-2.1.1/js/buttons.html5.js"></script>
</head>
<body>
<?php
    $ruta1='cursos.php';
    $ruta2='../coordinador.php';
    $ruta3= 'bitacora.php';
    $ruta4='../clases/destroy.php';
    $rutLogo='../img/logo-unam.png';
    $rutLogoF='../img/logo-dgtic.png';
    ?>

<?php include('../components/navbarCord.php');?>

 <!--  titulo de la sección  *************************-->
  <div class="container-fluid title ">
        <div class="row">
                <div class="col-12">
                        <h1 ><i class="bi bi-pencil-square" style="font-size: 50px;"></i> Registro de Bitácora</h1>
                </div>
        </div>
    </div>
<!--  -->

  <div class="container table-bitacora">
        <table   id="loadTable" class=" table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>Id Bitacora</th>
                    <th>Nombre del Grupo</th>
                    <th>Nombre del Profesor</th>
                    <th>Nombre del Alumno</th>
                    <th>Calificación <br>Final</th>
                    <th>Datos de Registro</th>
                    <th>Acción</th>
            </thead>
            <tbody>

                <?php
                foreach ($bitacora  as $key => $dato) :
                ?>
                    <tr>
                        <td><?php echo $dato["id_bitacora"] ?></td>
                        <td><?php echo $dato["grupo"] ?></td>
                        <td><?php echo $dato["profesor"] ?></td>
                        <td><?php echo $dato["alumno"] ?></td>
                        <td><?php echo $dato["calificacion"] ?></td>
                        <td><?php echo $dato["fecha_hora"] ?></td>
                        <td>
                        <?php
                        echo '
                        <a onclick="eliminarB('.$dato['id_bitacora'].')" class="btn btn-primary" type="button">Eliminar</a>
                        ';
                        ?>
                        </td>
                    </tr>
                <?php

                endforeach;
                ?>
            </tbody>

        </table>
    </div>
    <div id="respuesta">
        
    </div>

      <!--  -->
      <?php include('../components/footer.php');?>

    <!--  -->
    <script src="../js/dataTable.js"></script>
    <script src="../js/prueba.js"></script>
</body>
</html>