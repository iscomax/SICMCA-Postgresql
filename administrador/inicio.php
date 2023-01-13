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
     <meta http-equiv="refresh" content="1800;url=../clases/destroy.php">
     <title>Inicio</title>
     <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="../Styles/estilosTabla.css">
     <link rel="stylesheet" href="../Styles/styles.css">
     <link rel="stylesheet" href="../Styles/stylesDash.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="../Styles/navbar.css">
     <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
</head>
<?php include('../components/navbarAdministrador.php'); ?>
<body>
<?php
  $rutLogoF='../img/logo-dgtic.png';

  date_default_timezone_set('America/Mexico_City');$fecha_actual = date("Y-m-d H:i:s");
  ?>
  <!--  Título-->
  <div class="container-fluid title">
    <div class="row">
      <div class="col-12">
        <h1 ><i class="bi bi-mortarboard-fill me-3"style="font-size: 40px;"></i>SICMCA</h1>
      </div>
    </div>
  </div>
  <div class="container-fluid pb-4">
    <div class="row contenedor-enlaces pt-5">
      <div class="col">
        <div class="shadow-lg my-4 bg-body rounded ancho">
          <h5 class="text-center fondo text-white fs-5 pt-3 pb-3 mb-0">Bienvenid@... <span class=" "><?php echo $nombre ?></span></h5>
          <div class=" container bg-secondary p-2 text-dark bg-opacity-25 text-center">
            <h5 class="text-center fs-5 pt-3 pb-3 bienvenidoTitulo">Sistema web de registro interno compatible con Moodle para la Universidad Nacional Autónoma de México</h5>
            <img src="../img/unam-escudo-azul.png" alt="escudo unam" width="100" class="d-inline-block align-text-top pb-1">
            <h3 class="text-center bienvenidoTitulo"><?php echo $fecha_actual ?></h3>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--Popper y bootstrap -->
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap/popper.min.js"></script>
  <script src="../js/bootstrap/bootstrap.min.js"></script>

  <!-- Footer -->
<?php include('../components/footer.php'); ?>
</body>

</html>