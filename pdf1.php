<?php
/*  引入  */
require_once "mysql_connect.php";
require_once "class/tcpdf/tcpdf.php";

/*  流程控制  */
$parm=$_REQUEST['parm'];
$query_method=$_REQUEST['query_method'];
$sql_1  = "select * from  custom ";
echo "<script>alert('$query_method')</script>";
switch($query_method)
{
case "編號查詢": 
	$sql_2 =" where f_cust_id like '%$parm%'";		
	$sql_3 =" order by f_cust_id  ";
	break;
case "mail查詢":  
	$sql_2 =" where f_cust_email like '%$parm%'";	
	$sql_3 =" order by f_cust_email ";
	break;
case "住址查詢":  
	$sql_2 =" where f_cust_address like '%$parm%'";	
	$sql_3 =" order by f_cust_address ";
	
	break;
case "名字查詢":  
	$sql_2 =" where f_cust_name like '%$parm%'";	
	$sql_3 =" order by f_cust_name ";
	break;
case "電話查詢":  
	$sql_2 =" where f_cust_tel like '$parm%'";	
	$sql_3 =" order by f_cust_tel ";
	break;
case "區域查詢":  
	$sql_2 =" where f_cust_area_code like '%$parm%'";	
	$sql_3 =" order by f_cust_area_code ";
	break;
case "line查詢":  
	$sql_2 =" where f_line_id like '%$parm%'";	
	$sql_3 =" order by f_line_id ";
	break;	
}	

$sql=$sql_1 . $sql_2 . $sql_3 ;
$result = $mysqli->query($sql) or die($mysqli->connect_error);
 bill_pdf($result);


function bill_pdf($result)
{
    $html ="";
    

    $pdf = new TCPDF("P", "mm", "A4", true, 'UTF-8', false);
    $pdf->SetMargins(20, 30);
    $pdf->setHeaderMargin(10);
    $pdf->setPrintHeader(true);
    $pdf->setHeaderFont(array('droidsansfallback', '', 10));
  //  $pdf->setHeaderData('', 0, "{$bill['user_name']}{$bill['user_sex']}的出貨單", date("Y年m月d日 H:i:s"));
    $pdf->SetAutoPageBreak(true);
    $pdf->setFontSubsetting(true);
    $pdf->SetFont('droidsansfallback', '', 12, '', true);
    // $fontname = TCPDF_FONTS::addTTFfont('class/tcpdf/fonts/font.ttf', 'TrueTypeUnicode');
    // $pdf->SetFont($fontname, '', 12, '', false);
    $html="<table border=1>";
	$i=0;
	while ($bill = $result->fetch_assoc()) 
	{
		$html.="<tr><td>".$bill['f_cust_name'] . "</td>";
		$html.="<tr><td>".$bill['f_cust_address'] . "</td>";
		$html.="<tr><td>".$bill['f_cust_tel'] . "</td>";
		$html.="</tr>";
		$i++;
	}
	$html.="</tr>";
    $pdf->AddPage();
   // $pdf->writeHTML($html);
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

    $pdf->Output('會員清單單.pdf', 'D');
}
