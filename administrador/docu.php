<?php
require_once('../clases/registro.php');
require('../conexion/conexionSYS.php');
session_start();
if(isset($_SESSION['login'])){  
}else{
  header("location: ../index.php");  
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="../Styles/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<div id="navbar">
    <ul>
      <li><a href="../adm.php">Inicio</a></li>
      <li><a href="altas.php">Altas</a></li>
      <li ><a href="docu.php">Documentación</a></li>
       <li><a href="../ip.php">Datos Conexión</a></li>
      <li style="float:right"><a class="active" href="../clases/destroy.php">Cerrar Sesión</a></li>
    </ul>
</div>

   <div>
       <h1 class="titulos">Documentación</h1>
   </div>
   <div class="containerDocu">
     <a class="enlace" href="#">Diccionario de datos Moodle</a>
     <a class="enlace" href="#">Diccionario de datos SICMCA</a>
     <a class="enlace" href="#">Glosario</a>
     <a class="enlace" href="#">Manual de instalación Moodle</a>
     <a class="enlace" href="#">Manual de uso sistema SICMCA</a>
   </div>
</body>
</html>
