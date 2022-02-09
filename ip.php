<?php
//require("./clases/registro.php");
require('./conexion/conexionSYS.php');

session_start();
if (isset($_SESSION['login'])) {
} else {
    header("location: index.php");
}
/*******************************************/
try{
    $conectar = new conexionSYS();
    $id_usuario = $_SESSION['id_usuario'];
    $obtenerDatos =$conectar->obtnerUsuario($id_usuario);
    foreach($obtenerDatos as $datos=>$dato){
        $usuario = $dato['nombre'] ." ". $dato['apellidos'] ." ". $dato['nombre_rol'] ." ". $dato['correo'];
        $nombre = $dato['nombre'];
  

    }

}catch (Exception $e){



}


/*echo "Tu dirección IP es: {$_SERVER['REMOTE_ADDR']}";
echo "El nombre del servidor es: {$_SERVER['SERVER_NAME']}<hr>"; 
echo "Vienes procedente de la página: {$_SERVER['HTTP_REFERER']}<hr>"; 
echo "Te has conectado usando el puerto: {$_SERVER['REMOTE_PORT']}<hr>"; 
echo "El agente de usuario de tu navegador es: {$_SERVER['HTTP_USER_AGENT']}";*/
$direccionIP = $_SERVER['REMOTE_ADDR'];
$nombreServidor = $_SERVER['SERVER_NAME'];
$pagina = $_SERVER['HTTP_REFERER'];
$puerto = $_SERVER['REMOTE_PORT'];
$agenteNav = $_SERVER['HTTP_USER_AGENT'];
$fecha = date('Y-m-d H:i:s');
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Cliente</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="./Styles/estilosTabla.css">
     <link rel="stylesheet" href="./Styles/styles.css">
     <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="./Styles/navbar.css">
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
                          <a href="./adm.php" class="nav-link">Lista de Usuarios</a>
                      </li>
                      <li class="nav-item">
                          <a href="./administrador/altas.php" class="nav-link">Altas</a>
                      </li>
                      <li class="nav-item">
                          <a href="./administrador/docu.php" class="nav-link">Documentación</a>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">Datos Conexión</a>
                      </li>
                </ul>
                <div class="btn btn-danger perfil">
                      <i class="bi bi-file-person-fill"></i>
                      <span class=""><?php echo $nombre?></span>
                </div>
                <div class="d-flex">
                      <a href="./clases/destroy.php">
                          <button class="btn btn-danger">Cerrar Sesión</button>
                      </a>
                </div>
            </div>
      </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="shadow-lg mt-2 mb-2 bg-body rounded ancho">
                <h3 class="text-center fondo text-white fs-2 pt-3 pb-3 mb-3 titulologin">Actividad</h3>
                <div class="container pb-2">
                    <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="datatable">
                        <tbody>
                            <tr>
                                <td>Datos de Usuario: </td>
                                <td><?php echo $usuario ?></td>
                            </tr>                           
                            <tr>
                                <td>Dirección IP es:</td>
                                <td><?php echo $direccionIP ?></td>
                            </tr>
                            <tr>
                                <td>Nombre del servidor es:</td>
                                <td><?php echo $nombreServidor ?></td>
                            </tr>
                            <tr>
                                <td>Página Visitada:</td>
                                <td><?php echo $pagina ?></td>
                            </tr>
                            <tr>
                                <td>Puerto de Conexión</td>
                                <td><?php echo $puerto ?></td>
                            </tr>
                            <tr>
                                <td>Agente de usuario del Navegador</td>
                                <td><?php echo $agenteNav ?></td>
                            </tr>
                            <tr>
                                <td>Fecha y hora</td>
                                <td><?php echo $fecha ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap/popper.min.js"></script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>

    <?php include('./components/footer.php'); ?>
</body>

</html>