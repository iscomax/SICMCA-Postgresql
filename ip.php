<?php
//require("./clases/registro.php");
require('./conexion/conexionSYS.php');

session_start();
if (isset($_SESSION['login'])) {
} else {
    header("location: index.php");
}
/*******************************************/
try{
    $conectar = new conexionSYS();
    $id_usuario = $_SESSION['id_usuario'];
    $obtenerDatos =$conectar->obtnerUsuario($id_usuario);
    foreach($obtenerDatos as $datos=>$dato){
        $usuario = $dato['nombre'] ." ". $dato['apellidos'] ." ". $dato['nombre_rol'] ." ". $dato['correo'];
        $nombre = $dato['nombre'];
  

    }

}catch (Exception $e){



}


/*echo "Tu dirección IP es: {$_SERVER['REMOTE_ADDR']}";
echo "El nombre del servidor es: {$_SERVER['SERVER_NAME']}<hr>"; 
echo "Vienes procedente de la página: {$_SERVER['HTTP_REFERER']}<hr>"; 
echo "Te has conectado usando el puerto: {$_SERVER['REMOTE_PORT']}<hr>"; 
echo "El agente de usuario de tu navegador es: {$_SERVER['HTTP_USER_AGENT']}";*/
$direccionIP = $_SERVER['REMOTE_ADDR'];
$nombreServidor = $_SERVER['SERVER_NAME'];
$pagina = $_SERVER['HTTP_REFERER'];
$puerto = $_SERVER['REMOTE_PORT'];
$agenteNav = $_SERVER['HTTP_USER_AGENT'];
$fecha = date('Y-m-d H:i:s');
include_once('vIp.php');
?>


