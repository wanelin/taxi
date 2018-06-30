<?php
error_reporting(0);
session_start();
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
//接收前台傳來的資料	
	$f_driver_id      =trim($_POST["f_driver_id"]);                  
	$f_driver_name    =trim($_POST["f_driver_name"]);  	
	$f_driver_tel     =trim($_POST["f_driver_tel"]);
	$f_driver_address =trim($_POST["f_driver_address"]);  
	$f_celephone      =trim($_POST["f_celephone"]);  
	$f_driver_email   =trim($_POST["f_driver_email"]);
	$f_driver_area    =$_POST["f_driver_area"];
	$query_method	  =$_POST["query_method"];             //$query_method="編號查詢";	
	$page_no				=$_POST["page_no"];				
	$f_contact_number		=$_POST["f_contact_number"]; 		             
	$f_registration_number	=$_POST["f_registration_number"]; 
	$f_weight				=$_POST["f_weight"]; 				
	$f_length				=$_POST["f_length"]; 				
	$f_width				=$_POST["f_width"]; 				
	$f_height				=$_POST["f_height"]; 				
	$f_property 			=$_POST["f_property"]; 		
	$f_equitment0           =$_POST["f_equitment"];
	$f_equitment=explode(",",$f_equitment0);             //將接收的字串轉成陣列	
	$sel_type      			=$_POST["sel_type"];
	$f_driver_id_top      	=$_POST["f_driver_id_top"];
	$sno           			=$_POST["sno"];
	$out           			=$_POST["out"]; 
    $search_key             =$_SESSION["f_celephone"];
		
 // $out=iconv("utf-8", "big5",$_POST["out"]);
 //  $out='chk'; 
 	$pri_echo ="" ; 
    $display="y";
function pic_upload($f_driver_id_buf)  //上傳圖片
{
	$pic_type0=$_POST["pic_type"];
	$pic_type=explode(",",$pic_type0);  //將接收的字串轉成陣列
	$j=-1;      
	foreach($_FILES as $file) //將每個圖檔上傳
	{
		$j=$j+1;
		$path=["","cargo/","cargo/","f_insurance/","f_vehicle_license/","f_driving_license/","f_ID_card/"];
		$file_name=$f_driver_id_buf;
		if($pic_type[$j]<3)
		{
			$file_name=$f_driver_id_buf . "_" . $pic_type[$j];
		}				
		$uploaddir =  "./pic/" . $path[$pic_type[$j]]; 
		$type=$file["type"];	
		if ($type=='image/JPEG' || $type=='image/jpeg')
		{
			$filename1=$file_name . ".jpg" ;
		}
		else
		{
			if ( $type=='image/PNG' || $type=='image/png')
			{
				$filename1=$file_name . ".png" ;
			}
			else
			{
				$filename1=$file["name"];	
			}
		}
		//$filename1=$s . "_" . $j . "_" . $file["name"];	
		if(move_uploaded_file($file['tmp_name'], $uploaddir.$filename1))
		{					
			$error = false;
		}				
	}
}	
switch($out)
{		

case "照片上傳":
	$f_driver_id=$_POST["f_driver_id"];
	pic_upload($f_driver_id);
	$display="n";
	echo "檔案名稱: " .$filename1;
	break;

case '修改司機資料' :

	$update_flg="t";			
	if ($update_flg =="t") 
	{				
		$input = array(':f_driver_email'  		=> $f_driver_email, 
					   ':f_passwd'      		=> $f_passwd,
					   ':f_celephone'    		=> $f_celephone,  
					   ':f_driver_tel'     		=> $f_driver_tel,   	
					   ':f_driver_address'    	=> $f_driver_address, 
					   ':f_driver_name'		    => $f_driver_name,			
					   ':f_contact_number'		=> $f_contact_number, 		
					   ':f_registration_number' => $f_registration_number, 
					   ':f_weight'				=> $f_weight, 				
					   ':f_length'				=> $f_length, 				
					   ':f_width'				=> $f_width, 				
					   ':f_height'				=> $f_height,
					   ':f_property'			=> $f_property,
					   ':f_c_date'              => $f_c_date,    
					   ':sno'                   => $sno);				
		$sql = "UPDATE custom 
				SET f_driver_email  	 	=:f_driver_email,  	    	
					f_passwd         		=:f_passwd,         		
					f_celephone    		  	=:f_celephone,    		    
					f_driver_tel     		=:f_driver_tel,     		    
					f_driver_address 		=:f_driver_address, 		    
					f_driver_name		  	=:f_driver_name,		    
					f_contact_number 		=:f_contact_number, 		
					f_registration_number 	=:f_registration_number,   
					f_weight 				=:f_weight, 				
					f_length				=:f_length,				
					f_width				  	=:f_width,				    
					f_height				=:f_height,
					f_property 				=:f_property,
					f_c_date              	=:f_c_date 							
					WHERE sno             	=:sno";	
		$sth = $db->prepare($sql);
		$sth->execute($input);
		//處理相關設備
		/*
		$sql = "DELETE FROM `equitment` WHERE `f_driver_id` = '$f_driver_id'";			
		$sth = $db->prepare($sql);			
		$sth->execute(array(':f_driver_id'=>$f_driver_id));
		
		for ($i=0;$i<count($f_equitment);$i++)
		{				
			$input = array(':f_driver_id' =>$f_driver_id,':f_equitment' =>$f_equitment[$i]); 
			$sql = "INSERT INTO `equitment` (f_driver_id,f_equitment)
							  VALUES(:f_driver_id,:f_equitment)";
			$sth = $db->prepare($sql);			
			
			$sth->execute($input);
		} 	
*/		
		$pri_echo = " 司機更改完成"  ;
		
	}
	$sql_1 = "select * from custom where  f_driver_id>='$f_driver_id_top'  order by f_driver_id";
	$sql_2 ="";
	$sql_3 ="";
	$display="y";
	break;        
case "chk" :			
	$today1= date("Y-m-d",mktime());
	$sql_1  = "select * from  custom ";
	switch($query_method)
	{
	case "編號查詢": 
		$sql_2 =" where f_driver_id = '$search_key'";
		break;

	case "手機查詢":  
		$sql_2 =" where f_celephone = '$search_key'";
		break;	
	}
	$display="y";
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
	$sql=$sql_1 . $sql_2 ;
	$result = $db->query($sql);		
	$sn_index = $result->rowCount();
	$pri_echo	.=$sn_index;	
	header("Content-Type: text/xml;charset=utf8"); 
	echo '<?xml version="1.0" encoding="utf8"?> ';
	echo "<root>";
	echo "<pri_echo>$sql</pri_echo>";	
	if ($sn_index>0)
	{
		//$row=$result->fetch_assoc();
		$row = $result->fetch(PDO::FETCH_ASSOC);				
		$f_driver_email= $row["f_driver_email"];
		$f_driver_id= $row["f_driver_id"];
		$f_driver_name= $row["f_driver_name"];
		$f_area= $row["f_driver_area_code"];
		$f_driver_address= $row["f_driver_address"];
		$f_driver_tel= $row["f_driver_tel"];
		$f_celephone= $row["f_celephone"];
		
		$f_contact_number		= $row["f_contact_number"];		
		$f_registration_number  = $row["f_registration_number"]; 
		$f_weight				= $row["f_weight"]; 				
		$f_length				= $row["f_length"]; 				
		$f_width				= $row["f_width"]; 				
		$f_height				= $row["f_height"];
		$f_property				= $row["f_property"];
		$f_c_date               = $row["f_c_date"];
		$sno					= $row["sno"];
		echo "<sales>";
		echo "<f_driver_email>$f_driver_email</f_driver_email>";
		echo "<f_driver_id>$f_driver_id</f_driver_id>";
		echo "<f_driver_name>$f_driver_name</f_driver_name>";
		echo "<f_driver_address>$f_driver_address</f_driver_address>";
		echo "<f_driver_area>$f_area</f_driver_area>";
		echo "<f_driver_tel>$f_driver_tel</f_driver_tel>";
		echo "<f_celephone>$f_celephone</f_celephone>";				
		echo "<f_contact_number>$f_contact_number</f_contact_number>";
		echo "<f_registration_number>$f_registration_number</f_registration_number>";
		echo "<f_weight>$f_weight</f_weight>";
		echo "<f_length>$f_length</f_length>";
		echo "<f_width>$f_width</f_width>";
		echo "<f_height>$f_height</f_height>";
		echo "<f_property>$f_property</f_property>";
		echo "<f_c_date>$f_c_date</f_c_date>"; 
		/*
		echo "<sn_index_1>$sn_index_1</sn_index_1>";				
		$input = array(':f_driver_id' =>$f_driver_id);
		$sql_1  = "select * from equitment  where f_driver_id = '$f_driver_id'";
		$result_1=$db->prepare($sql_1);
		$result_1->execute();
	   // $sth = $db->prepare($sql_1);
	   
		$sn_index_1 = $result_1->rowCount();
	
		if ($sn_index_1>0)
		{
			echo "<f_equitment>";
			for ($j=0;$j<$sn_index_1;$j++)
			{
				$row_1 = $result_1->fetch(PDO::FETCH_ASSOC);
				$f_equitment= $row_1["f_equitment"];
				echo "<f_equitment_det>$f_equitment</f_equitment_det>";
			}
			echo "</f_equitment>";
		}
		*/
		echo "<sno>$sno</sno>";	
		echo "</sales>";
		$sql = "select * from  demand order by f_post_date ";
		$result = $db->query($sql);
		$sn_index = $result->rowCount();
		echo "<demand>";
		for ($i=0;$i<$sn_index;$i++)
		{
			$row = $result->fetch(PDO::FETCH_ASSOC);				
			$f_demand_id	= $row["f_demand_id"];
			$f_object 		= $row["f_object"];
			$f_from_area    = $row["f_from_area"];
			$f_from_address = $row["f_from_address"];
			$f_to_area   	= $row["f_to_area"];
			$f_to_address	= $row["f_to_address"];
			$f_desc      	= $row["f_desc"];
			$f_post_date 	= $row["f_post_date"];
			$f_need_date 	= $row["f_need_date"];
			echo "<f_demand_id>$f_demand_id	</f_demand_id>";
			echo "<f_object>$f_object</f_object>";
			echo "<f_from_area>$f_from_area</f_from_area>";
			echo "<f_from_address>$f_from_address</f_from_address>";
			echo "<f_to_area>$f_to_area</f_to_area>";
			echo "<f_to_address>$f_to_address</f_to_address>";
			echo "<f_desc>$f_desc</f_desc>";
			echo "<f_post_date>$f_post_date</f_post_date>";
			echo "<f_need_date>$f_need_date</f_need_date>";
		}		
		echo "</demand>";
	}
	echo "</root>";
}
?>