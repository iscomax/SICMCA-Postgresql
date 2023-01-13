<?php
//ini_set("display_errors", true);
require_once('../clases/registro.php');
require('../conexion/conexionSYS.php');
//session_set_cookie_params(60,"../clases/destroy.php");
session_start();
if(isset($_SESSION['login'])){  
}else{
  header("location: ../index.php");    
}
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
   $conexion = new conexion;
   $ultimoAcceso= $conexion->ultimoAccesoPlataforma($id_usuario);
   //print_r($tiempoPlataforma);
   $tiempoPlataforma =$conexion->tiempoPlataforma($id_usuario);
   include ("./vDash.php");
?>

