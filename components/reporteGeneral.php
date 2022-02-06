
    <!-- Modal reporte General+++++++++ modal-fullscreen ++++++++ modal-xl +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        
    <div class="modal" id="reporteG">
        <div class="modal-dialog modal-fullscreen ">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Reporte General de Calificaciones</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            <div class="container">
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

                    <div class="row justify-content-around">
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card mb-3 cardReporte card-1" style="max-width: 540px;">
                                <div class="row g-0 ">
                                    <div class="col-md-4 d-flex  justify-content-center">
                                        <i class="bi bi-people-fill" style="font-size: 80px;  opacity: 0.5;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body ">
                                            <h5 class="card-title text-center"><?php echo $total_alumnos ?></h5>
                                            <p class="card-text text-center">Número de Alumnos</p>
                                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card mb-3 cardReporte card-3" style="max-width: 540px;">
                                <div class="row g-0 ">
                                    <div class="col-md-4 d-flex  justify-content-center">
                                        <i class="bi bi-person-check-fill" style="font-size: 80px;  opacity: 0.5;"></i>
                                    </div>
                                    <div class="col-md-8">   
                                        <a style="cursor:pointer;"  data-bs-toggle="modal" data-bs-target="#reporteA">
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><?php echo $curso_Aprobados ?></h5>
                                                <p class="card-text text-center">Alumnos Aprobados</p>
                                                
                                                <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card mb-3 cardReporte card-2" style="max-width: 540px;">
                                <div class="row g-0 ">
                                    <div class="col-md-4 d-flex  justify-content-center">
                                        <i class="bi bi-person-x-fill" style="font-size: 80px;  opacity: 0.5;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <a  style="cursor:pointer;"  data-bs-toggle="modal" data-bs-target="#reporteP">
                                            <div class="card-body ">
                                                <h5 class="card-title text-center"><?php echo $curso_Reprobados  ?></h5>
                                                <p class="card-text text-center">Alumnos Reprobados</p>
                                                <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-around">
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card mb-3 cardReporte card-5" style="max-width: 540px;">
                                <div class="row g-0 ">
                                    <div class="col-md-4 d-flex  justify-content-center">
                                        <i class="bi bi-journal-plus" style="font-size: 80px;  opacity: 0.5;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body ">
                                            <h5 class="card-title text-center"><?php echo round($promedio_Curso,1);  ?></h5>
                                            <p class="card-text text-center">Promedio de calificación por curso</p>
                                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card mb-3 cardReporte card-3 " style="max-width: 540px;">
                                <div class="row g-0 ">
                                    <div class="col-md-4 d-flex  justify-content-center">
                                        <i class="bi bi-journal-check" style="font-size: 80px;  opacity: 0.5;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body ">
                                            <h5 class="card-title text-center"><?php echo $countConcluidos ?></h5>
                                            <p class="card-text text-center">Calificaciones Concluidas</p>
                                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card mb-3 cardReporte card-2 " style="max-width: 540px;">
                                <div class="row g-0 ">
                                    <div class="col-md-4 d-flex  justify-content-center">
                                        <i class="bi bi-journal-x" style="font-size: 80px;  opacity: 0.5;"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body ">
                                            <h5 class="card-title text-center"><?php echo $countPendientes  ?></h5>
                                            <p class="card-text text-center">Calificaciones Pendientes</p>
                                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                    <?php 
                            $generalArray[] = ["alumnos" => $total_alumnos,"aprobados" => $curso_Aprobados,"reprobados" => $curso_Reprobados,
                            "promedio" => $promedio_Curso,"pendientes" => $countPendientes,"concluidos" => $countConcluidos];
                           // print_r($generalArray);
                            $data =  base64_encode(serialize($generalArray));
                            $data= urldecode($data);
                            $dataP= base64_encode(serialize($cursoArray));
                            $dataP= urldecode($dataP);
                        ?>
                         <div class="col-1">
                      <!--    <button  type="button" class="btn btn-danger" >Exportar</button> -->
                         </div>
                    </div>

                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            <h3 style="text-align: center;">UNAM</h3>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
               
            </div>

            </div>
        </div>
        </div>

    <!-- **************************************************************************************************************** -->