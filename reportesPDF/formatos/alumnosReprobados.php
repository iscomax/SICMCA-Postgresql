<?php


function getFormatoReprobados($reporte, $curso)
{
    foreach ($curso as $key => $dato) {
        $profesor = $dato['nombre'];
        $curso = $dato['cursoNombre'];
        $grupo = $dato['grupo'];
    }

    $formato = '
    <h1>Reporte Alumnos Reprobados</h1>
    <table class="paleBlueRows" id="datatable" style="margin-top: 3%;">
                    <tbody>
                        <tr>
                            <td>Nombre del Profesor</td>
                            <td>'.$profesor.'</td>
                        </tr>
                        <tr>
                            <td>Nombre del Curso</td>
                            <td>'.$curso.'</td>
                        </tr>
                        <tr>
                            <td>Nombre Grupo</td>
                            <td>'.$grupo.'</td>
                        </tr>
                    </tbody>
    </table>
    <table  class="paleBlueRows" id="datatable">
        <thead>
        <tr>
        <td><strong>Número de cuenta</strong></td>
        <td> <strong>Nombre</strong> <strong></strong> </td>
        <td> <strong>Califiación Moodle</strong> <strong></strong> </td>
        <td> <strong>Califiación Final</strong><strong></strong> </td>
         </tr>
        </thead>
        <tbody>';
        foreach ($reporte  as $key => $alumno) {
        $formato .='
        <tr>
        <td>'.$alumno['cuenta'].' </td>
        <td>'.$alumno['nombre'].' </td>
        <td>'.$alumno['calMoodle'].' </td>
        <td>'.$alumno['calFinal'].' </td>
        </tr>
        </tbody>';
        }

    $formato .='
    </table>
            ';

    return $formato;
}


