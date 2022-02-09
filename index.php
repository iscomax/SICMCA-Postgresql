<?php
require("./conexion/conexionSYS.php");
require_once 'validar.php';
require_once 'keys.php';
$conexion = new conexionSYS;
$error = "";

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
                $login = $_POST["email"];
                $pwd = $_POST["pwd"];
    
                $formato = validarCorreo($login);
                if ($formato == true) {
                    $buscar_Dominio = strpos($login, 'unam.mx');
                    if ($buscar_Dominio === false) {
                        $error2 = "Tienes que tener una cuenta unam.mx";
                    }
                } else {
                    $error2 = "Formato del correo Invalido";
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
    
                        header("location: adm.php");
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
    <link rel="stylesheet" href="./Styles/styles.css">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>
</head>

<body>
    <?php $rutLogoF='./img/logo-dgtic.png';?>
    <?php include('./components/header.php');?>
<!-- prueba en la rama -->
<div class="container boxLogin">
        <!--prueba-->
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4 col-xxl-4">
                <div class="container mt-3">
                    <div class="card" style="border-color:  #1C3D6C;  border-style: solid;">
                        <div class="card-header cardHeader">
                            
                            <h6 class="text-center">Inicio de Sesión</h6>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation p-4 p-md-6 border rounded-3 bg-light" novalidate>
                            <div class="mb-3 mt-3">
                                <label for="uname" class="form-label">Correo Institucional</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id=""><i class="bi bi-person-fill"></i></span>
                                    </div>

                                    <input type="text" class="form-control" id="email" placeholder="@" name="email" required>
                                    <div class="valid-feedback"></div>
                                    
                                </div>
                                <code><?php echo $error2 ?></code>
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">Contraseña</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id=""><i class="bi bi-lock-fill"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="inputPass" minlength="5" maxlength="25" name="pwd" value="" id="pwd" placeholder="Contraseña" required>
                                    <div class="valid-feedback"></div>
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
                            <button type="submit" name="submit" class="btn btn-primary">Ingresar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- style ="border-color:  #1C3D6C;  border-style: solid;" -->
    <?php include('./components/footer.php');?>

    <!--Script para mostrar y ocultar contraseña-->
    <script type="text/javascript">
    function activarPass(){
        var cambiar = document.getElementById("inputPass");
        if(cambiar.type==="password"){
            cambiar.type="text";
        }else{
            cambiar.type="password";
        }
    }
    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <script>
        grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'})
        .then(function(token) {
            //console.log(token);
            document.getElementById('g-recaptcha-response').value=token;
            });
        });
    </script>

    <script src="./js/bootstrap/bootstrap.min.js"></script>
    <script src="./js/bootstrap/popper.min.js"></script>
</body>

</html>