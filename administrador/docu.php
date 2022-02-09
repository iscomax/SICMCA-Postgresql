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
    <title>Documentación</title>
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

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container-fluid">
            <a class="navbar-brand" href="">
                <img src="<?php echo $rutLogo ?>" alt="" width="40" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                      <li class="nav-item">
                          <a href="../adm.php" class="nav-link">Lista de Usuarios</a>
                      </li>
                      <li class="nav-item">
                          <a href="./altas.php" class="nav-link">Altas</a>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">Documentación</a>
                      </li>
                      <li class="nav-item">
                          <a href="../ip.php" class="nav-link">Datos Conexión</a>
                      </li>
                </ul>
                <div class="btn btn-danger perfil">
                      <i class="bi bi-file-person-fill"></i>
                      <span class=""><?php echo $nombre?></span>
                </div>
                <div class="d-flex">
                      <a href="../clases/destroy.php">
                          <button class="btn btn-danger">Cerrar Sesión</button>
                      </a>
                </div>
            </div>
      </div>
</nav>

  <!--Sección Enlaces-->

  <div class="container-fluid contenedor-enlaces">
    <div class="row">
      <div class="col">
        <div class="shadow-lg mt-2 mb-2 bg-body rounded ancho">
          <h3 class="text-center fondo text-white fs-2 pt-3 pb-3 mb-3 titulologin">Documentación</h3>
          <div class=" container p-3" width="100%">
            <div class="col-md-12 p-2">
              <a class="enlaces docu" href="../reportesPDF/reporteMoodle.php">Diccionario de datos Moodle</a>
            </div>
            <div class="col-md-12 p-2">
              <a class="enlaces docu" href="#">Diccionario de datos SICMCA</a>
            </div>
            <div class="col-md-12 p-2">
              <a class="enlaces docu" href="#">Glosario</a>
            </div>
            <div class="col-md-12 p-2">
              <a class="enlaces docu" href="#">Manual de instalación Moodle</a>
            </div>
            <div class="col-md-12 p-2">
              <a class="enlaces docu" href="#">Manual de uso sistema SICMCA</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      <!--Popper y bootstrap -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap/popper.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>


</body>
      <!-- Footer -->
      <?php include('../components/footer.php'); ?>
</html>
