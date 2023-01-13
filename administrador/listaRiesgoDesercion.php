<?php
//ini_set("display_errors", true);
require('../conexion/conexion.php');
require('../conexion/conexionSYS.php');
session_start();

if(!isset($_SESSION['login']))
  header("location: ../index.php"); 

try{
     $conectar = new conexionSYS();
     $id_usuario = $_SESSION['id_usuario'];
     $obtenerDatos =$conectar->obtnerUsuario($id_usuario);
     foreach($obtenerDatos as $datos=>$dato)
         $nombre = $dato['nombre'];

 }catch (Exception $e){
     echo '<script> alert("Error")</script>';
 }

$conexion = new conexion;

if (!empty($_GET["id_usuario"])) {
      $id_usuario = $_GET["id_usuario"];
     $lista = $conexion->obtenerBitacora($id_usuario); 
 }
 $riesgoDesercion = $conexion->riesgoDesercion();
 //print_r($riesgoDesercion);
 
 include ("./vRiesgoDesercion.php");
?>