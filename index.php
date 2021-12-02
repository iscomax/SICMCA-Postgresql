<?php
require("./conexion/conexionSYS.php");
require_once 'validar.php';
$conexion = new conexionSYS;
$error = "";
try {
    if (isset($_POST['submit'])) 
    {
        if (empty($_POST["email"]) || empty($_POST["pwd"])) 
        {
            $error="vaciio";
            echo $error;
        } else 
        {
            $error="";
           $login = $_POST["email"]; 
           $pwd = $_POST["pwd"];
           
            $formato = validarCorreo($login);
            if ($formato ==true) {
                $buscar_Dominio = strpos($login,'unam.mx');
                if ($buscar_Dominio === false) {
                    $error2 ="Tienes que tener una cuenta unam.mx";
                }
            }else {
                $error2 ="Formato del correo Invalido";
            }

            $query= "select * from usuario where correo ='$login'";
          $valdiar = $conexion->validar($query);
            $datos = $conexion->obtenerDatos($query);
             $contraseña = $datos['contraseña'];
           password_verify($pwd,$contraseña);
            if ($valdiar >=1 &&  password_verify($pwd,$contraseña) ) {
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

                    header("location: ./coordinador/cursos.php");
                }elseif($rol==3){
                 
                   header("location: ./profesor/cursos.php");
                }else{
                  //  echo "rol no identificado = ". $rol;
                  
                }
                
                
            } else {

               //echo $login.$pwd ;
               //El correo electrónico que ingresaste no está conectado a una cuenta , No se ha encontado un usuario con esa dirección de correo <br> 
               $error = "Debe ingresar una contraseña y/o un correo institucional validos";
               //header("location: index.php");
            }
            
        }
    } else {
       // header("location: index.php");
        //echo "vacio";
    }
} catch (Exception $e) {
    die("error:" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./Styles/styles.css">
</head>
<body>

   <div class="containerLog login">
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <span class="error">* <?php echo $error ?></span><br>
        <label for="">Correo  Institucional</label>
        <span class="error">* <?php echo $error2 ?></span>
        <input type="text"  name="email" value="" Required>
        <label for="">Contraseña</label>
        <span class="error">* <?php  ?></span>
        <input type="password"  minlength="5" maxlength="25" name="pwd" value=""  Required>
        <input type="submit" name="submit" class="button loginB"  value="Ingresar">
    </form>
   </div>
</body>
</html>