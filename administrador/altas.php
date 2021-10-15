<?php
require_once('../clases/registro.php');
/*session_start();
if(isset($_SESSION['login'])){  
}else{
  header("location: index.php");  
}*/

$id = "";
$nombre = "";
$apellidos = "";
$correo = "";

if (empty($_POST["correo"]))
{ 
   // echo "vacio";
   // echo "correo electronio".$correo;   
}else{
    $correo = $_POST['correo'];
    $conexionMoodle = new registro;
    $datos = $conexionMoodle->buscarDatos($correo);
  //  print_r($datos);
    $id = $datos['id'];
    $nombre = $datos['firstname'];
    $apellidos = $datos['lastname'];
    $correo = $datos['email'];
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
      <li><a href="#news">News</a></li>
      <li ><a href="#contact">Contacto</a></li>
      <li style="float:right"><a class="active" href="../clases/destroy.php">Cerrar Sesión</a></li>
    </ul>
  </div>




    
    <div class="container admform">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="buscar" name="buscar">
    <label for="txt_correo">Ingresa un Correo Intitucional</label>
    <input type="text" name="correo" id="correo" value="">
    <button type="submit" class="button loginB" value="submit">BUSCAR</button>
    </form>
    <!-- mandamos info a adm.php texto. -->
    <form action="../adm.php" method="post" id="for1" name="for1">
      <label for="fname">Id Moodle</label>
      <input type="text" id="id_moodle" name="id_moodle" value="<?php echo $id ?>" >
      
      <label for="fname">Nombre (s)</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" >

      <label for="fname">Apellidos</label>
      <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos?>" >

      <label for="fname">Correo Institucional</label>
      <input type="text" id="correo" name="correo" value="<?php echo $correo ?>" >
      
      <label for="fname">Contraseña</label>
      <input type="text" id="contra" name="contra" value="">

      <label for="fname">Tipo de Usuario</label>
       <input type="hidden" name="rol" size="30"><br>
       
        <select name="rol">
        <option value="1">Administrador</option>
        <option value="2">Coordinador</option>
        <option value="3">Profesor</option>
        </select>
        <br>

      <input  class="button loginB"  type="submit" onclick="" name= "submit"  value="Enviar">

    </form>
    </div>
    <script>
    
    </script>
</body>
</html>