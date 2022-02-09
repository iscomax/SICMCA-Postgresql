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
        /*$usuario = $dato['nombre'] ." ". $dato['apellidos'] ." ". $dato['nombre_rol'] ." ". $dato['correo'];*/
        $nombre = $dato['nombre'];


    }

}catch (Exception $e){



}

/******************************************/


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
        header("location: ./adm.php");
        
    }

} else 
{
      //registro de usuarios
      $id = $_POST['id_moodle'];
      $nombre = $_POST['nombre'];
      $apellidos = $_POST['apellidos'];
      $correo = $_POST['correo'];
      $contraseña = $_POST['contra'];
      $rol=$_POST['rol'];
    $long= strlen($contraseña);

        if ($long >12) {
            //echo "no encripta";
            $contraseña = $_POST['contra'];
        } else{
            //echo "si encripta";
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);    
        }
      
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
   header("location: ./adm.php");

}


//$conexion = new conexionSYS;
$listaUsuarios = $conexion->listaUsuarios();
//print_r($listaUsuarios);



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <!--<link rel="stylesheet" href="./Styles/estilosTabla.css">-->
     <link rel="stylesheet" href="./Styles/styles.css">
     <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="./Styles/navbar.css">
<!-- 
    <link rel="stylesheet" href="./Styles/estilos.css">
     Bootstrap CSS 
     <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
     -->
     <!--Botones -->
     <link rel="stylesheet" href="./datatables/Buttons-2.1.1/css/buttons.dataTables.min.css">
   
    <!-- data Table-->
    <link rel="stylesheet" href="./dataTable/datatables.css">
    
    <!--data datle bootstrap 5 -->
    <link rel="stylesheet" href="./dataTable/DataTables-1.11.3/css/dataTables.bootstrap5.css">
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <!-- graficos  -->
     <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.0/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
<!-- highcharts-->
    <script src="https://cdn.datatables.net/searchpanes/1.2.0/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>  
    <!-- optional -->  
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>  
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/highcharts-drilldown@0.1.7/drilldown.js"></script>


</head>
<?php include('./components/navbarAdm.php'); ?>

<body>
<div class="container" id="grafica" style="width=50%; height:300px;">
    </div>
    
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Lista de Usuarios</h1>
                    <div class="container table-gruposBox">
                        <table id="tablaAdministrador" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            
                            <thead>
                                <!--id="tabla"-->
                                    <tr>
                                        <th>Nombre(s)</th>
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
                                        <a href="./administrador/editar.php?id_usuario=' . $usuario['id_usuario'] . '&id_persona=' . $usuario['id_persona'] . '" class="btn btn-primary mt-1 mb-2" type="button">Editar</a>
                                        <a  class="btn btn-danger mt-1 mb-2"  onclick="eliminar('.$usuario['id_usuario'].',' . $usuario['id_persona'] . ')" type="button">Eliminar</a>
                                        </td>
                                        </tr>';
                                    }
                                } catch (\Throwable $th) {
                                    
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="respuesta"></div>
    <script>
        function eliminar(id_usuario, id_persona)
        {
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
                    .done(function(res)
                    {
                    $('#respuesta').html(res);
                    })
                    .fail(function()
                    {
                    console.log('error');
                    })
                    .always(function()
                    {
                    console.log('complete');
                    });
                    location.reload();
                    } else {
                    window.alert('El registro no se ha eliminado');
                    }
                    }
    </script>
       <!--Popper y bootstrap -->
    <script src="./js/bootstrap/popper.min.js"></script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>

       <!-- datatables JS -->
    <script src=" ./dataTable/datatables.js "></script>
    <script src="./datatables/datatables.min.js"></script> 
    <script src="./dataTable/DataTables-1.11.3/js/dataTables.bootstrap5.js"></script>  
    
    <!-- para usar botones en datatables JS -->
    <script src="./dataTable/Buttons-2.1.1/js/dataTables.buttons.js"></script>
    <script src="./dataTable/Buttons-2.1.1/js/buttons.html5.js"></script>
    <script src="./dataTable/pdfmake-0.1.36/pdfmake.js"></script>  
    <script src="./dataTable/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="./dataTable/JSZip-2.5.0/jszip.js"></script> 

    <!-- JS gráficos-->
    <script src="https://cdn.datatables.net/searchpanes/1.2.0/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <!-- código JS propìo-->    

    <!-- código JS propìo-->    
    <script type="text/javascript" src="./js/tabla.js"></script>

    <!-- Footer -->
    <?php include('./components/footer.php'); ?>

</body>


</html>