<?php 
session_start();
require("./conexion/conexionSYS.php");
if(isset($_SESSION['login'])){ 
    $id = $_SESSION['id_usuario']; 
}else{
  header("location: index.php");
}
$id =$_POST['id_moodle'];
$nombre =$_POST['nombre'];
$apellidos =$_POST['apellidos'];
$correo =$_POST['correo'];
$contraseña=$_POST['contra'];
$rol=$_POST['rol']; 


$registro = new conexionSYS;
$id_persona=$registro->insertPersona($nombre, $apellidos);
$registro->insertUsuario($id, $correo, $contraseña, $id_persona);
//echo "id personas= ".$id_persona."<br>";
//echo "ROL= ". $rol."<br>";
$filas = $registro->insertROL($rol, $id);
//echo "FILAS MOVIDAS ".$filas."<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>
<body>
    <h1>Panel de Administración</h1>
</body>
</html>