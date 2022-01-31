<?php 
require_once("../vendor/autoload.php");
require_once("./formatos/grupoGeneral.php");
//require_once("../conexion/conexionSYS.php");

$data= $_GET['data'];
$data = stripslashes($data);
$data = urldecode($data);
$reporte = unserialize(base64_decode($data));

$dataP= $_GET['dataP'];
$dataP = stripslashes($dataP);
$dataP = urldecode($dataP);
$curso = unserialize(base64_decode($dataP));
//print_r($reporte);

//ARREGLO DE CONFIGURACION
$mpdf= new \Mpdf\Mpdf([]);
$css= file_get_contents('./formatos/reportes.css');
$css2= file_get_contents('../Styles/styles.css');
$formato =  getFormatoGeneral($reporte, $curso);
$mpdf->writeHtml($css2, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->writeHtml($formato, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();  





?>