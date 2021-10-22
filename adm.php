<?php
//require("./clases/registro.php");
require('./conexion/conexionSYS.php');
session_start();
if (isset($_SESSION['login'])) {
} else {
    header("location: index.php");
}
/*******************************************/

if (empty($_POST['id_moodle']))
{
    $conexion = new conexionSYS;
    $listaUsuarios = $conexion->listaUsuarios();
    //print_r($listaUsuarios);
   // echo "vacio ";
   
    if ( isset($_POST['id_usuario']) && isset($_POST['id_persona'])) {
        $id_persona = $_POST['id_persona'];
        $id_usuario = $_POST['id_usuario'];

        //echo "idU=".$id_usuario." "."idP= ".$id_persona;
        $conexion->eliminarRol($id_usuario);
        $conexion->eliminarUsuario($id_usuario);
        $conexion->eliminarPersona($id_persona);
        header("Location: adm.php");
        
    }

} else 
{
  // echo "entro else";
      //registro de usuarios
      $id = $_POST['id_moodle'];
      $nombre = $_POST['nombre'];
      $apellidos = $_POST['apellidos'];
      $correo = $_POST['correo'];
      $contraseña = $_POST['contra'];
        $long= strlen($contraseña);
        if ($long >12) {
            //echo "no encripta";
            $contraseña = $_POST['contra'];
        } else{
            //echo "si encripta";
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);    
        }
    

      $rol = $_POST['rol'];
      //conectamos a la base  dedatos
      $registro = new conexionSYS;
      $id_persona = $registro->insertPersona($nombre, $apellidos);
      $registro->insertUsuario($id, $correo, $contraseña, $id_persona);
     // echo "id personas= " . $id . "<br>";
     // echo "ROL= " . $rol . "<br>";
      $filas = $registro->insertROL($rol, $id);
     // echo "FILAS MOVIDAS " . $filas . "<br>";
  
   unset($_POST['id_moodle']);
    unset( $_POST['nombre']);
    unset($_POST['apellidos']);
    unset($_POST['correo']);
    unset($_POST['contra']);
     unset($_POST['rol']);

   // echo "insertar";
   header("Location: adm.php");

}

//$conexion = new conexionSYS;
$listaUsuarios = $conexion->listaUsuarios();




?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="./Styles/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="navbar">
        <ul>
            <li><?php echo "<a href='#'>Inicio</a>" ?></li>
            <li><a href="./administrador/altas.php">Altas</a></li>
            <li><a href="#contact">Documentación</a></li>
            <li><a href="ip.php">Datos Conexión</a></li>
            <li style="float:right"><a class="active" href="./clases/destroy.php">Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="titulos">
        <h1>Lista de Usuarios</h1>
    </div>
    <div class="containerTAB">
        <table class="paleBlueRows" id="datatable">
            <thead>
                <tr>
                    <th>Nombre (s)</th>
                    <th>Apellidos</th>
                    <th>Tipo de Usuario</th>
                    <th>Correo Institucional</th>
                    <th>Acción</th>
                </tr>
            </thead>    
            <tbody>
                <?php
                try {
                    foreach ($listaUsuarios  as $key => $usuario) {

                        echo ' 
                        <tr>    
                        <td>' . $usuario["nombre"] . '</td>
                        <td>' . $usuario["apellidos"] . '</td>
                        <td>' . $usuario["nombre_rol"] . '</td>
                        <td>' . $usuario["correo"] . '</td>
                        <td>
                        <a href="./administrador/editar.php?id_usuario=' . $usuario['id_usuario'] . '&id_persona=' . $usuario['id_persona'] . '" class="button" type="button">Editar</a>
                        <a  class="button"  onclick="eliminar('.$usuario['id_usuario'].',' . $usuario['id_persona'] . ')" type="button">Eliminar</a>
                        </td>
                        </tr>';
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }


                ?>

            </tbody>

        </table>
    </div>
    <div id="respuesta">

    </div>
    <script>
        function eliminar(id_usuario, id_persona) {
            var resultado = window.confirm('Estas seguro de eliminar el Usuario');
            var temporal;
            if (resultado === true) {
                var ruta = "id_usuario=" + id_usuario + "&id_persona=" + id_persona;
                console.log(ruta);
                $.ajax({
                        url: 'adm.php',
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
                    location.reload();

            } else {
                window.alert('El registro no se ha eliminado');
            }
        }
    </script>

</body>





</html>