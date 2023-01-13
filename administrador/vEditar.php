<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1800;url=../clases/destroy.php">
    <title>Editar</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="../Styles/estilosTabla.css">
     <link rel="stylesheet" href="../Styles/styles.css">
     <link rel="stylesheet" href="../Styles/stylesDash.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="../Styles/navbar.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<?php include('../components/navbarAltas.php'); ?>
<body>
    <?php
        $rutLogoF='../img/logo-dgtic.png';
    ?>

    <!----------------------------------------->
   
    <!-----------------Seccion formulario ------------------->
     <!--  Título-->
  <div class="container-fluid title">
    <div class="row">
      <div class="col-12">
        <h1 ><i class="bi bi-pencil-fill me-3"style="font-size: 30px;"></i>Editar</h1>
      </div>
    </div>
  </div>
  <!----Contenido---->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="shadow-lg my-4 bg-body rounded ancho">
                    <h3 class="text-center fondo text-white  fs-2 pt-3 pb-3 mb-5 titulologin">Datos del Usuario</h3>
                    <div class="p-3" id="data">
                        <div class="col-md-12">
                            <input type="hidden"  class="form-control" id="id_persona" name="id_persona" value="<?php echo $id_persona ?>" >
                            <label for="fname" class="form-label ">Id Moodle</label>
                            <input type="text" class="form-control mb-3" id="id_moodle" value="<?php echo $id ?>"disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label "> Nombre(s)</label>
                            <span  id="datos" class="error">* <?php  echo $e_Nombre?></span>
                            <input type="text" placeholder="Ej: Paulina Zulen" class="form-control mb-3" id="nombre" name="nombre"   minlength="3" maxlength="40" onkeypress="return (event.charCode < 33 || event.charCode > 64)"     value="<?php echo $nombre ?>" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label ">Apellidos</label>
                            <span  id="datos" class="error">* <?php ?></span>
                            <input type="text" placeholder="Ej: Sánchez Montes de Oca" class="form-control mb-3" id="apellidos" name="apellidos"  minlength="6" maxlength="40" onkeypress="return (event.charCode < 33 || event.charCode > 64)" value="<?php echo $apellidos ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label ">Correo Institucional</label>
                            <span  id="datos" class="error">* <?php ?></span>
                            <input type="text" placeholder="Ej: ejemplo@dominio.mx" class="form-control mb-3" id="correo" name="correo" value="<?php echo $correo ?>" Required>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label">Tipo de Usuario</label>
                            <input type="text" placeholder="Ej: Administrador" class="form-control mb-3" id="roles" value="<?php echo $nombre_rol ?>"disabled>
                        </div>
                        <div class="mb-3 text-center">
                            <p id="error"></p>
                            <button class="btn btn-primary mt-3 me-3 fw-bold text-white" type="" id="editar" name="editar">Actualizar</button>
                            <?php
                            echo "<a href='../adm.php'   class='btn btn-primary mt-3  fw-bold' type='button'>Regresar</a>";
                            ?>
                        </div> 
                    </div>                    
             
                </div>
            </div>
        </div>
    </div>

    <div id="respuesta">
        
    </div>   
<?php include('../components/footer.php'); ?>

<script src="../js/validacionEditar.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap/popper.min.js"></script>
<script src="../js/bootstrap/bootstrap.min.js"></script>

</body>

</html>
