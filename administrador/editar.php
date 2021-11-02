<?php
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

    $id_persona = $_POST["id_persona"];
    $id_usuario = $_POST["id"];;
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $id_rol = $_POST["roles"];
    $errorN="";
    if ( empty($nombre)) {
      
        echo "nombre vacio";
    }else{

        $conexion->actualizarUsuario($id_usuario, $correo);
        $conexion->actualizarPersona($nombre, $apellidos, $id_persona);
        $conexion->actualizarRol($id_rol, $id_usuario);
        // echo "usuario= " . $id_usuario;
        // echo "persona= " . $id_persona;
        // header("location: ../adm.php");
        header("location: ../adm.php");
    }





    
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Editar</title>
</head>

<body>
    <div id="navbar">
        <ul>
            <li><a href="../adm.php">Inicio</a></li>
            <li><a href="#news"></a></li>
            <li><a href="#contact">Contacto</a></li>
            <li style="float:right"><a class="active" href="../clases/destroy.php">Cerrar Sesión</a></li>
        </ul>
    </div>

        
    <div class="containerEditar admform">
        <input type="hidden" id="id_persona" name="id_persona" value="<?php echo $id_persona ?>" >
        <label for="fname">Id Moodle</label>
        <input type="text" id="id_moodle" name="id_moodle" value="<?php echo $id ?>"disabled>

        <label for="fname"> Nombre</label>
        <span  id="datos" class="error">* <?php  echo $e_Nombre?></span>
        <input type="text" id="nombre" name="nombre"   minlength="6" maxlength="40" onkeypress="return (event.charCode < 33 || event.charCode > 64)"     value="<?php echo $nombre ?>">

        <label for="fname">Apellidos</label>
        <span  id="datos" class="error">* <?php ?></span>
        <input type="text" id="apellidos" name="apellidos"  minlength="6" maxlength="40" onkeypress="return (event.charCode < 33 || event.charCode > 64)" value="<?php echo $apellidos ?>" required>

        <label for="fname">Correo Institucional</label>
        <span  id="datos" class="error">* <?php ?></span>
        <input type="text" id="correo" name="correo" value="<?php echo $correo ?>" Required>


        <label for="fname">Tipo de Usuario</label>
        <input type="hidden" name="rol" id="rol" size="30" ><br>
        <select name="rol" id="roles">
            <option value="1">Administrador</option>
            <option value="2">Coordinador</option>
            <option value="3">Profesor</option>
        </select>
        <br>

        <p id="error"></p>
        <button href="../adm.php" class="button " type="" id="editar" name="editar">Actualizar</button>
        <button class="button ">Enviar Contraseña</button>
        <?php
        echo "<a href='../adm.php'   class='button' type='button'>Regresar</a>";
        ?>
    </div>
        

    <div id="respuesta">

    </div>
  

            

</body>
<script src="../js/validacionEditar.js"></script>

</html>
