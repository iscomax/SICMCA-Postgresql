<?php
require_once('../clases/registro.php');
require('../conexion/conexionSYS.php');
session_start();
if(isset($_SESSION['login'])){  
}else{
  header("location: ../index.php");  
}
/*******************************************/
try{
  $conectar = new conexionSYS();
  $id_usuario = $_SESSION['id_usuario'];
  $obtenerDatos =$conectar->obtnerUsuario($id_usuario);
  foreach($obtenerDatos as $datos=>$dato){
      /*$usuario = $dato['nombre'] ." ". $dato['apellidos'] ." ". $dato['nombre_rol'] ." ". $dato['correo'];*/
      $nombre = $dato['nombre'];


  }

}catch (Exception $e){



}
/***************************************************/ 
?>

<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="refresh" content="10;url=../clases/destroy.php">
     <title>Bitácora</title>
     <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="../Styles/estilosTabla.css">
     <link rel="stylesheet" href="../Styles/styles.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="../Styles/navbar.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<?php include('../components/navbarAdministrador.php'); ?>
<body>
<?php
  $rutLogoF='../img/logo-dgtic.png';
  ?>
  <!--Popper y bootstrap -->
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap/popper.min.js"></script>
  <script src="../js/bootstrap/bootstrap.min.js"></script>

  <!-- Footer -->
<?php include('../components/footer.php'); ?>
</body>

</html>