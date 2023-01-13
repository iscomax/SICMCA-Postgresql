<?php
//ini_set("display_errors", true);
require('../conexion/conexionSYS.php');
require('../clases/registro.php');
include_once('./script.php');
session_start();

if(!isset($_SESSION['login']))
  header("location: ../index.php");  

try{
  $correo=$_GET['correo'];
    $conectar = new conexionSYS();
    $id_usuario = $_SESSION['id_usuario'];
    $obtenerDatos =$conectar->obtnerUsuario($id_usuario);
    foreach($obtenerDatos as $datos=>$dato)
        $nombre = $dato['nombre'];
    $tipoEstrategia = new conexionSYS();
    $tipoEstrategia = $tipoEstrategia->obtenerTipoEstrategia();
    //conectamos a la base de datos
    $registro = new conexionSYS;
    $conexionMoodle = new registro;
    
    if(!empty($_POST["enviar"])) {
        $correo= ltrim(rtrim($_POST["correo"]));//$_POST["correo"];
        $medio= $_POST["medio"];
        $tipoEstrategiaR= $_POST["tipoEstrategia"];
        $estrategia= ltrim(rtrim($_POST["txtEstrategia"]));//$_POST["txtEstrategia"];
        $validar= $conexionMoodle->buscarDatos($correo);
        if($validar == "" ){
          echo '<script> swal("ERROR","El correo institucional no es válido, favor de verificarlo.", "error");</script>';
        }else{
          try{
            $registro->insertEstrategia($tipoEstrategiaR, $correo, $medio, 1, $nombre);
            echo '<script>swal("OK...", "la estrategia ha sido registrado con éxito", "success");</script>';
            header ("refresh:2;url=listaEstrategias.php");
          }catch(Exception $e){
            //print_r ($e);
            echo '<script> swal("ERROR","No se puede guardar la estrategia.", "error");</script>';
          }
        }
    }
  }catch (Exception $e){

}


?>
 <?php include('./vEstrategias.php'); ?>
