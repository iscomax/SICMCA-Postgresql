<?php
//ini_set("display_errors", true);
//require("../clases/registro.php");
require('../conexion/conexionSYS.php');
require('../conexion/conexion.php');

session_start();

if (isset($_SESSION['login'])) {
} else {
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

/******************************************/


if (empty($_POST['id_moodle']))
{  
    $conexion = new conexion;

    $usuarioReporte = $conexion->usuarioReporte();
    //print_r($listaUsuarios);
   // echo "vacio ";
  
    if ( isset($_POST['id_usuario']) && isset($_POST['id_persona'])) {
        $id_persona = $_POST['id_persona'];
        $id_usuario = $_POST['id_usuario'];

        /*echo "idU=".$id_usuario." "."idP= ".$id_persona;
        $conexion->eliminarRol($id_usuario);
        $conexion->eliminarUsuario($id_usuario);
        $conexion->eliminarPersona($id_persona);
        header("location: ../adm.php");
        */
        
    }

} else 
{
      //registro de usuarios
      $id = $_POST['id_moodle'];
      $nombre = $_POST['nombre'];
      $apellidos = $_POST['apellidos'];
      $correo = $_POST['correo'];
      $contraseña = $_POST['contra'];
      $rol=$_POST['rol'];
    $long= strlen($contraseña);

        if ($long >12) {
            //echo "no encripta";
            $contraseña = $_POST['contra'];
        } else{
            //echo "si encripta";
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);    
        }
      
      //conectamos a la base  dedatos
      $registro = new conexionSYS;
      $id_persona = $registro->insertPersona($nombre, $apellidos);
      $registro->insertUsuario($id, $correo, $contraseña, $id_persona);
     // echo "id personas= " . $id . "<br>";
     // echo "ROL= " . $rol . "<br>";
      $filas = $registro->insertROL($rol, $id);
     // echo "FILAS MOVIDAS " . $filas . "<br>";
     unset($_POST['id_moodle']);
     unset( $_POST['nombre']);
     unset($_POST['apellidos']);
     unset($_POST['correo']);
     unset($_POST['contra']);
     unset($_POST['rol']);

   // echo "insertar";
   header("location: ../adm.php");

}
include_once("./vBitacora.php");


//$conexion = new conexionSYS;
//$listaUsuarios = $conexion->listaUsuarios();
//print_r($listaUsuarios);
?>

