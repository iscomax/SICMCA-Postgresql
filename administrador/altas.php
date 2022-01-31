<?php
require_once('../clases/registro.php');
require('../conexion/conexionSYS.php');

session_start();
if(isset($_SESSION['login'])){  
}else{
  header("location: ../index.php");    
}


$id = "";
$nombre = "";
$apellidos = "";
$correo = "";

if (isset($_POST['buscar'])) {
 
    if (empty($_POST["correo"]))
    { 
      // echo "vacio";
      // echo "correo electronio".$correo;   
      header("location: ./altas.php"); 
    }else if(!empty($_POST["correo"])) {
        $correo = $_POST['correo'];
        $conexionMoodle = new registro;
        $datos = $conexionMoodle->buscarDatos($correo);
      // print_r($datos);
        $id = $datos['id'];
        $nombre = $datos['firstname'];
        $apellidos = $datos['lastname'];
        $correo = $datos['email'];
        $contra = $datos['password'];
        $correo2 = $datos['email'];

  }
}

if(!empty($_POST["enviar"])) {

 if (!empty($_POST["correo2"])) {
  $correo = $_POST['correo2'];
  $conexionMoodle = new registro;
  $datos = $conexionMoodle->buscarDatos($correo);
 //print_r($datos);
  $id = $datos['id'];
  $nombre = $datos['firstname'];
  $apellidos = $datos['lastname'];
  $correo = $datos['email'];
  $contra = $datos['password'];
  $correo2 = $datos['email'];
  $rol=$_POST['rol'];
  $long= strlen($contra);

        if ($long >12) {
            //echo "no encripta";
            $contraseña = $contra;
        } else{
            //echo "si encripta";
            $contraseña = password_hash($contra, PASSWORD_DEFAULT);    
        }
      
      //conectamos a la base  dedatos
      $registro = new conexionSYS;
      $id_persona = $registro->insertPersona($nombre, $apellidos);
      $registro->insertUsuario($id, $correo, $contraseña, $id_persona);
     //echo "id personas= " . $id . "<br>";
     // echo "ROL= " . $rol . "<br>";
      $filas = $registro->insertROL($rol, $id);
     // echo "FILAS MOVIDAS " . $filas . "<br>";
  
   unset($datos['id']);
    unset( $_POST['nombre']);
    unset($_POST['apellidos']);
    unset($_POST['correo']);
    unset($_POST['contra']);
     unset($_POST['rol']);
     header("location: ../adm.php");
 } else {
  header("location: ./altas.php"); 
 }
 
}else {
  unset($_POST['id_moodle']);
  unset( $_POST['nombre']);
  unset($_POST['apellidos']);
  unset($_POST['correo']);
  unset($_POST['contra']);
   unset($_POST['rol']);
  //echo '<script>alert("Por favor espera mientras cargamos los datos ")</script>';
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <link rel="stylesheet" href="../Styles/estilos.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
    
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light sticky-top fondo">
    <div class="container">
      <img src="https://www.unam.mx/sites/all/themes/unam/logo.png" alt="logo" width="auto" height="auto" class="mb-3 imagen">
      <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu" aria-controls="navbarmenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarmenu">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
           <li class="nav-item"><?php echo "<a class='nav-link active text-white menu-item p-2 text-center' aria-current='page' href='../adm.php'>Lista de Usuario</a>" ?>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white menu-item p-2  text-center" href="#">Altas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white menu-item p-2 text-center" href="docu.php">Documentación</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white menu-item p-2 text-center" href="../ip.php">Datos Conexión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white cerrar menu-item p-2 text-center" href="../clases/destroy.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-----------------Seccion formulario ------------------->
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="shadow-lg mt-4 bg-body rounded ancho">
          <h3 class="text-center fondo text-white fs-2 pt-3 pb-3 mb-3 titulologin">Altas</h3>
          <div class="p-3">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="buscar" name="buscar" class="row">
            <div class="col-md-12">
              <label for="txt_correo" class="form-label">Correo Institucional</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id=""><i class="bi bi-person-circle"></i></span>
                </div>
                <input type="text" class="form-control mb-3"  placeholder="Ingrese un correo institucional"  id="correo" name="correo" value="<?php echo $correo ?>" Required>
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary" name="buscar" value="submit">BUSCAR</button>
                </div>
            </div>
          </div>
          </form>
        </div>
        <!--Envio de datos a adm.php-->
        <div class="p-3">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="for1" name="for1" class="row g-3">
        <div class="col-md-12">
           <input name="correo2" id="correo2" value="<?php echo $correo2 ?>" type="hidden">
           <label for="fname" class="form-label">Id Moodle</label>
           <input type="text" class="form-control" id="id_moodle" name="id_moodle" value="<?php echo $id ?>"disabled>
        </div>
        <div class="col-md-12">
          <label for="fname" class="form-label"> Nombre(s)</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>"disabled>
        </div>
        <div class="col-md-12">
           <label for="fname" class="form-label">Apellidos</label>
           <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos ?>"disabled>
        </div>
        <div class="col-md-12">
          <label for="fname" class="form-label">Correo Institucional</label>
          <input type="text" class="form-control" id="correo" name="correo" value="<?php echo $correo ?>" disabled>
        </div>
        <div class="col-md-12">
          <label for="fname" class="form-label">Contraseña</label>
          <input type="text" class="form-control" id="contra" name="contra" value="<?php echo $contra?>" disabled>
        </div>
        <div class="input-group col-md-3 mb-2">
          <label for="fname" class="input-group-text">Tipo de Usuario</label>
          <input type="hidden" name="rol" id="rol" size="30" ><br>
          <select name="rol" class="form-select" required>
            <option selected disabled>Seleccione...</option>
            <option value="1">Administrador</option>
            <option value="2">Coordinador</option>
            <option value="3">Profesor</option>
          </select>
          <br>
        </div>
        <div class="mb-3 text-center">
          <input  class="btn btn-primary"  type="submit" onclick="" name= "enviar"  value="Enviar">
        </div>
      </form>
        </div>
    </div>
  </div>
</div>
</div>
</div>

    <script>
     $('#editar').click(function() {

var resultado = window.confirm('¿Estas seguro de actualizar los datos?');
if (resultado === true) {
    var id = document.getElementById('id_moodle').value;

    var nombre = document.getElementById('nombre').value;
    var apellidos = document.getElementById('apellidos').value;
    var correo = document.getElementById('correo').value;
    var rol = document.getElementById('rol').value;

    var validar= validarForm(nombre, apellidos, correo);

    if (validar ===true) {
        var ruta = "id=" + id + "&nombre=" + nombre + "&apellidos=" + apellidos + "&correo=" + correo + "&rol=" + rol + "&id_persona=" + id_persona;
    console.log(ruta);
    $.ajax({
            url: '../adm.php',
            type: 'POST',
            data: ruta,
        })
        .done(function(res) {
            console.log('resut =',res)
            $('#respuesta').html(res);
        })
        .fail(function() {
            console.log('error');
        })
        .always(function() {
            console.log('complete');
        });
       //location.href ="../adm.php";

    } 
     
    //e.preventDefault();

} else {
    window.alert('Se ha cancelado la edición de datos');
    location.href ="../adm.php";
}

})
    </script>

<script src="../js/validacionEditar.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap/popper.min.js"></script>
<script src="../js/bootstrap/bootstrap.min.js"></script>

</body>
<?php include('../templates/footer.php'); ?>
</html>
