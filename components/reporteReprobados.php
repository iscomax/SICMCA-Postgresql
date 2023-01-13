<!-- Modal reporte reprobrados++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="modal" id="reporteP">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Reporte Alumnos Reprobados</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <!--  -->
            <div class="jumbotron">
                <div class="row justify-content-center" >
                    <div class="col-12 col-md-7 col-lg-4">
                        <div class=" title  rounded contorno">
                            <i class="bi bi-mortarboard-fill" style="font-size: 50px;"></i>
                            <div class=" table-responsive " width="100%">
                                <table class="d-flex justify-content-center" >
                                    <tbody>
                                        <tr class="d-flex justify-content-start">
                                            <td class="align-bottom "> <b>Nombre del Profesor:  </b> </td>
                                            <td class="align-bottom ">&nbsp; <?php echo $nombre_Profesor . " " . $apellidos_Profesor ?></td>
                                        </tr>
                                        <tr class="d-flex justify-content-start">
                                            <td class="align-bottom "> <b>Nombre del Curso:  </b> </td>
                                            <td class="align-bottom ">&nbsp; <?php echo $cursoNombre ?></td>
                                        </tr>
                                        <tr class="d-flex justify-content-start">
                                            <td class="align-bottom "> <b>Nombre Grupo:  </b> </td>
                                            <td class="align-bottom ">&nbsp; <?php echo $grupo?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
             <!-- contenedor -->
    <div class="container ">
        <div class="row justify-content-center grafica_row">
             <div class="col-12">
                <div id="" class="contenedor">

                </div>
            </div>
        </div>
    </div>
            <!-- tabla de resultados -->
                <div class="container tableReprobados">
                    <div class="row">
                    <table id="reporteReprobados" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Número de Cuenta</th>
                                <th>Nombre del Alumno</th>
                                <th>Calificación Moodle</th>
                                <th>Califiación Final</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($reprobadosArray   as $key => $alumno) : ?>
                                <tr>
                                    <td><?php echo $alumno['cuenta'] ?></td>
                                    <td><?php echo $alumno['nombre'] ?></td>
                                    <td><?php echo $alumno['calMoodle'] ?></td>
                                    <td><?php echo $alumno['calFinal'] ?></td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                </table>
                    </div>
                </div>   

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>

        </div>
    </div>
</div>
