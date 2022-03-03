<link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="../Styles/estilosTabla.css">
     <link rel="stylesheet" href="../Styles/styles.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="../Styles/navbar.css">
<!-- 
     Bootstrap CSS 
     <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
     -->
     <!--Botones -->   
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
</head>
<body>
  <?php
        $rutLogoF='../img/logo-dgtic.png';
    ?>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container-fluid">
            <a class="navbar-brand" href="https://www.unam.mx/" target="_blank">
                 <img src="../img/logo-unam.png" alt="logo unam" width="40" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a href="./inicio.php" class="nav-link">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">Altas</a>
                  </li>
                  <li class="nav-item">
                    <a href="../adm.php" class="nav-link">Lista de Usuarios</a>
                  </li>
                  <li class="nav-item">
                    <a href="./bitacora.php" class="nav-link">Bitácora de Actividades</a>
                  </li>
                  <li class="nav-item">
                    <a href="../ip.php" class="nav-link">Datos Conexión</a>
                  </li>
                  <li class="nav-item">
                        <a href="./noti.php" class="nav-link">Notificaciones</a>
                  </li>
                  <li class="nav-item">
                    <a href="./docu.php" class="nav-link">Documentación</a>
                  </li>
                </ul>

                <div class="d-flex">
                      <a href="../clases/destroy.php">
                          <button class="btn btn-success"><i class="bi bi-file-person-fill"></i>Cerrar Sesión</button>
                      </a>
                </div>
            </div>
      </div>
  </nav>
