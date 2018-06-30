<?php
/*  引入  */
require_once('mysql_connect.php'); // Connect to the database.
require_once "class/tcpdf/tcpdf.php";

/*  流程控制  */
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
//$query_tot_num = mysqli_num_rows($result);
$query_tot_num = $result->rowCount();
$row_sn = 0;
 bill_pdf($row_sn);


function bill_pdf($row_sn = "")
{
    global $result;
    $html ="";
    $html='<table border="1" cellpadding="6">';
	$html.="<tr><td>會員姓名</td>";
	$html.="<td>會員住址</td>";
	$html.="<td>電  話</td>";
	$html.="</tr>";
	$i=0;
	;
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
	{
		$html.="<tr><td>".$row['f_driver_name'] . "</td>";
		$html.="<td>".$row['f_driver_address'] . "</td>";
		$html.="<td>".$row['f_driver_tel'] . "</td>";
		$html.="</tr>";
		$i++;
	}
	$html.="</table>";

    $pdf = new TCPDF("P", "mm", "A4", true, 'UTF-8', false);
    $pdf->SetMargins(20, 30);
    $pdf->setHeaderMargin(10);
    $pdf->setPrintHeader(true);
    $pdf->setHeaderFont(array('droidsansfallback', '', 10));
    $pdf->setHeaderData('', 0, "會員清單", date("Y年m月d日 H:i:s"));
    $pdf->SetAutoPageBreak(true,$margin=22);
    $pdf->setFontSubsetting(true);
    $pdf->SetFont('droidsansfallback', '', 12, '', true);
    // $fontname = TCPDF_FONTS::addTTFfont('class/tcpdf/fonts/font.ttf', 'TrueTypeUnicode');
    // $pdf->SetFont($fontname, '', 12, '', false);

    $pdf->AddPage();
    $pdf->writeHTML($html);
    $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.4, 'depth_h' => 0.4, 'color' => array(196, 196, 196)));
    $pdf->Cell(40, 10, "售後服務", 1, 1, 'C', false, '', 2);
    $pdf->setTextShadow(array('enabled' => false));
    $pdf->Write('6', '商品到貨享十天猶豫期之權益（注意！猶豫期非試用期），辦理退貨商品必須是全新狀態且包裝完整，否則將會影響退貨權限。');
    $pdf->Write('6', '如您收到商品，請依正常程序儘速檢查商品，若商品發生新品瑕疵之情形，您可申請更換新品或退貨，請直接點選聯絡我們。');
    $pdf->Write('6', '若您對於購買流程、付款方式、退貨及商品運送方式有疑問，你可直接點選會員中心。', '', false, '', 1);

    $pdf->ln(20);
    $pdf->MultiCell(70, 10, _SHOP_NAME, 0, 'L', 0, 0);
    $pdf->MultiCell(20, 10, '主管', 0, 'L', 0, 0);
    $pdf->Image('images/ck2.png', $pdf->getX(), $pdf->getY() - 10, 30, 30);
    $pdf->MultiCell(30, 10, '', 0, 'L', 0, 0);
    $pdf->MultiCell(20, 10, '承辦', 0, 'L', 0, 0);
    $pdf->MultiCell(30, 10, '', 0, 'L', 0, 1);
	$pdf->Output('出貨單.pdf', 'I');
   // $pdf->Output('出貨單.pdf', 'D');
}
