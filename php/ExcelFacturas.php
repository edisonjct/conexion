<?php
$conexion = include('conexion.php');
require_once '../Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$IDB = $_GET['IDB'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$condicion = $_GET['condicion'];

$objPHPExcel->
        getProperties()
        ->setCreator("Edison Chulde")
        ->setLastModifiedBy("Edison Chulde")
        ->setTitle("Cupones Cruzados")
        ->setSubject("Cupones Cruzados")
        ->setDescription("Cupones Cruzados");
//se forman las cabeceras

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:I1');
$objPHPExcel->getActiveSheet()->setTitle('Facturas Realizadas ' . date("Y-m-d"));
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REPORTE DE FACTURAS');
$objPHPExcel->getActiveSheet()->setAutoFilter("A2:I2");
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'FECHA');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'FACTURA');
$objPHPExcel->getActiveSheet()->setCellValue('C2', 'VENTA BTA');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'DESCUENTO');
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'VENTA NETA');
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'IVA');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'TOTAL');
$objPHPExcel->getActiveSheet()->setCellValue('H2', 'CEDULA');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'NOMBRE');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);



$sql = "SELECT
DATE_FORMAT(d.FECMOV03,'%Y/%m/%d') AS FECHA,
d.NOCOMP03 AS FACTURA,
Sum(d.PRECVTA03) AS VENTABTA,
Sum(d.desctotvta03+d.DESCVTA03+d.desctotfp03) AS DESCUENTO,
Sum(d.PRECVTA03-d.DESCVTA03-d.desctotvta03-d.desctotfp03) AS VENTANET,
ROUND(Sum(((d.PRECVTA03-d.DESCVTA03-d.desctotvta03-d.desctotfp03)*d.iva03)/100),2) AS IVA,
(Sum(d.PRECVTA03-d.DESCVTA03-d.desctotvta03-d.desctotfp03))+(ROUND(Sum(((d.PRECVTA03-d.DESCVTA03-d.desctotvta03-d.desctotfp03)*d.iva03)/100),2)) AS TOTAL,
c.ruc31 AS CEDULA,
c.nomcte31 AS NOMBRE
FROM
movpro AS d
LEFT JOIN maefac AS c ON d.NOCOMP03 = c.nofact31
LEFT JOIN maecte ON c.nocte31 = maecte.codcte01
WHERE
d.TIPOTRA03 = '80' AND
c.cvanulado31 <> '9' AND
c.condpag31 = '$condicion' AND 
d.FECMOV03 BETWEEN '$desde 00:00:00' AND '$hasta 23:59:59'
GROUP BY d.NOCOMP03
ORDER BY d.FECMOV03 DESC";
    
    $resultado = mysql_query($sql) or die(mysql_error());
    $registros = mysql_num_rows($resultado);
    
    if ($registros > 0) {        
        $i = 3;
        while ($registro = mysql_fetch_array($resultado)) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $registro['FECHA'])
                    ->setCellValue('B' . $i, $registro['FACTURA'])
                    ->setCellValue('C' . $i, $registro['VENTABTA'])
                    ->setCellValue('D' . $i, $registro['DESCUENTO'])
                    ->setCellValue('E' . $i, $registro['VENTANET'])
                    ->setCellValue('F' . $i, $registro['IVA'])
                    ->setCellValue('G' . $i, $registro['TOTAL'])
                    ->setCellValue('H' . $i, $registro['CEDULA'])
                    ->setCellValue('I' . $i, $registro['NOMBRE']);
            $i++;
        }
    }

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Facturas Cruzadas ' . date("Y-m-d") . '.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>