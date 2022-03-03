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
     <title>Inicio</title>
     <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="../Styles/estilosTabla.css">
     <link rel="stylesheet" href="../Styles/styles.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="../Styles/navbar.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<?php
  $rutLogoF='../img/logo-dgtic.png';

  date_default_timezone_set('America/Mexico_City');$fecha_actual = date("Y-m-d H:i:s");
  ?>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container-fluid">
            <a class="navbar-brand" href="https://www.unam.mx/" target="_blank">
                <img src="../img/logo-unam.png" alt="logo unam" width="40" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a href="./inicio.php" class="nav-link">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a href="./altas.php" class="nav-link">Altas</a>
                  </li>
                  <li class="nav-item">
                    <a href="../adm.php" class="nav-link">Lista de Usuarios</a>
                  </li>
                  <li class="nav-item">
                    <a href="./bitacora.php" class="nav-link">Bitácora de Actividades</a>
                  </li>
                  <li class="nav-item">
                    <a href="../ip.php" class="nav-link">Datos Conexión</a>
                  </li>
                  <li class="nav-item">
                        <a href="./noti.php" class="nav-link">Notificaciones</a>
                    </li>
                  <li class="nav-item">
                    <a href="./docu.php" class="nav-link">Documentación</a>
                  </li>
                </ul>
 
                <div class="d-flex">
                     <div class="btn-group">
                          <button type="button" class="btn btn-success  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                               <i class="bi bi-file-person-fill"></i>
                               <span class=" "><?php echo $nombre ?></span>
                         </button>
                         <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Datos de Usuario</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="../clases/destroy.php">Cerrar Sesión</a></li>
                         </ul>
                    </div>
                </div>
            </div>
      </div>
  </nav>

  <div class="container-fluid">
    <div class="row contenedor-enlaces">
      <div class="col">
        <div class="shadow-lg my-4 bg-body rounded ancho">
          <h5 class="text-center fondo text-white fs-5 pt-3 pb-3 mb-0">Bienvenid@... <span class=" "><?php echo $nombre ?></span></h5>
          <div class=" container bg-secondary p-2 text-dark bg-opacity-25 text-center">
            <h3 class="text-center bienvenidoTitulo">SICMCA</h3>
            <h5 class="text-center fs-5 pt-3 pb-3 bienvenidoTitulo">Sistema web de registro interno compatible con Moodle para la Universidad Nacional Autónoma de México</h5>
            <img src="../img/unam-escudo-azul.png" alt="escudo unam" width="100" class="d-inline-block align-text-top pb-1">
            <h3 class="text-center bienvenidoTitulo"><?php echo $fecha_actual ?></h3>

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