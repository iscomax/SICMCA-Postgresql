<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1800;url=./clases/destroy.php">
    <title>Datos Cliente</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="./Styles/estilosTabla.css">
     <link rel="stylesheet" href="./Styles/styles.css">
     <link rel="stylesheet" href="./Styles/stylesDash.css">
     <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="./Styles/navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<?php include('./components/navbarAdm.php'); ?>
<body>
<?php
        $rutLogoF='./img/logo-dgtic.png';
    ?>
    <!--  Título-->
    <div class="container-fluid title">
        <div class="row">
            <div class="col-12">
                <h1 ><i class="bi bi-plug-fill me-3"style="font-size: 40px;"></i>Mi Actividad SICMCA</h1>
            </div>
        </div>
    </div>
  <!----Contenido---->


    <div class="container-fluid mb-4">
        <div class="row>
            <div class="col">
                <div class="shadow-lg mt-2 mb-2 bg-body rounded ancho">
                <h3 class="text-center fondo text-white fs-2 pt-3 pb-3 mb-3 titulologin">Datos del Usuario</h3>
                <div class="container pb-2 table-responsive">
                    <table class="table table-striped table-bordered table-hover " cellspacing="0" width="100%" id="datatable">
                        <tbody class="mx-auto" style="width: 200px;" >
                            <tr>
                                <td>Datos de Usuario: </td>
                                <td><?php echo $usuario ?></td>
                            </tr>                           
                            <tr>
                                <td>Dirección IP es:</td>
                                <td><?php echo $direccionIP ?></td>
                            </tr>
                            <tr>
                                <td>Nombre del servidor es:</td>
                                <td><?php echo $nombreServidor ?></td>
                            </tr>
                            <tr>
                                <td>Página Visitada:</td>
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
                </div>
            </div>
        </div>
    </div>
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap/popper.min.js"></script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>

    <?php include('./components/footer.php'); ?>
</body>

</html>