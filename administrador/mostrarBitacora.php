<?php
//ini_set("display_errors", true);
require('../conexion/conexion.php');
require('../conexion/conexionSYS.php');
session_start();
if (isset($_SESSION['login'])) {
} else {
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

if (!empty($_GET["id_usuario"])) {
      $id_usuario = $_GET["id_usuario"];
     $usuarioBitacora = $conexion->obtenerBitacora($id_usuario);  
  
    
 // print_r ($dato);
 }
 include ("./vMostrarBitacora.php");
?>
