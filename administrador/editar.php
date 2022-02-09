<?php
require('../conexion/conexionSYS.php');
session_start();
if (isset($_SESSION['login'])) {
} else {
    header("location: index.php");
}

$conexion = new conexionSYS;
if (empty($_POST["id"])) {
    $id_usuario = $_GET["id_usuario"];
    $id_persona = $_GET["id_persona"];
    $datosUsuario = $conexion->obtnerUsuario($id_usuario);
    //print_r($datosUsuario);
    foreach ($datosUsuario as $key => $dato) {
        $id = $dato['id_usuario'];
        $nombre = $dato['nombre'];
        $apellidos = $dato['apellidos'];
        $correo = $dato['correo'];
        $id_rol = $dato['id_rol'];
        $nombre_rol = $dato['nombre_rol'];
        //echo "usuario= " . $id_usuario;
        //echo "persona= " . $id_persona;
    }
 
} else {   

    $id_persona = $_POST["id_persona"];
    $id_usuario = $_POST["id"];;
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $id_rol = $_POST["roles"];
    $errorN="";
    if ( empty($nombre)) {
      
        echo "nombre vacio";
    }else{

        $conexion->actualizarUsuario($id_usuario, $correo);
        $conexion->actualizarPersona($nombre, $apellidos, $id_persona);
        $conexion->actualizarRol($id_rol, $id_usuario);
        // echo "usuario= " . $id_usuario;
        // echo "persona= " . $id_persona;
        // header("location: ../adm.php");
        header("location: ../adm.php");
    }    
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
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
                          <a href="#" class="nav-link">Altas</a>
                      </li>
                      <li class="nav-item">
                          <a href="./docu.php" class="nav-link">Documentación</a>
                      </li>
                      <li class="nav-item">
                          <a href="../ip.php" class="nav-link">Datos Conexión</a>
                      </li>
                </ul>
 
                <div class="d-flex">
                      <a href="../clases/destroy.php">
                          <button class="btn btn-danger">Cerrar Sesión</button>
                      </a>
                </div>
            </div>
      </div>
  </nav>
    <!----------------------------------------->
   
    <!-----------------Seccion formulario ------------------->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="shadow-lg mt-4 bg-body rounded ancho">
                    <h3 class="text-center fondo text-white  fs-2 pt-3 pb-3 mb-5 titulologin">Editar Usuario</h3>
                    <div class="p-3">
                        <div class="col-md-12">
                            <input type="hidden"  class="form-control" id="id_persona" name="id_persona" value="<?php echo $id_persona ?>" >
                            <label for="fname" class="form-label ">Id Moodle</label>
                            <input type="text" class="form-control mb-3" id="id_moodle" value="<?php echo $id ?>"disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label "> Nombre(s)</label>
                            <span  id="datos" class="error">* <?php  echo $e_Nombre?></span>
                            <input type="text" class="form-control mb-3" id="nombre" name="nombre"   minlength="6" maxlength="40" onkeypress="return (event.charCode < 33 || event.charCode > 64)"     value="<?php echo $nombre ?>" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label ">Apellidos</label>
                            <span  id="datos" class="error">* <?php ?></span>
                            <input type="text" class="form-control mb-3" id="apellidos" name="apellidos"  minlength="6" maxlength="40" onkeypress="return (event.charCode < 33 || event.charCode > 64)" value="<?php echo $apellidos ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label ">Correo Institucional</label>
                            <span  id="datos" class="error">* <?php ?></span>
                            <input type="text" class="form-control mb-3" id="correo" name="correo" value="<?php echo $correo ?>" Required>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label">Tipo de Usuario</label>
                            <input type="text" class="form-control mb-3" id="roles" value="<?php echo $nombre_rol ?>"disabled>
                        </div>
                        <div class="mb-3 text-center">
                            <p id="error"></p>
                            <button href="../adm.php" class="btn btn-warning mt-3 me-3 fw-bold text-white" type="" id="editar" name="editar">Actualizar</button>
                            <button class="btn btn-primary mt-3 me-3 fw-bold">Enviar Contraseña</button>
                            <?php
                            echo "<a href='../adm.php'   class='btn btn-success mt-3  fw-bold' type='button'>Regresar</a>";
                            ?>
                        </div> 
                    </div>                    
             
                </div>
            </div>
        </div>
    </div>

    <div id="respuesta">
        
    </div>   
    

<script src="../js/validacionEditar.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap/popper.min.js"></script>
<script src="../js/bootstrap/bootstrap.min.js"></script>

</body>

<?php include('../templates/footer.php'); ?>

</html>
