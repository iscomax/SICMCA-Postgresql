<?php
require_once('../vendor/autoload.php');
//Plantilla de HTML
require_once('./reportes/diccionarioMoodle.php');
//Codigo CSS
$css = file_get_contents('./reportes/style.css');


$mpdf = new \Mpdf\Mpdf([
     "format"=> "A4"
]);
$mpdf->SetFooter('{PAGENO}');
$plantilla = getPlantilla();
$mpdf->AddPage('L');
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);


$mpdf->Output();
