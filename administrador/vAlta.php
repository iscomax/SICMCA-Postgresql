<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1800;url=../clases/destroy.php">
    <title>Altas</title>

    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="../Styles/styles.css">
     <link rel="stylesheet" href="../Styles/estilosTabla.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="../Styles/navbar.css"> 
     <link rel="stylesheet" href="../Styles/stylesDash.css">  
    <!-- data Table-->
    <link rel="stylesheet" href="../dataTable/datatables.css">
    
    <!--data datle bootstrap 5 -->
    <link rel="stylesheet" href="../dataTable/DataTables-1.11.3/css/dataTables.bootstrap5.css">
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <!-- graficos -->
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
</head>
<?php include('../components/navbarAltas.php'); ?>
<body>
  <?php
        $rutLogoF='../img/logo-dgtic.png';
    ?>

    <!--  Título-->
    <div class="container-fluid title ">
        <div class="row">
            <div class="col-12">
                    <h1 ><i class="bi bi-person-plus-fill me-3"style="font-size: 40px;"></i>Altas</h1>
            </div>
        </div>
    </div>

 <!-----------------Seccion formulario ------------------->
 <div class="container-fluid mb-4">
    <div class="row">
      <div class="col">
        <div class="shadow-lg mt-2 mb-2 bg-body rounded ancho">
          <h3 class="text-center fondo text-white fs-2 pt-3 pb-3 mb-3 titulologin">Datos del Usuario</h3>
          <div class="p-3">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="buscar" name="buscar" class="row">
              <div class="col-md-12">
                <label for="txt_correo" class="form-label">Correo Institucional</label>
                <span  id="datos" class="error ms-1">*</span>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id=""><i class="bi bi-person-circle"></i></span>
                  </div>
                  <input type="text" class="form-control mb-3"  placeholder="Ej: ejemplo@dominio.mx"  id="correo" name="correo" value="<?php echo $correo ?>" autofocus="autofocus">
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary" name="buscar" value="submit">BUSCAR</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        <!--Envio de datos a adm.php-->
        <div class="p-3">
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="for1" name="for1" class="row g-3">
            <div class="col-md-12">
              <input name="correo2" id="correo2" value="<?php echo $correo2 ?>" type="hidden">
              <label for="fname" class="form-label">Id Moodle</label>
              <input type="text" class="form-control" placeholder="Ej: 27" id="id_moodle" name="id_moodle" value="<?php echo $id ?>" readonly
 >
            </div>
            <div class="col-md-12">
              <label for="fname" class="form-label"> Nombre(s)</label>
              <input type="text" class="form-control" placeholder="Ej: Paulina" id="nombre" name="nombre" value="<?php echo $nombre ?>" readonly
>
            </div>
            <div class="col-md-12">
              <label for="fname" class="form-label">Apellidos</label>
              <input type="text" class="form-control" placeholder="Ej: Sánchez Montes de Oca" id="apellidos" name="apellidos" value="<?php echo $apellidos ?>" readonly
 >
            </div>
            <div class="col-md-12">
              <label for="fname" class="form-label">Correo Institucional</label>
              <input type="text" class="form-control" placeholder="Ej: ejemplo@dominio.mx" id="correo" name="correo" value="<?php echo $correo ?>" readonly
 >
            </div>
            <div class="col-md-12">
              <label for="fname" class="form-label">Contraseña</label>
              <input type="password" class="form-control" placeholder="Ej: Abc$123" id="contra" name="contra" value="<?php echo $contra?>" readonly
>
            </div>
            <div class="input-group col-md-3 mb-2">
              <label for="fname" class="input-group-text">Tipo de Usuario <span  id="datos" class="error ms-1">*</span></label>
              <input type="hidden" name="rol" id="rol" size="30"><br>
              <select name="rol" class="form-select" required <?php echo $estado; ?>>
                <option value="0" selected>Seleccione...</option>
                <option value="1">Administrador</option>
                <option value="2">Coordinador</option>
                <option value="3">Profesor</option>
              </select>
              <br>
            </div>
            <div class="mb-3 text-center">
              <input  class="btn btn-primary"  type="submit" onclick="" name= "enviar"  value="Enviar" <?php echo $estado; ?>>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include('../components/footer.php'); ?>
  <script src="../js/bootstrap/popper.min.js"></script>
  <script src="../js/bootstrap/bootstrap.min.js"></script>
</body>
</html>