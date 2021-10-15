<?php
require("./conexion/conexionSYS.php");

$conexion = new conexionSYS;
$error = "";
try {
    if (isset($_POST['submit'])) 
    {
        if (empty($_POST["email"]) || empty($_POST["pwd"])) 
        {
            $error="Debe ingresar una contraseña y/o un correo institucional validos";
            echo $error;
        } else 
        {
            $login = $_POST["email"]; 
            $pwd = $_POST["pwd"];
            $query= "select * from usuario where correo ='$login' and contraseña='$pwd'";
            $valdiar = $conexion->validar($query);
          
            if ($valdiar >=1) {
                session_start();
                $result= $conexion->obtenerDatos($query);

                $id = $result['id_usuario'];
                $rol1= $conexion->obtenerRol($id);
                

                 $rol = $rol1[0];
                 $_SESSION['login']= $result['correo'];
                 $_SESSION['id_usuario']= $result['id_usuario'];
                if ($rol ==1) {

                    header("location: adm.php");
                } else if($rol==2){

                    header("location: coordinador.php");
                }elseif($rol==3){
                 
                   header("location: profesor.php");
                }else{
                  //  echo "rol no identificado = ". $rol;
                }
                
                
            } else {

               // echo $login.$pwd ;
               // header("location: index.php");
            }
            
        }
    } else {
       // header("location: index.php");
       // echo "vacio";
    }
} catch (Exception $e) {
    die("error:" . $e->getMessage());
}
