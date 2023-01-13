<nav class="navbar sticky-top navbar-expand-lg bg-dark navbar-dark">
     <div class="container-fluid">
          <a class="navbar-brand" href="https://www.unam.mx/" target="_blank">
               <img src="../img/logo-unam.png" alt="" width="40" class="d-inline-block align-text-top">
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
                         <a href="./altas.php" class="nav-link">Altas</a>
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
                    <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Indicadores</a>
                         <ul class="dropdown-menu submenu" aria-labelledby="navbarDropdown">
                              <li><a class="dropdown-item nav-link" href="./dashboard.php">Mi Actividad</a></li>
                              <li><a class="dropdown-item nav-link" href="listaRiesgoDesercion.php">Riesgo de Deserción</a></li>
                              <li><a class="dropdown-item nav-link" href="listaActividadesEnt.php">Actividades Pendientes</a></li>
                              <li><a class="dropdown-item nav-link" href="listaEstrategias.php">Estrategias Registrada</a></li>
                              <li><a class="dropdown-item nav-link" href="listaAlumosAsignados.php">Tareas Enviadas</a></li>
                              <li><a class="dropdown-item nav-link" href="listaGlobal.php">Reporte Global</a></li>
                              <li><a class="dropdown-item nav-link" href="listaProfesoresMateria.php">Profesores por Curso</a></li>
                         </ul>
                    </li>
               </ul>
               <div class="d-flex">
                      <a href="../clases/destroy.php">
                          <button class="btn btn-light"><i class="bi bi-file-person-fill"></i>Cerrar Sesión</button>
                      </a>
                </div>
          </div>
     </div>
</nav>
