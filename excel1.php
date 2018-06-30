<?php
require_once "mysql_connect.php";
require_once 'class/PHPExcel.php';
require_once 'class/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=' . iconv('UTF-8', 'big5', '出貨單') . '.xlsx');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objPHPExcel->setActiveSheetIndex(0);
$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle("出貨單");
$objPHPExcel->createSheet();
// $objPHPExcel->getDefaultStyle()->getFont()->setName('微軟正黑體')->setSize(12);


$sql="select * from custom" ;
$result = $mysqli->query($sql) or die($mysqli->connect_error);
$i = 3;
$objActSheet->getColumnDimension('A')->setWidth(15);
$objActSheet->getColumnDimension('B')->setWidth(60);
$objActSheet->getColumnDimension('C')->setAutoSize(true);
$objActSheet->setCellValue("A2", '收貨人：');
$objActSheet->setCellValue("B2", '收貨地址：');
$objActSheet->setCellValue("C2",'收貨電話：');
while ($bill = $result->fetch_assoc()) 
{
	$objActSheet->setCellValue("A{$i}", "{$bill['f_cust_name']}");
	$objActSheet->setCellValue("B{$i}", "{$bill['f_cust_address']}");
	$objActSheet->setCellValue("C{$i}", "{$bill['f_cust_tel']}");
    $objActSheet->getStyle("A{$i}:D{$i}")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $i++;
}
/*
$j = $i - 1;
$objActSheet
    ->setCellValue("A{$i}", '')
    ->setCellValue("B{$i}", '')
    ->setCellValue("C{$i}", '')
    ->setCellValue("D{$i}", "=sum(D5:D{$j})");
*/
$objWriter->save('php://output');
exit;
