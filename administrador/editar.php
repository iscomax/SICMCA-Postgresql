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
    $id_usuario = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $id_rol = $_POST["roles"];
    $conexion->actualizarUsuario($id_usuario, $correo);
    $conexion->actualizarPersona($nombre, $apellidos, $id_persona);
    $conexion->actualizarRol($id_rol, $id_usuario);
    //echo "usuario= " . $id_usuario;
   // echo "persona= " . $id_persona;
  // header("location: ../adm.php");
  header("Location: ../adm.php");
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

        <label for="fname">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>">

        <label for="fname">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos ?>">

        <label for="fname">Correo Institucional</label>
        <input type="text" id="correo" name="correo" value="<?php echo $correo ?>">


        <label for="fname">Tipo de Usuario</label>
        <input type="hidden" name="rol" id="rol" size="30"><br>
        <select name="rol" id="roles">
            <option value="1">Administrador</option>
            <option value="2">Coordinador</option>
            <option value="3">Profesor</option>
        </select>
        <br>


        <button href="../adm.php" class="button " type="" id="editar" name="editar">Actualizar</button>
        <button class="button ">Enviar Contraseña</button>
        <?php
        echo "<a href='../adm.php'   class='button' type='button'>Regresar</a>";
        ?>
    </div>

    <div id="respuesta">

    </div>

</body>
<script>
    $('#editar').click(function() {
        var resultado = window.confirm('¿Estas seguro de actualizar los datos?');
        if (resultado === true) {
            var id = document.getElementById('id_moodle').value;
            var id_persona = '<?php echo $id_persona; ?>';
            var nombre = document.getElementById('nombre').value;
            var apellidos = document.getElementById('apellidos').value;
            var correo = document.getElementById('correo').value;
            var roles = document.getElementById('roles').value;

            var ruta = "id=" + id + "&nombre=" + nombre + "&apellidos=" + apellidos + "&correo=" + correo + "&roles=" + roles + "&id_persona=" + id_persona;
            console.log(ruta);
            $.ajax({
                    url: 'editar.php',
                    type: 'POST',
                    data: ruta,
                })
                .done(function(res) {
                    $('#respuesta').html(res);
                })
                .fail(function() {
                    console.log('error');
                })
                .always(function() {
                    console.log('complete');
                });
                location.href ="../adm.php";
        } else {
            window.alert('Se ha cancelado la edición de datos');
            location.href ="../adm.php";
        }

    })
</script>

</html>