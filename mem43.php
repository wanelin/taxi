<?php
	error_reporting(0);
//require_once('mysql_connect.php'); // Connect to the database.
require_once('pdo.php'); // Connect to the database.
   require_once "class/tcpdf/tcpdf.php";   
/* 產生 PDF 物件
   $pdf = new TCPDF("P", "mm", "A4", true, 'UTF-8', false);
   $pdf->SetMargins(20, 30);
   $pdf->setHeaderMargin(10);
   $pdf->setPrintHeader(true);
   $pdf->setHeaderFont(array('droidsansfallback', '', 10));
	*/
	$input_date = date("Y-m-d H:i:s",mktime());
    $ip=$_SERVER['REMOTE_ADDR'];	
	$f_cust_id      =trim($_POST["f_cust_id"]);                  
	$f_cust_name    =trim($_POST["f_cust_name"]);  	
	$f_cust_tel     =trim($_POST["f_cust_tel"]);
	$f_cust_addr    =trim($_POST["f_cust_addr"]);  
	$f_cust_line    =trim($_POST["f_cust_line"]);  
	$f_cust_email   =trim($_POST["f_cust_email"]);
	$f_cust_area    =$_POST["f_cust_area"];
	$query_method	=$_POST["query_method"];
	//$query_method="編號查詢";
	$page_no		=$_POST["page_no"];						
	$f_passwd2      =$_POST["f_passwd2"];  
	$f_birthday2    =$_POST["f_birthday2"];  
	$f_celephone2   =$_POST["f_celephone2"];
	$f_introduction2=$_POST["f_introduction2"];
	$sel_type       =$_POST["sel_type"];
	$sno            =$_POST["sno"];
	$out            =$_POST["out"];
   $f_cust_name1="";
   $out=iconv("utf-8", "big5",$_POST["out"]);
 //  $out='chk'; 
	$pri_echo ="n".$f_identity1 ; 
    $display="y";
	$up_line="";
	$down_line="";
	switch($out)
    {
		case 'member_check' :
			$f_introduction2=trim($f_introduction2);							
			$sql="select * from custom where  f_cust_id  = '$f_introduction2'";  //判斷介紹人是否存在			
			//$result =$mysqli->query($sql) or die($mysqli->connect_error);			
			$result = $db->query($sql);
			//$sn_index=mysqli_num_rows($result);
			$sn_index = $result->rowCount();
			
			if ($sn_index == 0) 
			{					
				$pri_echo = "介紹人帳號不存在" ; 
				$f_cust_name="";
			}
			else
			{
				$pri_echo="ok";
				//$row=$result->fetch_assoc();
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$f_cust_name=$row["f_cust_name"];				
			}
			$display="n";			
		    header("Content-Type: text/xml;charset=utf8");
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";
			echo "<f_cust_id>$f_introduction2</f_cust_id>";
			echo "<f_cust_name>$f_cust_name</f_cust_name>";			
			echo "</factory>";			
			break;
		
		case '刪除' :		
			$sql="delete from custom where sno = $sno";  //刪除		
			$mysqli->query($sql) or die($mysqli->connect_error);
			
			header("Content-Type: text/xml;charset=utf8");
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>刪除成功</pri_echo>";			
			echo "</factory>";
			$display="n";			
			break;
		case '修改會員資料' :
		    $pri_echo="";
			$input_date = date("Y-m-d",mktime());
			$year=date("y");
			$month=date("m");
			$defaut_date=$year.$month;
			$update_flg="f";			
			$len=strlen($f_cust_email);
			if ($len>0)
			{
				$sql="select * from custom where  f_cust_email = '$f_cust_email' and f_passwd = '$f_passwd2' and sno != " . $sno;   //判斷是否重複     
				//$result1 =$mysqli->query($sql) or die($mysqli->connect_error);
				$result1 = $db->query($sql);
			
				//$sn_index=mysqli_num_rows($result1);
				$sn_index=$result1->rowCount();
				if ($sn_index >0) 
				{
					$update_flg="f1";
					$pri_echo = "此會員(EMAIL+密碼)別的會員已使用" .$sql;
				} 
				else
				{
					$update_flg="t";					
				}
			}
			$len=strlen($f_cust_line);
			if ($len>0)
			{
				$sql="select * from custom where  f_line_id= '$f_cust_line' and f_passwd ='$f_passwd2' and sno !=" .$sno;   //判斷是否重複     
				//$result1 =$mysqli->query($sql) or die($mysqli->connect_error);
				$result1 = $db->query($sql);			
				//$sn_index=mysqli_num_rows($result1);
				$sn_index=$result1->rowCount();
				if ($sn_index>0) 
				{
					$update_flg="f2";
					$pri_echo .= "此會員(line+密碼)別的會員已使用" .$sql;
				} 
				else
				{
					$update_flg="t";					
				}
			}
			$len=strlen($f_celephone2);
			if ($len>0)
			{
				$sql="select * from custom where  f_celephone= '$f_celephone2' and f_passwd = '$f_passwd2' and sno !=" .$sno;  //判斷是否重複     
				//$result1 =$mysqli->query($sql) or die($mysqli->connect_error);
				$result1 = $db->query($sql);			
				//$sn_index=mysqli_num_rows($result1);
				$sn_index=$result1->rowCount();
				if ($sn_index >0) 
				{
					$update_flg="f3";
					$pri_echo .= "此會員(手機號碼+密碼)別的會員已使用";
				} 
				else
				{
					$update_flg="t";					
				}
			}					
			if ($update_flg =="t") 
			{				
				$sql="update  custom  set ";
				$sql.="f_cust_email='$f_cust_email',";					
				$sql.="f_passwd='$f_passwd2',";       
				$sql.="f_cust_name='$f_cust_name',"; 
				$sql.="f_birthday='$f_birthday2',";     
				$sql.="f_celephone='$f_celephone2',";
				$sql.="f_cust_tel='$f_cust_tel',";					
				$sql.="f_cust_address='$f_cust_addr',";      
				$sql.="f_line_id='$f_cust_line',";      
				$sql.="f_introduction='$f_introduction2',";						
				$sql.="f_c_date='$input_date'";
				$sql.=" where sno=$sno";
				$mysqli->query($sql) or die($mysqli->connect_error);
				$pri_echo ="會員更改完成" . $sql;				
			}	
			$sql="select * from custom where sno=$sno";  //判斷是否重複
			// $result =$mysqli->query($sql) or die($mysqli->connect_error); 
			$result = $db->query($sql);
			//$sn_index=mysqli_num_rows($result);
			$sn_index=$result->rowCount();
			//$row=$result->fetch_assoc();
			$row = $result->fetch(PDO::FETCH_ASSOC);			
			$f_cust_id1=$row["f_cust_id"]; 
			$display="n";	
			header("Content-Type: text/xml;charset=utf8");
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";
			echo "<f_cust_id>$f_cust_id1</f_cust_id>";
			echo "</factory>";
			break;		
        case '新增會員資料' :
		    $input_date = date("Y-m-d",mktime());
			$year=date("y");
			$month=date("m");
			$defaut_date=$year.$month;					
			$sql="select * from custom where f_cust_id like '$defaut_date%' order by f_cust_id DESC";  //判斷是否有使用者帳號    
			// $result =$mysqli->query($sql) or die($mysqli->connect_error);
			$result = $db->query($sql);
			//$sn_index=mysqli_num_rows($result1);
			$sn_index=$result->rowCount();
			if ($sn_index>0) 
			{
				//$row=$result->fetch_assoc();
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$f_cust_id=$row["f_cust_id"];
				$f_cust_id_int=(int) $f_cust_id;					
				$f_cust_id=$f_cust_id_int+1;
			}
			else
			{					
				$f_cust_id=$year . $month . "0001";					
			}						
			$f_cust_id1=strtolower($f_cust_id);
			$sql="insert into custom  (f_cust_email,f_cust_id,f_passwd,f_cust_name,f_birthday,f_celephone,f_cust_tel,f_cust_address,f_line_id,f_introduction,f_c_date) values(";
			$sql.="'$f_cust_email',";
			$sql.="'$f_cust_id',";
			$sql.="'$f_passwd2',";       
			$sql.="'$f_cust_name',";    
			$sql.="'$f_birthday2',";     
			$sql.="'$f_celephone2',";
			$sql.="'$f_cust_tel',";					
			$sql.="'$f_cust_addr',";      
			$sql.="'$f_cust_line',";      
			$sql.="'$f_introduction2',";						
			$sql.="'$input_date')";
			$mysqli->query($sql) or die($mysqli->connect_error);
			$pri_echo ="會員新增完成"  ;
			break;
         case "chk" :	
			
			$today1= date("Y-m-d",mktime());	
			$sql_1  = "select * from  custom ";
			switch($query_method)
			{
			case "編號查詢": 
				$sql_2 =" where f_cust_id like '%$f_cust_id%'";		
				$sql_3 =" order by f_cust_id  ";
				break;
			case "mail查詢":  
				$sql_2 =" where f_cust_email like '%$f_cust_email%'";	
				$sql_3 =" order by f_cust_email ";
				break;
			case "住址查詢":  
				$sql_2 =" where f_cust_address like '%$f_cust_addr%'";	
				$sql_3 =" order by f_cust_address ";
				break;
			case "名字查詢":  
				$sql_2 =" where f_cust_name like '%$f_cust_name%'";	
				$sql_3 =" order by f_cust_name ";
				break;
			case "電話查詢":  
				$sql_2 =" where f_cust_tel like '$f_cust_tel%'";	
				$sql_3 =" order by f_cust_tel ";
				break;
			case "區域查詢":  
				$sql_2 =" where f_cust_area_code like '%$f_cust_area%'";	
				$sql_3 =" order by f_cust_area_code ";
				break;
			case "line查詢":  
				$sql_2 =" where f_line_id like '%$f_cust_line%'";	
				$sql_3 =" order by f_line_id ";
				break;	
			}	
			$sql=$sql_1 . $sql_2 . $sql_3 ;
			//$result =$mysqli->query($sql) or die($mysqli->connect_error);
			$result = $db->query($sql);
			//$query_tot_num = mysqli_num_rows($result);
			$query_tot_num = $result->rowCount();
			
						
			if($page_no<2)
			{	
				$sql .="  limit 0,30" ;
			}
			else
			{
				$from=($page_no-1)*30;					 
				$sql.="  limit $from,30" ;						
			}
			
			//$result = $mysqli->query($sql) or die($mysqli->connect_error);			
			//$sn_index = mysqli_num_rows($result);   //查詢結果後的記錄筆數
			$result = $db->query($sql);
			$sn_index = $result->rowCount();
			 header("Content-Type: text/xml;charset=utf8"); 
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<root>";
			echo "<res_echo>$sql   $sn_index  $query_tot_num</res_echo>";	
			echo "<query_tot_num>" . $query_tot_num . "</query_tot_num>";
			for ($i=0;$i<$sn_index;$i++)
			{
				//$row=$result->fetch_assoc();
				$row = $result->fetch(PDO::FETCH_ASSOC);				
				$f_cust_mail= $row["f_cust_mail"];
				$f_cust_id= $row["f_cust_id"];
				$f_cust_name= $row["f_cust_name"];
				$f_area= $row["f_cust_area_code"];
				$f_cust_addr= $row["f_cust_address"];
				$f_cust_tel= $row["f_cust_tel"];
				
				$f_passwd= $row["f_passwd"];
				$f_birthday= $row["f_birthday"];
				$f_celephone= $row["f_celephone"];
				$f_line_id= $row["f_line_id"];
				$f_introduction= $row["f_introduction"];
				$sign_date=$row["f_c_date"];	
				$sno=$row["sno"];
				echo "<sales>";
				echo "<f_cust_mail>$f_cust_mail</f_cust_mail>";
				echo "<f_cust_id>$f_cust_id</f_cust_id>";
				echo "<f_cust_name>$f_cust_name</f_cust_name>";
				echo "<f_cust_addr>$f_cust_addr</f_cust_addr>";
				echo "<f_cust_area>$f_area</f_cust_area>";
				echo "<f_cust_tel>$f_cust_tel</f_cust_tel>";
				echo "<f_passwd>$f_passwd</f_passwd>";	
				echo "<f_birthday>$f_birthday</f_birthday>";	
				echo "<f_celephone>$f_celephone</f_celephone>";	
				echo "<f_line_id>$f_line_id</f_line_id>";	
				echo "<f_introduction>$f_introduction</f_introduction>";	
				echo "<sno>$sno</sno>";	
				echo "</sales>";
			}
			echo "</root>";
			$display="n";
			break;
		case '列印會員資料' :		  
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

			$bill_sn = isset($_REQUEST['bill_sn']) ? my_filter($_REQUEST['bill_sn'], "int") : 0;
			$sql     = "SELECT * FROM `custom` ";
			//$result = $mysqli->query($sql) or die($mysqli->connect_error);
			$result = $db->query($sql);
			
			$i = 3;
			$objActSheet->getColumnDimension('A')->setWidth(15);
			$objActSheet->getColumnDimension('B')->setWidth(60);
			$objActSheet->getColumnDimension('C')->setAutoSize(true);
			$objActSheet->setCellValue("A2", '收貨人：');
			$objActSheet->setCellValue("B2", '收貨地址：');
			$objActSheet->setCellValue("C2",'收貨電話：');
			//$bill=$result->fetch_assoc();			
			while ($bill = $result->fetch(PDO::FETCH_ASSOC)) 
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
			$display="n";
			break;
    }	
	if ($display=="y")	
	{
		header("Content-Type: text/xml;charset=utf8"); 
		echo '<?xml version="1.0" encoding="utf8"?> ';
		echo "<factory>";
		echo "<pri_echo>$pri_echo</pri_echo>";
		echo "<up_line>$up_line</up_line>";
		echo "<down_line>$down_line</down_line>";
		echo "<f_cust_id>$f_cust_id1</f_cust_id>";
		echo "<f_cust_name>$f_cust_name1</f_cust_name>";
		echo "<f_cust_name>$f_cust_name1</f_cust_name>";		
		echo "</factory>";
	}
?>