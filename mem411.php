<?php
	error_reporting(0);
require_once('mysql_connect.php'); // Connect to the database.
//require_once('pdo.php'); // Connect to the database.
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
	$f_driver_id      =trim($_POST["f_driver_id"]);                  
	$f_driver_name    =trim($_POST["f_driver_name"]);  	
	$f_driver_tel     =trim($_POST["f_driver_tel"]);
	$f_driver_address    =trim($_POST["f_driver_address"]);  
	$f_line_id    =trim($_POST["f_line_id"]);  
	$f_driver_email   =trim($_POST["f_driver_email"]);
	$f_driver_area    =$_POST["f_driver_area"];
	$query_method	=$_POST["query_method"];
	//$query_method="編號查詢";
	$page_no				=$_POST["page_no"];				
	$f_contact_number		=$_POST["f_contact_number2"]; 		
	$f_registration_number	=$_POST["f_registration_number2"]; 
	$f_weight				=$_POST["f_weight2"]; 				
	$f_length				=$_POST["f_length2"]; 				
	$f_width				=$_POST["f_width2"]; 				
	$f_height				=$_POST["f_height2"]; 				
	$f_property 			=$_POST["f_property2"]; 		
	$f_equiment             =$_POST["f_equiment2"];
	$sel_type      			=$_POST["sel_type"];
	$sno           			=$_POST["sno"];
	$out           			=$_POST["out"];
	$f_mat_id				=$_POST["f_mat_id"];
   $f_driver_name1="";
  // $out=iconv("utf-8", "big5",$_POST["out"]);
 //  $out='chk'; 
	$pri_echo ="n".$f_identity1 ; 
    $display="y";
	$up_line="";
	$down_line="";
	$out="照片上傳";
	switch($out)
    {		
		case "照片上傳":
/*		
			$files = array();
			$tmp=trim($f_mat_id);
			$filename1=$tmp . ".jpg" ;		
			$uploaddir =  "./pic/mat/";
			
			//$file = $uploaddir.$filename1;       
			foreach($_FILES as $file) //將每個圖檔上傳
			{
				if(move_uploaded_file($file['tmp_name'], $uploaddir.$filename1))
				{
					$files[] = $uploaddir .$file['name'];
					$error = false;
				}				
			}
			*/
			$display="n";
			echo "<script>alert('back')</script>";
			break;
		case '刪除' :		
			//$sql="delete from custom where sno = $sno";  //刪除		
			//$mysqli->query($sql) or die($mysqli->connect_error);
			
			$sql = "DELETE FROM `custom` WHERE `sno` = :sn";
			$sth = $db->prepare($sql);
			$sth->execute(array(':sn' => $sno));			
			header("Content-Type: text/xml;charset=utf8");
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>刪除成功$sno</pri_echo>";			
			echo "</factory>";
			$display="n";			
			break;
		case '修改司機資料' :
		/*
		    $pri_echo="";
			$input_date = date("Y-m-d",mktime());
			$year=date("y");
			$month=date("m");
			$defaut_date=$year.$month;
			$update_flg="f";			
			$len=strlen($f_driver_email);
			if ($len>0)
			{
				$input=array(':f_driver_email' => $f_driver_email,':f_passwd' => $f_passwd2,':sno' => $sno);
				$sql = "SELECT * FROM `custom` WHERE f_driver_email =':f_driver_email' and f_passwd =':f_passwd' and sno !=:sno";
				$sth = $db->prepare($sql);
				$sth->execute($input); 
				$result = $sth->fetch(PDO::FETCH_ASSOC);
				//$sn_index=mysqli_num_rows($result1);
				$sn_index=$result1->rowCount();
				if ($sn_index >0) 
				{
					$update_flg="f1";
					$pri_echo = "此司機(EMAIL+密碼)別的司機已使用" .$sql;
				} 
				else
				{
					$update_flg="t";					
				}
			}
			$len=strlen($f_line_id);
			if ($len>0)
			{
				
				$input=array(':f_line_id' => $f_line_id,':f_passwd' => $f_passwd2,':sno' => $sno);
				$sql = "SELECT * FROM `custom` WHERE f_line_id= =':f_line_id=' and f_passwd =':f_passwd' and sno !=:sno";
				$sth = $db->prepare($sql);
				$sth->execute($input); 
				$result = $sth->fetch(PDO::FETCH_ASSOC);
				//$sn_index=mysqli_num_rows($result1);
				$sn_index=$result1->rowCount();
				if ($sn_index>0) 
				{
					$update_flg="f2";
					$pri_echo .= "此司機(line+密碼)別的司機已使用" .$sql;
				} 
				else
				{
					$update_flg="t";					
				}
			}
			*/
			$update_flg="t";			
			if ($update_flg =="t") 
			{				
				$input = array(':f_driver_email'  		=> $f_driver_email, 
							   ':f_passwd'      		=> $f_passwd,
							   ':f_celephone'    		=> $f_celephone,  
							   ':f_driver_tel'     		=> $f_driver_tel,   	
							   ':f_driver_address'    	=> $f_driver_address,  
							   ':f_line_id'    		    => $f_line_id,  
							   ':f_driver_name'		    => $f_driver_name,			
							   ':f_contact_number'		=> $f_contact_number, 		
							   ':f_registration_number' => $f_registration_number, 
							   ':f_weight'				=> $f_weight, 				
							   ':f_length'				=> $f_length, 				
							   ':f_width'				=> $f_width, 				
							   ':f_height'				=> $f_height,
							   ':f_c_date'              => $f_c_date,    
							   ':sno'                   => $sno);				
				$sql = "UPDATE custom 
						SET f_driver_email  	    	=:f_driver_email,  	    	
						    f_passwd         		=:f_passwd,         		
						    f_celephone    		    =:f_celephone,    		    
						    f_driver_tel     		    =:f_driver_tel,     		    
						    f_driver_address 		    =:f_driver_address, 		    
						    f_line_id    		    =:f_line_id,    		    
						    f_driver_name		    =:f_driver_name,		    
						    f_contact_number 		=:f_contact_number, 		
						    f_registration_number   =:f_registration_number,   
						    f_weight 				=:f_weight, 				
						    f_length				=:f_length,				
						    f_width				    =:f_width,				    
						    f_height				=:f_height,
                            f_c_date                =:f_c_date 							
							WHERE sno    =:sno";							
						//    f_property 			=
						//    f_equiment             =
							
							
				$sth = $db->prepare($sql);
				$sth->execute($input);
				
				$pri_echo ="司機更改完成" . $sno;				
			}
/*			
			$sql="select * from custom where sno=$sno";  //判斷是否重複
			// $result =$mysqli->query($sql) or die($mysqli->connect_error); 
			$result = $db->query($sql);
			//$sn_index=mysqli_num_rows($result);
			$sn_index=$result->rowCount();
			//$row=$result->fetch_assoc();
			$row = $result->fetch(PDO::FETCH_ASSOC);			
			$f_driver_id1=$row["f_driver_id"]; 
			
*/			
			$display="n";
			header("Content-Type: text/xml;charset=utf8");
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";
			echo "<f_driver_id>$f_driver_id1</f_driver_id>";
			echo "</factory>";
			break;		
        case '新增司機資料' :
		    $input_date = date("Y-m-d",mktime());
			$year=date("y");
			$month=date("m");
			$defaut_date=$year.$month;					
			$sql="select * from custom where f_driver_id like '$defaut_date%' order by f_driver_id DESC";  //判斷是否有使用者帳號    
			// $result =$mysqli->query($sql) or die($mysqli->connect_error);
			$result = $db->query($sql);
			//$sn_index=mysqli_num_rows($result1);
			$sn_index=$result->rowCount();
			if ($sn_index>0) 
			{
				//$row=$result->fetch_assoc();
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$f_driver_id=$row["f_driver_id"];
				$f_driver_id_int=(int) $f_driver_id;					
				$f_driver_id=$f_driver_id_int+1;
			}
			else
			{					
				$f_driver_id=$year . $month . "0001";					
			}						
			$f_driver_id1=strtolower($f_driver_id);			
			
			$input = array(':f_driver_email'=>$f_driver_email,':f_driver_id' =>$f_driver_id1,':f_passwd' =>$f_passwd, 
			               ':f_driver_name'=>$f_driver_name,':f_birthday'=>$f_birthday,':f_celephone'=>$f_celephone,
						   ':f_driver_tel'=>$f_driver_tel,':f_driver_address'=>$f_driver_tel,':f_line_id'=>$f_line_id,
						   ':f_c_date'=>$f_c_date);
			$sql = "INSERT INTO `custom` (f_driver_email,f_driver_id,f_passwd,f_driver_name,f_birthday,f_celephone,f_driver_tel,f_driver_address,f_line_id,f_c_date)
			VALUES(:f_driver_email,:f_driver_id,:f_passwd,:f_driver_name,:f_birthday,:f_celephone,:f_driver_tel,:f_driver_address,:f_line_id,:f_c_date)";
			$sth = $db->prepare($sql);			
			$sth->execute($input);			
			$pri_echo ="司機新增完成"  ;
			$pri_echo =$sql;
			break;
         case "chk" :	
			
			$today1= date("Y-m-d",mktime());	
			$sql_1  = "select * from  custom ";
			switch($query_method)
			{
			case "編號查詢": 
				$sql_2 =" where f_driver_id like '%$f_driver_id%'";		
				$sql_3 =" order by f_driver_id  ";
				break;
			case "mail查詢":  
				$sql_2 =" where f_driver_email like '%$f_driver_email%'";	
				$sql_3 =" order by f_driver_email ";
				break;
			case "住址查詢":  
				$sql_2 =" where f_driver_address like '%$f_driver_address%'";	
				$sql_3 =" order by f_driver_address ";
				break;
			case "名字查詢":  
				$sql_2 =" where f_driver_name like '%$f_driver_name%'";	
				$sql_3 =" order by f_driver_name ";
				break;
			case "電話查詢":  
				$sql_2 =" where f_driver_tel like '$f_driver_tel%'";	
				$sql_3 =" order by f_driver_tel ";
				break;
			case "區域查詢":  
				$sql_2 =" where f_driver_area_code like '%$f_driver_area%'";	
				$sql_3 =" order by f_driver_area_code ";
				break;
			case "line查詢":  
				$sql_2 =" where f_line_id like '%$f_line_id%'";	
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
				$f_driver_email= $row["f_driver_email"];
				$f_driver_id= $row["f_driver_id"];
				$f_driver_name= $row["f_driver_name"];
				$f_area= $row["f_driver_area_code"];
				$f_driver_address= $row["f_driver_address"];
				$f_driver_tel= $row["f_driver_tel"];
				
				$f_contact_number		= $row["f_contact_number"];		
				$f_registration_number =  $row["f_registration_number"]; 
				$f_weight				= $row["f_weight"]; 				
				$f_length				= $row["f_length"]; 				
				$f_width				= $row["f_width"]; 				
				$f_height				= $row["f_height"];
				$f_c_date               = $row["f_c_date"];
				$sno=$row["sno"];
				echo "<sales>";
				echo "<f_driver_email>$f_driver_email</f_driver_email>";
				echo "<f_driver_id>$f_driver_id</f_driver_id>";
				echo "<f_driver_name>$f_driver_name</f_driver_name>";
				echo "<f_driver_address>$f_driver_address</f_driver_address>";
				echo "<f_driver_area>$f_area</f_driver_area>";
				echo "<f_driver_tel>$f_driver_tel</f_driver_tel>";
				
				echo "<f_contact_number>$f_contact_number</f_contact_number>";
                echo "<f_registration_number>$f_registration_number</f_registration_number>";
                echo "<f_weight>$f_weight</f_weight>";
                echo "<f_length>$f_length>$</f_length>";
                echo "<f_width>$f_width</f_width>";
                echo "<f_height>$f_height</f_height>";
                echo "<f_c_date>$f_c_date</f_c_date>";                              
				echo "<sno>$sno</sno>";	
				echo "</sales>";
			}
			echo "</root>";
			$display="n";
			break;
		case '列印司機資料' :		  
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
				$objActSheet->setCellValue("A{$i}", "{$bill['f_driver_name']}");
				$objActSheet->setCellValue("B{$i}", "{$bill['f_driver_address']}");
				$objActSheet->setCellValue("C{$i}", "{$bill['f_driver_tel']}");
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
		echo "<pri_echo>test</pri_echo>";
		echo "<up_line>$up_line</up_line>";
		echo "<down_line>$down_line</down_line>";
		echo "<f_driver_id>$f_driver_id1</f_driver_id>";
		echo "<f_driver_name>$f_driver_name1</f_driver_name>";	
		echo "</factory>";
	}
?>