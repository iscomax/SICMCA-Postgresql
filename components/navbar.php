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
                <div class="btn btn-success perfil">

                    <i class="bi bi-file-person-fill">
                    </i>
                    <span class=" "><?php echo $nombre ?></span>
                </div>
                <div class="d-flex">
                    <a href="<?php echo $ruta4 ?>">

                        <button class="btn btn-warning  " type="button">Cerrar Sesión</button>
                    </a>
                </div>
            </div>
        </div>
    </nav>