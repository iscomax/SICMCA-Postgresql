<?php
function getFormatoGeneral($reporte, $curso)
{
    foreach ($curso as $key => $dato) {
        $profesor = $dato['nombre'];
        $curso = $dato['cursoNombre'];
        $grupo = $dato['grupo'];
    }

    foreach ($reporte as $key => $dato) {
        $alumnos = $dato['alumnos'];
        $aprobados = $dato['aprobados'];
        $reprobados = $dato['reprobados'];
        $promedio = $dato['promedio'];
        $pendientes = $dato['pendientes'];
        $concluidos = $dato['concluidos'];
    }
    
    $formato = '
    <h1>Reporte Generar de Calificaciones</h1>
    <table class="paleBlueRows" id="datatable">
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
        <tr>
            <td>Número de Alumnos</td>
            <td>'.$alumnos.'</td>
        </tr>
        <tr>
            <td>Alumnos Aprobados</td>
            <td>'.$aprobados.'</td>
        </tr>
        <tr>
            <td>Alumnos Reprobados</td>
            <td>'.$reprobados.'</td>
        </tr>
        <tr>
            <td>Promedio de calificación por curso</td>
            <td>'.$promedio.'</td>
        </tr>
        <tr>
            <td>Calificaciones Pendientes</td>
            <td>'.$pendientes.'</td>
        </tr>
        <tr>
            <td>Calificaciones Concluidas</td>
            <td>'.$concluidos.'</td>
        </tr>
    </tbody>
</table>

   
            ';


    return $formato;
}
