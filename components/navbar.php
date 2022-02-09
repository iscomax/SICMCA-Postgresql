    <!-- barra de navegacion -->
    <nav class="navbar navbar-expand-sm   bg-dark navbar-dark">
        <div class="container-fluid ">
            <a class="navbar-brand" href="">
                <img src="<?php echo $rutLogo ?>" alt="" width="40" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                     
                        <a class="nav-link"  href="<?php echo $ruta1 ?>">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2 ?>">Grupos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta3 ?>">Buscar</a>
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
                    <li><a class="dropdown-item" href="<?php echo $ruta4 ?>">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>