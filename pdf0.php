<?php
/*  引入  */
		
		$urlToEncode="http://superiorwebsys.com";
		generateQRwithGoogle($urlToEncode);
		function generateQRwithGoogle($url,$widthHeight ='150',$EC_level='L',$margin='0') {
				$url = urlencode($url); 
				echo '<img src="http://chart.apis.google.com/chart?chs='.$widthHeight.
		'x'.$widthHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.
		'&chl='.$url.'" alt="QR code" widthHeight="'.$widthHeight.
		'" widthHeight="'.$widthHeight.'"/>';
		}
		
		
		require_once "class/tcpdf/tcpdf.php";
    $html ="";
    $html='<table border="1" cellpadding="6">';
		$html.="<tr><td>會員姓名</td>";
		$html.="<td>會員住址</td>";
		$html.="<td>電  話</td>";
		$html.="</tr>";
		$html.="<tr><td>林文祥老師</td>";
		$html.="<td>台中市三民路</td>";
		$html.="<td>0972200231</td>";
		$html.="</tr>";		
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
$pdf->ln(30);
    $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.4, 'depth_h' => 0.4, 'color' => array(0, 0, 255)));
    $pdf->Cell(40, 20, "售後服務", 1, 0, 'C', false, '', 2);
   
    $pdf->writeHTMLCell(60,10,100,80,"test",0);






		
	  $pdf->Output('會員基本資料.pdf', 'I');
?>