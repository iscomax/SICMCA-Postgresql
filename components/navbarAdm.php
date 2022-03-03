<!-- Barra de navegacion administrador-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
     <div class="container-fluid">
          <a class="navbar-brand" href="https://www.unam.mx/" target="_blank">
               <img src="./img/logo-unam.png" alt="" width="40" class="d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
               <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="./administrador/inicio.php" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                         <a href="./administrador/altas.php" class="nav-link">Altas</a>
                    </li>
                    <li class="nav-item">
                         <a href="#" class="nav-link">Lista de Usuarios</a>
                    </li>
                    <li class="nav-item">
                         <a href="./administrador/bitacora.php" class="nav-link">Bitácora de Actividades</a>
                    </li>
                    <li class="nav-item">
                         <a href="./ip.php" class="nav-link">Datos Conexión</a>
                    </li>
                    <li class="nav-item">
                        <a href="./administrador/noti.php" class="nav-link">Notificaciones</a>
                    </li>
                    <li class="nav-item">
                         <a href="./administrador/docu.php" class="nav-link">Documentación</a>
                    </li>

               </ul>
               <div class="d-flex">

               <div class="btn-group">
               <button type="button" class="btn btn-success  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="bi bi-file-person-fill"></i>
                         <span class=" "><?php echo $nombre ?></span>
               </button>
               <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Datos de Usuario</a></li> 
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./clases/destroy.php">Cerrar Sesión</a></li>
               </ul>
               
               </div>
          </div>
     </div>
</nav>