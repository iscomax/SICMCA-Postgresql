<?php
/*require("./conexion/conexionSYS.php");
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
        //echo "vacio";
    }
} catch (Exception $e) {
    die("error:" . $e->getMessage());
}*/

function validarCorreo($correo){

   
    if(filter_var($correo, FILTER_VALIDATE_EMAIL) === FALSE){
        return false;
     }else{
        return true;
     }
   
}

/*require("./conexion/conexionSYS.php");


$conexion = new conexionSYS;
$correo= "profesor2@comunidad.unam.mx";
$cont= "Profesor&123";
//$encritada = password_hash($cont, PASSWORD_DEFAULT);

$query= "select * from usuario where correo ='$correo'";
            $valdiar = $conexion->obtenerDatos($query);
$psd = $valdiar['contraseña'];

echo $psd;

if (password_verify($cont,$psd)) {
    echo "Entro12312";
} else {
    echo "no entro";
}


$long= strlen($encritada);


if ($long >10) {
   echo "no encripta";
} else{
    echo "si encripta";
}*/

?>