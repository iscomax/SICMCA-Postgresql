<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1800;url=../clases/destroy.php">
    <title>Reporte Global</title>
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

</head>
<?php include('../components/navbarAdministrador.php'); ?>
<body>
    <?php
        $rutLogoF='../img/logo-dgtic.png';
    ?>
   <!--  Título-->
   <div class="container-fluid title">
        <div class="row">
            <div class="col-12">
                <h1 ><i class="bi bi-person-lines-fill me-3"style="font-size: 40px;"></i>Reporte Global</h1>
            </div>
        </div>
    </div>
  <!----Contenido---->
    <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="container table-gruposBox">
                        <!--Botón Modal-->
                        <button class="btn btn-outline-primary m-4" data-bs-toggle="modal" data-bs-target="#contenedor-modal"><i class="bi bi-bar-chart-fill me-2"></i>Estadísticas</button>
                        <!--Moodal content-->
                        <div class="modal fade" id="contenedor-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="exampleModalLabel">Gráfica Reporte Global</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container"  id="graficaRG"style="width=50%; height:50vh;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><!--Termina modal-->
                    <table id="tablaGlo" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <!--id="tabla"-->
                            <tr>
                                <th>Id</th>
                                <th>Nombre Corto</th>
                                <th>Curso</th>
                                <th>Estatus</th>
                                <th>Mosaico</th>
                                <th>Id</th>
                                <th>Actividad</th>
                                <th>Tareas</th>
                                <th>Tareas sin Calificar</th>
                                <th>Foros</th>
                                <th>Foros sin Calificar</th>
                                <th>Examenes</th>
                                <th>Examenes sin Calificar</th>
                                <th>Asignación/Assignment</th>
                                <th>Libro/Book</th>
                                <th>Chat</th>
                                <th>Elección/Choice</th>
                                <th>Datos/Data</th>
                                <th>Comentarios/Feedback</th>
                                <th>Lección/Lesson</th>
                                <th>Página/Page</th>
                                <th>Recurso/Resource</th>
                                <th>Scorm</th>
                                <th>Encuesta/Survey</th>
                                <th>URL</th>
                                <th>Wiki</th>
                                <th>Recursos no Ponderables</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($reporteGlobal as $key => $dato) {
                                $valor0 = $dato[0];
                                $valor1 = $dato[1];
                                $valor2 = $dato[2];
                                $valor3 = $dato[3];
                                $valor4 = $dato[4];
                                $valor5 = $dato[5];
                                $valor6 = $dato[6];
                                $valor7 = $dato[7];
                                $valor8 = $dato[8];
                                $valor9 = $dato[9];
                                $valor10 = $dato[10];
                                $valor11 = $dato[11];
                                $valor12 = $dato[12];
                                $valor13 = $dato[13];
                                $valor14 = $dato[14];
                                $valor15 = $dato[15];
                                $valor16 = $dato[16];
                                $valor17 = $dato[17];
                                $valor18 = $dato[18];
                                $valor19 = $dato[19];
                                $valor20 = $dato[20];
                                $valor21 = $dato[21];
                                $valor22 = $dato[22];
                                $valor23 = $dato[23];
                                $valor24 = $dato[24];
                                $valor25 = $dato[25];
                                $valor26 = $dato[26];
                                
                                echo '
                                <tr>
                                    <td>' . $valor0 . '</td>
                                    <td>' . $valor1. '</td>
                                    <td>' . $valor2 . '</td>
                                    <td>' . $valor3 . '</td>
                                    <td>' . $valor4 . '</td>
                                    <td>' . $valor5 . '</td>
                                    <td>' . $valor6 . '</td>
                                    <td>' . $valor7 . '</td>
                                    <td>' . $valor8 . '</td>
                                    <td>' . $valor9 . '</td>
                                    <td>' . $valor10 . '</td>
                                    <td>' . $valor11 . '</td>
                                    <td>' . $valor12 . '</td>
                                    <td>' . $valor13 . '</td>
                                    <td>' . $valor14 . '</td>
                                    <td>' . $valor15 . '</td>
                                    <td>' . $valor16 . '</td>
                                    <td>' . $valor17 . '</td>
                                    <td>' . $valor18 . '</td>
                                    <td>' . $valor19 . '</td>
                                    <td>' . $valor20 . '</td>
                                    <td>' . $valor21. '</td>
                                    <td>' . $valor22 . '</td>
                                    <td>' . $valor23 . '</td>
                                    <td>' . $valor24 . '</td>
                                    <td>' . $valor25 . '</td>
                                    <td>' . $valor26 . '</td>
                                    
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                        <div class="d-grid gap-2 col-2 mx-auto mt-2">
                            <a class="btn btn-primary" href="../administrador/dashboard.php" role="button">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>

     <!-- Footer -->
     <?php include('../components/footer.php'); ?>
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
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.colVis.js"></script>
     <!-- código JS propìo-->    
     <script type="text/javascript" src="../js/tablaReproGlo.js"></script>

</body>
</html>