<?php
//ini_set("display_errors", true);
require_once('../clases/registro.php');
require_once('../conexion/conexionSYS.php');
require_once '../validar.php';
include_once('./script.php');
session_start();
if(isset($_SESSION['login'])){
  }
else
  header("location: ../index.php");
  try
  {
     $conectar = new conexionSYS();
     $id_usuario = $_SESSION['id_usuario'];
     $obtenerDatos =$conectar->obtnerUsuario($id_usuario);
     foreach($obtenerDatos as $datos=>$dato)
         $nombre = $dato['nombre'];
  
  }
catch (Exception $e){

}

$id = "";
$nombre = "";
$apellidos = "";
$correo = "";
$correo2="";
$estado="disabled";
//conectamos a la base de datos
$registro = new conexionSYS;
$conexionMoodle = new registro;
if (isset($_POST['buscar'])) {
  $str= ltrim(rtrim($_POST["correo"]));
  if($str==""){
    echo '<script> swal("ERROR","El campo no debe de estar vacío.", "error");</script>';
  }
  elseif(!validarCorreo($str)){
    echo '<script> swal("ERROR","El campo correo institucional no tiene el formato correcto.", "error");</script>';
  }

  elseif(!preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)*unam\.mx$/', $str)){
    echo '<script> swal("ERROR","El dominio del correo institucional debe ser unam.mx", "error");</script>';
  }
    elseif(!empty($str)){
      $correo = $str;
      $datos = $conexionMoodle->buscarDatos($correo);
      if($datos<=0)
      echo '<script> swal("ERROR","Usuario no encontrado, favor de verificarlo.", "error");</script>';
      $id = $datos['id'];
      $nombre = $datos['firstname'];
      $apellidos = $datos['lastname'];
      $correo = $datos['email'];
      $contra = $datos['password'];
      $correo2 = $datos['email'];
      $estado="";
    }
  }
include_once("./vAlta.php");


if($_POST['enviar']) {
  $correo = $_POST['correo2'];
  $datos = $conexionMoodle->buscarDatos($correo);
  $id = $datos['id'];
  if($id==""){
    echo '<script>swal("Favor de ingresar el correo institucional y/o tipo de usuario");</script>';
  }
  $validar=$registro->validarUsuarioId($id);
  if($validar == 1){
 
  }else{
        if(!empty($_POST["correo2"]) && $_POST["rol"]!=0) {
              $correo = $_POST['correo2'];
              $conexionMoodle = new registro;
              $datos = $conexionMoodle->buscarDatos($correo);
              $id = $datos['id'];
              $nombre = $datos['firstname'];
              $apellidos = $datos['lastname'];
              $correo = $datos['email'];
              $contra = $datos['password'];
              $correo2 = $datos['email'];
              $rol=$_POST['rol'];
              $long= strlen($contra);
              if ($long >12) 
                    $contraseña = $contra;
              else
                   $contraseña = password_hash($contra, PASSWORD_DEFAULT);   
              
              if($registro->obtenerRol($id)){
                echo '<script> swal("ERROR","El usuario ya está dado de alta, favor de verificarlo", "error");</script>';
              }else{
                $id_persona = $registro->insertPersona($nombre, $apellidos);
                try{
                  $registro->insertUsuario($id, $correo, $contraseña, $id_persona);
                }catch(Exception $e){

                }

                $filas = $registro->insertROL($rol, $id);

                echo '<script>swal("OK...", "El usuario ha sido registrado con éxito", "success");</script>';
              }
        
              
              unset($datos['id']);
              unset( $_POST['nombre']);
              unset($_POST['apellidos']);
              unset($_POST['correo']);
              unset($_POST['contra']);
              unset($_POST['rol']);
        }else{
          echo '<script> swal("ERROR","Seleccione el tipo de usuario", "error");</script>';
        }     
    }
  }
  
else {
  unset($_POST['id_moodle']);
  unset( $_POST['nombre']);
  unset($_POST['apellidos']);
  unset($_POST['correo']);
  unset($_POST['contra']);
  unset($_POST['rol']);
} 

?>