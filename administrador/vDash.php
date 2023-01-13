<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Mi Actividad</title>
     <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <!-- CSS personalizado-->
     <link rel="stylesheet" href="../Styles/styles.css">
     <link rel="stylesheet" href="../Styles/stylesDash.css">
     <link rel="stylesheet" href="../Styles/estilosTabla.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
     <link rel="stylesheet" href="../Styles/navbar.css">
    <!-- data Table-->
    <link rel="stylesheet" href="../dataTable/datatables.css">
    
    <!--data datle bootstrap 5 -->
    <link rel="stylesheet" href="../dataTable/DataTables-1.11.3/css/dataTables.bootstrap5.css">
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <!-- graficos -->
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
     
     <?php include('../components/navbarAdministrador.php'); ?>
<body>

<?php $rutLogoF='../img/logo-dgtic.png';?>
<!--  Título-->
<div class="container-fluid title">
     <div class="row">
          <div class="col-12">
               <h1 ><i class="bi bi-plug-fill me-3"style="font-size: 40px;"></i>Mi Actividad Moodle</h1>
          </div>
     </div>
</div>
<!----Contenido---->
<div class="container-fluid">
     <div class="row ">
          <div class="col">
               <div class="card mb-3" style="max-width: 19rem;">
                    <div class="card-header  fondo-primary text-light"><i class="bi bi-person-fill me-2 fw-bold"></i>Datos de Usuario</div>
                    <div class="card-body texto-primary">
                         <h6 class="card-title fw-bold">Nombre Completo</h6>
                         <p class="card-text"><?php echo $usuario = $dato['nombre']." ". $dato['apellidos'];?></p>
                    </div>
                    <div class="card-body texto-primary">
                         <h6 class="card-title fw-bold">Dirección Correo Institucional</h6>
                         <p class="card-text"><?php echo $usuario = $dato['correo'] ; ?></p>
                    </div>
                    <div class="card-body texto-primary">
                         <h6 class="card-title fw-bold">Tipo de Usuario</h6>
                         <p class="card-text"><?php echo $usuario = $dato['nombre_rol'] ; ?></p>
                    </div>
               </div>



               <div class="container table-gruposBox">
                    <!--Botón Modal-->
                    <button class="btn btn-outline-primary m-4" data-bs-toggle="modal" data-bs-target="#contenedor-modal"><i class="bi bi-bar-chart-fill me-2"></i>Estadísticas</button>
                    <!--Moodal content-->
                    <div class="modal fade" id="contenedor-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-dialog-scrollable">
                              <div class="modal-content">
                                   <div class="modal-header">
                                        <h5 class="modal-title text-center" id="exampleModalLabel">Gráfia Actividad Moodle</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body">
                                        <div class="container"  id="graficaI"style="width=50%; height:50vh;"></div>
                                   </div>
                                   <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!--Termina modal-->
                    <table id="tablaIndicador" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                         <thead>
                              <!--id="tabla"-->
                              <tr>
                                   <th>Días sin Acceso</th>
                                   <th>Tiempo en Plataforma</th>
                                   <th>Último Acceso a la Plataforma</th>
                                   <th>Alumnos Asignados</th>
                                   <th>Alumnos Materia</th>
                              </tr>
                         </thead>
                         <tbody>
                           <?php
                                //print_r($riesgoDesercion);
                                 foreach ($ultimoAcceso as $key => $dato) {
                                      $valor0 = $dato[0];    
                                   }   
                                   foreach ($tiempoPlataforma as $key => $dato) {
                                        $valor1 = $dato[3];    
                                     }                               
                                        echo '
                                        <tr>
                                        <td>' . $valor0 . '</td>
                                        <td>' . $valor1 . '</td>
                                        <td>' . $valor2 . '</td>
                                        <td>' . $valor3 . '</td>
                                        <td>' . $valor4 . '</td>
                                        </tr>';
                                   
                               
                                ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
</div>
           <!--Popper y bootstrap -->
           <script src="../js/bootstrap/popper.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>

       <!-- datatables JS -->
    <script src=" ../dataTable/datatables.js "></script>
    <script src="../datatables/datatables.min.js"></script> 
    <script src="../dataTable/DataTables-1.11.3/js/dataTables.bootstrap5.js"></script>  
    
    <!-- para usar botones en datatables JS -->
    <script src="../dataTable/Buttons-2.1.1/js/dataTables.buttons.js"></script>
    <script src="../dataTable/Buttons-2.1.1/js/buttons.html5.js"></script>
    <script src="../dataTable/pdfmake-0.1.36/pdfmake.js"></script>  
    <script src="../dataTable/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../dataTable/JSZip-2.5.0/jszip.js"></script> 

    <!--Estilos excel-->
    <script  src =" https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js " > </script> 
    <script  src = " https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js " > </script>
    <!--columnas visibles-->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>

   

    <!-- JS gráficos-->
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <!-- highcharts-->
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>  
    <!-- optional -->  
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>  
    <script src="https://code.highcharts.com/modules/export-data.js"></script> 
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.colVis.js"></script>
    <!-- código JS propìo-->
    <script type="text/javascript" src="../js/tablaIndicadores.js"></script>

    <!-- Footer -->
    <?php include('../components/footer.php'); ?>
</body>
</html>