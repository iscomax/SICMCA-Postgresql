<?php
//ini_set("display_errors", true);
require('../conexion/conexionSYS.php');
session_start();
$conexion = new conexionSYS;
if (empty($_POST["id"])) {
    $id_usuario = $_GET["id_usuario"];
    $id_persona = $_GET["id_persona"];
    $datosUsuario = $conexion->obtnerUsuario($id_usuario);
    //print_r($datosUsuario);
    foreach ($datosUsuario as $key => $dato) {
        $id = $dato['id_usuario'];
        $nombre = $dato['nombre'];
        $apellidos = $dato['apellidos'];
        $correo = $dato['correo'];
        $id_rol = $dato['id_rol'];
        $nombre_rol = $dato['nombre_rol'];
        //echo "usuario= " . $id_usuario;
        //echo "persona= " . $id_persona;
    }
} else {   

    $control= true;
    $id_persona = ltrim(rtrim($_POST["id_persona"]));//$_POST["id_persona"];
    $id_usuario = ltrim(rtrim($_POST["id"]));//$_POST["id"];;
    $nombre = ltrim(rtrim($_POST["nombre"]));//$_POST["nombre"];
    $apellidos = ltrim(rtrim($_POST["apellidos"]));//$_POST["apellidos"];
    $correo = ltrim(rtrim($_POST["correo"]));//$_POST["correo"];
    $id_rol = $_POST["roles"];
    $errorN="";
    if ( empty($nombre)) {
        echo '<script type="text/javascript"> window.alert("nombre vacio"); </script>';    
    }else{
        //echo '<script type="text/javascript"> window.alert("nombre vacio"); </script>';  
        $conexion->actualizarUsuario($id_usuario, $correo);
        $conexion->actualizarPersona($nombre, $apellidos, $id_persona);
        //$conexion->actualizarRol($id_rol, $id_usuario);
         echo "usuario= " . $id_usuario;
         echo "persona= " . $id_persona;
       //  header("location: ../adm.php");
      //  header("location: ../adm.php");
    }    
}

?>
