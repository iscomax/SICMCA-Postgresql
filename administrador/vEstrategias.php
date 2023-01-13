<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1800;url=../clases/destroy.php">
    <title>Estrategias</title>

    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="../Styles/estilosTabla.css">
     <link rel="stylesheet" href="../Styles/styles.css">
     <link rel="stylesheet" href="../Styles/stylesDash.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="../Styles/navbar.css">

</head>
<?php include('../components/navbarAltas.php'); ?>
<body>
  <?php
        $rutLogoF='../img/logo-dgtic.png';
    ?>
<!--  Título-->
<div class="container-fluid title">
     <div class="row">
          <div class="col-12">
               <h1 ><i class="bi bi-gear-fill me-3"style="font-size: 40px;"></i>Estrategia</h1>
          </div>
     </div>
</div>
  <!-----------------Seccion formulario ------------------->
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="shadow-lg mt-2 mb-2 bg-body rounded ancho">
          <h3 class="text-center fondo text-white fs-2 pt-3 pb-3 mb-3 titulologin">Medio de Comunicación</h3>
          <div class="p-3">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="GenerarEstrategia" name="GenerarEstrategia" class="row">
              <div class="col-md-12">
                <label for="txt_correo" class="form-label">Correo Institucional</label>
                <span  id="datos" class="error ms-1">*</span>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id=""><i class="bi bi-person-circle"></i></span>
                  </div>
                  <input type="text" class="form-control mb-3"  placeholder="Ej: ejemplo@dominio.mx"  id="correo" name="correo" value="<?php echo $correo; ?>" autofocus="autofocus" Required>
                </div>
              </div>
              <div class="input-group col-md-3 mb-2">
                <label for="txt_correo" class="input-group-text">Medio <span  id="datos" class="error ms-1">*</span></label>
                <select name="medio" class="form-select" required <?php echo $estado; ?>>
                  <option value="0" selected>Seleccione...</option>
                  <option value="1">Correo</option>
                  <option value="2">whatssapp</option>
                  <option value="3">Teléfono</option>
                  <option value="4">Facebook</option>
                </select>
                <br>
            </div>
               <div class="col-md-12">
               <label for="txt_correo" class="form-label">Nombre de la Estrategia</label>
               <span  id="datos" class="error ms-1">* <?php ?></span>
               <br>
               <div class="input-group">
               <select name="tipoEstrategia" class="form-select" required>
               <option selected disabled>Seleccione...</option>
                    <?php 
                    foreach ($tipoEstrategia as $key => $dato)
                     {
                         $id = $dato['id'];
                         $nombre = $dato['descripcion'];
                         echo "<option value='$id'>$nombre</option>";
                     }
                    ?>
               </select>
               </div>
                <div class="col-md-12">
                     <br>
                <label for="txt_correo" class="form-label">Mensaje</label>
                <span  id="datos" class="error ms-1">* <?php ?></span>
                <div class="input-group">
                  <div class="input-group-prepend">
                  <textarea name="txtEstrategia" id="" cols="43" rows="10" placeholder="Ej: Situación del Alumno" required></textarea>
                  <br>
                  <br>
                </div>
                </div>
              <div class="my-3 text-center">
              <input  class="btn btn-primary"  type="submit" onclick="" name= "enviar"  value="Enviar">
            </div>
              </div>
            </form>       
        </div>
      </div>
    </div>
    <div class="d-grid gap-2 col-2 mx-auto my-4">
                            <a class="btn btn-primary" href="dashboard.php" role="button">Regresar</a>
                            </div>
  </div>


    <!--Popper y bootstrap -->
    <script src="../js/validacionEditar.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap/popper.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <!-- Footer -->
    <?php include('../components/footer.php'); ?>

</body>


</html>