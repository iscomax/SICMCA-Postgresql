<?php

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
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Cliente</title>
    <link rel="stylesheet" href="./Styles/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <div id="navbar">
        <ul>
            <li><?php echo " <a href='adm.php'>Inicio</a>" ?></li>
            <li><a href="./administrador/altas.php">Altas</a></li>
            <li><a href="#contact">Documentación</a></li>
            <li><a href="ip.php">Datos Conexión</a></li>
            <li style="float:right"><a class="active" href="./clases/destroy.php">Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="containerTAB">
        <table class="paleBlueRows" id="datatable">
            <thead>
                <tr>
                    <th colspan="2" style="text-align:center">Registro de Actividad</th>  
                </tr>

            </thead>
            <tbody>
                 <tr>
                    <td>Usuario:</td>
                    <td>
                    <h5>Gabrielas	Peñalver Bernal	</h5>
                    <h5>Profesor</h5>
                    <h5>profesor1@dominio.com.mx</h5>
                    </td>
                </tr>
                <tr>
                    <td>La dirección IP es:</td>
                    <td><?php echo $direccionIP ?></td>
                </tr>
                <tr>
                    <td>El nombre del servidor es:</td>
                    <td><?php echo $nombreServidor ?></td>
                </tr>
                <tr>
                    <td>Página Visitada</td>
                    <td><?php echo $pagina ?></td>
                </tr>
                <tr>
                    <td>Puerto de Conexión</td>
                    <td><?php echo $puerto ?></td>
                </tr>
                <tr>
                    <td>Agente de usuario del Navegador</td>
                    <td><?php echo $agenteNav ?></td>
                </tr>
                <tr>
                    <td>Fecha y hora</td>
                    <td><?php echo $fecha ?></td>
                </tr>
            </tbody>

        </table>
    </div>




</body>

</html>