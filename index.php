<?php
require("./conexion/conexionSYS.php");
require_once 'validar.php';
require_once 'keys.php';
include_once('../script.php');
$conexion = new conexionSYS;
$error = "";
/* voy a trabajar en index php */
if($_POST){
    function getCaptcha($SecretKey){
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    //var_dump($Return);
    if($Return->success == true && $Return->score > 0.5){
       try {
        if (isset($_POST['submit'])) {
            if (empty($_POST["email"]) || empty($_POST["pwd"])) {
                $error = "vacio";
                $error;
            } else {
                $error = "";
                $login = ltrim(rtrim($_POST["email"]));
                $pwd = ltrim(rtrim($_POST["pwd"]));
    
                $formato = validarCorreo($login);
                if ($formato == true) {
                    $buscar_Dominio = strpos($login, 'unam.mx');
                    if ($buscar_Dominio === false) {
                        $error2 = "El dominio del correo institucional debe ser unam.mx";
                    }
                } else {
                    $error2 = "El campo correo institucional no tiene el formato correcto.";
                }
    
                $query = "select * from usuario where correo ='$login'";
                $valdiar = $conexion->validar($query);
                $datos = $conexion->obtenerDatos($query);
                $contraseña = $datos['contraseña'];
                $valor = password_verify($pwd, $contraseña);
    
                if ($valdiar >= 1 &&  password_verify($pwd, $contraseña)) {
                    session_start();
                    $result = $conexion->obtenerDatos($query);
    
                    $id = $result['id_usuario'];
                    $rol1 = $conexion->obtenerRol($id);
    
    
                    $rol = $rol1[0];
                    $_SESSION['login'] = $result['correo'];
                    $_SESSION['id_usuario'] = $result['id_usuario'];
                    if ($rol == 1) {
    
                        header("location: ./administrador/inicio.php");
                    } else if ($rol == 2) {
    
                        header("location: ./coordinador/cursos.php");
                    } elseif ($rol == 3) {
    
                        header("location: ./profesor/cursos.php");
                    } else {
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
            $error = "";
        }
    } catch (Exception $e) {
        die("error:" . $e->getMessage());
    }
    }else{
        header("location: index.php");
    }
}

?>
<?php


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./Styles/estilosTabla.css">
    <link rel="stylesheet" href="./Styles/styles.css">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>
</head>

<body>
    <?php $rutLogoF='./img/logo-dgtic.png';?>
    <!--<?php //include('./components/header.php');?>-->
<!-- prueba en la rama -->
<div class="container-fluid">
        <!--prueba-->
        <div class="row contenedor-enlaces">
            <div class="col">
                <div class="shadow-lg mt-4 bg-body rounded ancho">
                    <h3 class="text-center fondo text-white pt-3 pb-3 mb-3 titulologin">Inicio de Sesión</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="p-4 p-md-6">
                            <div class="mb-3">
                                <label for="uname" class="form-label">Correo Institucional</label>
                                <span  id="datos" class="error ms-1">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id=""><i class="bi bi-person-fill"></i></span>
                                    </div>

                                    <input type="text" class="form-control" id="email" placeholder="Ej: ejemplo@dominio.mx" name="email" required>
                                    
                                </div>
                                <code><?php echo $error2 ?></code>
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">Contraseña</label>
                                <span  id="datos" class="error ms-1">*</span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id=""><i class="bi bi-lock-fill"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="inputPass" minlength="5" maxlength="25" name="pwd" value="" id="pwd" placeholder="Ej: Contraseña" required>
                                    <div class="valid-feedback"> Correcto</div>
                                    <div class="invalid-feedback">
                                 Ingrese una contraseña valida.   
                                    </div>
                                    <code><?php echo $error ?></code>
                                 </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" onclick="activarPass()" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Mostrar Contraseña
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br >
                            </div>
                            <!--  
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="myCheck" name="remember" required>
                                <label class="form-check-label" for="myCheck">I agree on blabla.</label>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Check this checkbox to continue.</div>
                            </div>-->
                            <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Ingresar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

   
    <?php include('./components/footer.php');?>

    <!--Recaptcha-->
    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'}).then(function(token) {
    //console.log(token);
    document.getElementById('g-recaptcha-response').value=token;
});
});
</script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>
    <script src="./js/bootstrap/popper.min.js"></script>
    <script src="./js/mostrarPass.js"></script>
</body>

</html>