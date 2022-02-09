<!-- Barra de navegacion administrador-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
     <div class="container-fluid">
          <a class="navbar-brand" href="">
               <img src="<?php echo $rutLogo ?>" alt="" width="40" class="d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
               <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                         <a href="#" class="nav-link">Lista de Usuarios</a>
                    </li>
                    <li class="nav-item">
                         <a href="./administrador/altas.php" class="nav-link">Altas</a>
                    </li>
                    <li class="nav-item">
                         <a href="./administrador/docu.php" class="nav-link">Documentación</a>
                    </li>
                    <li class="nav-item">
                         <a href="./ip.php" class="nav-link">Datos Conexión</a>
                    </li>
               </ul>
              <div class="btn btn-danger perfil">
                    <i class="bi bi-file-person-fill"></i>
                    <span class=""><?php echo $nombre?></span>
               </div>

               <div class="d-flex">
                    <a href="./clases/destroy.php">
                         <button class="btn btn-danger">Cerrar Sesión</button>
                    </a>
               </div>
          </div>
     </div>
</nav>