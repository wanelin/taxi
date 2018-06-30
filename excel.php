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

$parm=$_REQUEST['parm'];
$query_method=$_REQUEST['query_method'];
$sql_1  = "select * from  custom ";
switch($query_method)
{
case "編號查詢": 
	$sql_2 =" where f_driver_id like '%$parm%'";		
	$sql_3 =" order by f_driver_id  ";
	break;
case "mail查詢":  
	$sql_2 =" where f_driver_email like '%$parm%'";	
	$sql_3 =" order by f_driver_email ";
	break;
case "住址查詢":  
	$sql_2 =" where f_driver_address like '%$parm%'";	
	$sql_3 =" order by f_driver_address ";
	
	break;
case "名字查詢":  
	$sql_2 =" where f_driver_name like '%$parm%'";	
	$sql_3 =" order by f_driver_name ";
	break;
case "電話查詢":  
	$sql_2 =" where f_driver_tel like '$parm%'";	
	$sql_3 =" order by f_driver_tel ";
	break;
case "區域查詢":  
	$sql_2 =" where f_driver_area_code like '%$parm%'";	
	$sql_3 =" order by f_driver_area_code ";
	break;
case "line查詢":  
	$sql_2 =" where f_line_id like '%$parm%'";	
	$sql_3 =" order by f_line_id ";
	break;	
}	

$sql=$sql_1 . $sql_2 . $sql_3 ;
//$result = $mysqli->query($sql) or die($mysqli->connect_error);
$result = $db->query($sql);
$i = 3;
$objActSheet->getColumnDimension('A')->setWidth(15);
$objActSheet->getColumnDimension('B')->setWidth(60);
$objActSheet->getColumnDimension('C')->setAutoSize(true);
$objActSheet->setCellValue("A2", '收貨人：');
$objActSheet->setCellValue("B2", '收貨地址：');
$objActSheet->setCellValue("C2",'收貨電話：');
while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
{
	$objActSheet->setCellValue("A{$i}", "{$row['f_driver_name']}");
	$objActSheet->setCellValue("B{$i}", "{$row['f_driver_address']}");
	$objActSheet->setCellValue("C{$i}", "{$row['f_driver_tel']}");
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
