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
 echo $result;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bitácora</title>
  <link rel="stylesheet" href="../Styles/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div id="navbar">
        <ul>
            <li></li>
            <li><?php echo " <a href='./cursos.php'>Cursos</a>" ?></li>
            <li><?php echo " <a href='../coordinador.php'>Grupos</a>" ?></li>
            <li><?php echo " <a href=''>Bitácora</a>" ?></li>
           
            <li style="float:right"><a class="active" href="../clases/destroy.php">Cerrar Sesión</a></li>
        </ul>
    </div>
<div class="titulos">
<h1>Registro de Bitácora</h1>
</div>
  <div class="containerTAB">
        <table  class="paleBlueRows" id="datatable">
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
                       
                        <a id="" class="button"  onclick="eliminarB('.$dato['id_bitacora'].')" type="button">Eliminar</a>
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
    <script src="../js/prueba.js"></script>
</body>
</html>