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
    <link rel="stylesheet" href="../Styles/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<div id="navbar">
    <ul>
      <li><a href="../adm.php">Inicio</a></li>
      <li><a href="#">Altas</a></li>
      <li ><a href="docu.php">Documentación</a></li>
       <li><a href="../ip.php">Datos Conexión</a></li>
      <li style="float:right"><a class="active" href="../clases/destroy.php">Cerrar Sesión</a></li>
    </ul>
</div>

    <div class="container admform">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="buscar" name="buscar">
    <label for="txt_correo">Ingresa un Correo Intitucional</label>
    <input type="text" name="correo" id="correo" value="<?php echo $correo ?>">
    <button type="submit" class="button loginB" name="buscar" value="submit">BUSCAR</button>
    </form>
    <!-- mandamos info a adm.php texto. -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="for1" name="for1">
    <input name="correo2" id="correo2" value="<?php echo $correo2 ?>" type="hidden">
      <label for="fname">Id Moodle</label>
      <input type="text" id="id_moodle" name="id_moodle" value="<?php echo $id ?>"disabled >
      
      <label for="fname">Nombre (s)</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" disabled>

      <label for="fname">Apellidos</label>
      <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos?>"disabled>

      <label for="fname">Correo Institucional</label>
      <input type="text" id="correo" name="correo" value="<?php echo $correo ?>"disabled >
      
      <label for="fname">Contraseña</label>
      <input type="text" id="contra" name="contra" value="<?php echo $contra?>" disabled>

      <label for="fname">Tipo de Usuario</label>
       <input type="hidden" name="rol" size="30"><br>
       
        <select name="rol">
        <option value="1">Administrador</option>
        <option value="2">Coordinador</option>
        <option value="3">Profesor</option>
        </select>
        <br>

      <input  class="button loginB"  type="submit" onclick="" name= "enviar"  value="Enviar">

    </form>
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
</body>
</html>
