<?php
// XML文件
   header("Content-Type: text/xml;charset=utf8");
   //部門維護
   error_reporting(0); 
   session_start();
   require_once('mysql_connect.php'); // Connect to the database. 
   class SocketHttpRequest
	{
		var $sHostAdd;
		var $sUri;
		var $iPort;  
		var $sRequestHeader; 
		var $sResponse;
	   
		function HttpRequest($sUrl)
		{
			$sPatternUrlPart = '/http:\/\/([a-z-\.0-9]+)(:(\d+)){0,1}(.*)/i';
			$arMatchUrlPart = array();
			preg_match($sPatternUrlPart, $sUrl, $arMatchUrlPart);
		   
			$this->sHostAdd = gethostbyname($arMatchUrlPart[1]);
			if (empty($arMatchUrlPart[4]))
			{
				$this->sUri = '/';
			}
			else
			{
				$this->sUri = $arMatchUrlPart[4];
			}
			if (empty($arMatchUrlPart[3]))
			{
				$this->iPort = 9600;
			}
			else
			{
				$this->iPort = $arMatchUrlPart[3];
			}
		   
			$this->addRequestHeader('Host: '.$arMatchUrlPart[1]);
			$this->addRequestHeader('Connection: Close');

		}
	   
		function addRequestHeader($sHeader)
		{
			$this->sRequestHeader .= trim($sHeader)."\r\n";
		}
	   
		function sendRequest($sMethod = 'GET', $sPostData = '')
		{
			$sRequest = $sMethod." ".$this->sUri." HTTP/1.1\r\n";
			$sRequest .= $this->sRequestHeader;
			if ($sMethod == 'POST')
			{
				$sRequest .= "Content-Type: application/x-www-form-urlencoded\r\n";
				$sRequest .= "Content-Length: ".strlen($sPostData)."\r\n";
				$sRequest .= "\r\n";
				$sRequest .= $sPostData."\r\n";
			}
			$sRequest .= "\r\n";
		   
			$sockHttp = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			if (!$sockHttp)
			{
				die('socket_create() failed!');
			}
		   
			$resSockHttp = socket_connect($sockHttp, $this->sHostAdd, $this->iPort);
			if (!$resSockHttp)
			{
				die('socket_connect() failed!');
			}
		   
			socket_write($sockHttp, $sRequest, strlen($sRequest));
		   
			$this->sResponse = '';
			while ($sRead = socket_read($sockHttp, 4096))
			{
				$this->sResponse .= $sRead;
			}
		   
			socket_close($sockHttp);
		}
	   
		function getResponse()
		{
			return $this->sResponse;
		}
	   
		function getResponseBody()
		{
			$sPatternSeperate = '/\r\n\r\n/';
			$arMatchResponsePart = preg_split($sPatternSeperate, $this->sResponse, 2);
			return $arMatchResponsePart[1];
		}
	}
	//  http://tw2.php.net/sockets

   
   
  //接收前台傳來的資料	
	$f_driver_id      =trim($_POST["f_driver_id"]);                  
	$f_driver_name    =trim($_POST["f_driver_name"]);  	
	$f_driver_tel     =trim($_POST["f_driver_tel"]);
	$f_driver_address =trim($_POST["f_driver_address"]);  
	$f_celephone1      =trim($_POST["f_celephone1"]);  
	$f_celephone2      =trim($_POST["f_celephone2"]);  
	$f_driver_email1   =trim($_POST["f_driver_email1"]);
	$f_driver_email2   =trim($_POST["f_driver_email2"]);
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
	$search_key             =$_POST["search_key"];
	$f_passwd1				=$_POST["f_passwd1"];
	$f_passwd2				=$_POST["f_passwd2"];
	$sno           			=$_POST["sno"];
	$out           			=$_POST["out"];  
 //  $out=iconv("utf-8", "big5",$_POST["out"]);
 //  $out='登入';
	$pri_echo ="n".$f_identity1 ; 
    $display="y";
	$up_line="";
	$down_line="";
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
		if ($type=='image/JPEG' || $type=='image/jpeg' || $type=='image/PNG' || $type=='image/png' )
		{
			$filename1=$file_name . ".jpg" ;
		}
		else
		{
			$filename1=$file["name"];	
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
		case '修改司機資料' :		
			$update_flg="t";			
			if ($update_flg =="t") 
			{				
				$input = array(':f_driver_email'  		=> $f_driver_email2, 
							   ':f_passwd'      		=> $f_passwd2,
							   ':f_celephone'    		=> $f_celephone2,  
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
						//   
						//    f_equitment             =
							
							
				$sth = $db->prepare($sql);
				$sth->execute($input);
				
				$pri_echo = " 司機更改完成" . $f_equitment[1] . "   " . count($f_equitment) ;				
			}		
			$display="n";
			header("Content-Type: text/xml;charset=utf8");
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";
			echo "<f_driver_id>$f_driver_id</f_driver_id>";
			echo "</factory>";
			break;			
		case '完成修改會員資料' :
		    $pri_echo="qq";
			$input_date = date("Y-m-d",mktime());
			$year=date("y");
			$month=date("m");
			$defaut_date=$year.$month;
			$update_flg="f";			
			$len=strlen($f_driver_email2);
			if ($len>0)
			{
				$sql="select * from custom where  f_driver_email = '$f_driver_email2' and f_passwd = '$f_passwd2' and sno != " . $sno;   //判斷是否重複     
				$result = $db->query($sql);		
				$sn_index= $result->rowCount(); //查詢結果的記錄筆數 		
			
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
			$len=strlen($f_line_id2);
			if ($len>0)
			{
				$sql="select * from custom where  f_line_id= '$f_line_id2' and f_passwd = '$f_passwd2'and sno !=" .$sno;   //判斷是否重複     
				$result = $db->query($sql);		
				$sn_index= $result->rowCount(); //查詢結果的記錄筆數 		
			
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
				$result = $db->query($sql);		
				$sn_index= $result->rowCount(); //查詢結果的記錄筆數		
			
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
				$sql.="f_driver_email='$f_driver_email2',";					
				$sql.="f_passwd='$f_passwd2',";       
				$sql.="f_driver_name='$f_driver_name2',";    
				$sql.="f_id='$f_id2',";           
				$sql.="f_birthday='$f_birthday2',";     
				$sql.="f_celephone='$f_celephone2',";
				$sql.="f_driver_tel='$f_driver_tel2',";					
				$sql.="f_driver_address='$f_address2',";      
				$sql.="f_line_id='$f_line_id2',";      
				$sql.="f_introduction='$f_sug_driver_id2',";						
				$sql.="f_c_date='$input_date'";
				$sql.=" where sno=$sno";
				mysql_query($sql);
				$pri_echo ="會員更改完成" . $sql;						 
			}	
			$sql="select * from custom where sno=$sno";  //判斷是否重複
			$result =mysql_query($sql); 
			$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數			
			$row=mysql_fetch_array($result);
			$f_driver_id1=$row["f_driver_id"]; 
			$display="n";	
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";
			echo "<f_driver_id>$f_driver_id1</f_driver_id>";
			echo "</factory>";
			break;
		case '帳號確認' :
			$ins_flg="f";
			/*
			$len=strlen($f_driver_email2);
			$pri_echo="";
				$sql="select * from custom where  f_driver_email = '$f_driver_email2'";   //判斷是否重複     
			
			    $result = $db->query($sql);		
				$sn_index= $result->rowCount(); //查詢結果的記錄筆數 		
			
				if ($sn_index ==0  && $len>0) 
				{
					$ins_flg="t";					
				} 
				else
				{
					$ins_flg="f1";
					$pri_echo = "此會員(EMAIL 已存在 或 Email 未填)";
				}
		    */
			$len=strlen($f_celephone2);
			if ($len>0)
			{
				//$sql="select * from custom where  f_celephone= '$f_celephone2' and f_passwd = '$f_passwd2'";   //判斷是否重複     
				$sql="select * from custom where  f_celephone= '$f_celephone2' ";   //判斷是否重複     
				
				$result = $db->query($sql);		
				$sn_index= $result->rowCount(); //查詢結果的記錄筆數 		
			
				if ($sn_index>0) 				
				{
					$ins_flg="f2";
					//$pri_echo .= "此會員手機號碼+密碼)已存在";
					$pri_echo = "此會員手機號碼已存在";
				}
				else
				{
					$ins_flg="t";
				}
			}
			/*
			$len=strlen($f_line_id2);
			if ($len>0)
			{
				$sql="select * from custom where  f_line_id= '$f_line_id2' and f_passwd = '$f_passwd2'";   //判斷是否重複     
				$result = $db->query($sql);		
				$sn_index= $result->rowCount(); //查詢結果的記錄筆數
				if ($sn_index >0) 
				{
					$ins_flg="f3";
					$pri_echo .= "此會員(line+密碼)已存在";
				}
			}
            */			
			$very_code="";
			if ($ins_flg=="t")
			{
				$pri_echo="pass";
				srand(time(NULL));			
				for ($i=0;$i<4;$i++)
				{
					$b=rand(0,9);
					$very_code.=$b;
				}
				//sent_msg($very_code);
				$SendGet = new SocketHttpRequest(); 
   
	
	 // 建立物件
//	$SendGet->HttpRequest('http://smexpress.mitake.com.tw:9600/SmSendGet.asp?username=16676444B&password=lin481028&dstaddr='. $f_celephone2 .'&DestName=林文祥&dlvtime=18:30&vldtime=18:39&smbody= CODE:'.$very_code);         // 呼叫成員方法
//	$SendGet->sendRequest(); //發送
	//$a=$SendGet->getResponseBody(); //取回傳值
 
				//$very_code="481028"; //產生認證編碼 及傳簡訊
				
				// send_sm($very_code);
			}
			$display="n";			
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";	
			echo "<very_code>$very_code</very_code>";				
			echo "</factory>";				
			break;         
		case '新增司機送出' :
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
			$f_driver_id=strtolower($f_driver_id);			
			
			$input = array(':f_driver_email'=>$f_driver_email2,':f_driver_id' =>$f_driver_id,':f_passwd' =>$f_passwd2, 
			               ':f_driver_name'=>$f_driver_name,':f_birthday'=>$f_birthday,':f_celephone'=>$f_celephone2,
						   ':f_driver_tel'=>$f_driver_tel,':f_driver_address'=>$f_driver_address,':f_c_date'=>$f_c_date,
						   ':f_contact_number'=>$f_contact_number,':f_registration_number'=>$f_registration_number,	
						   ':f_weight'=>$f_weight,':f_length'=>$f_length,':f_width'=>$f_width,':f_height'=>$f_height,':f_property'=>$f_property);
			$sql = "INSERT INTO `custom` (f_driver_email,f_driver_id,f_passwd,f_driver_name,f_birthday,f_celephone,f_driver_tel,f_driver_address,f_c_date 
										,f_contact_number,f_registration_number,f_weight,f_length,f_width,f_height,f_property)
								  VALUES(:f_driver_email,:f_driver_id,:f_passwd,:f_driver_name,:f_birthday,:f_celephone,:f_driver_tel,:f_driver_address, 
										:f_c_date,:f_contact_number,:f_registration_number,:f_weight,:f_length,:f_width,:f_height,:f_property)";			
			
			$sth = $db->prepare($sql);			
			$sth->execute($input);
			
//處理相關設備

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
		    pic_upload($f_driver_id);
			$pri_echo =$f_driver_id."司機新增完成"   ;
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";	
			echo "<action>y</action>";	
			echo "<f_driver_id>$f_driver_id</f_driver_id>";					
			echo "</factory>";
			break;
        case '登入':						
			switch($sel_type)
			{
			case "0" :
				$sql="select * from custom where  (f_celephone = '$f_celephone1') ";  //判斷是否重複
				break;
			case "1" :
				$sql ="select * from  custom where (f_driver_email ='$f_celephone1') "; 				     
				break;
			case "2" :
				$sql="select * from custom where  (f_line_id = '$f_celephone1') ";  //判斷是否重複
				break;
			}
			$sql.=" and (f_passwd  = '$f_passwd1')";	
			$result = $db->query($sql);		
			$sn_index= $result->rowCount(); //查詢結果的記錄筆數 		
			if ($sn_index >0)  //判斷是否存在	 
			{ 
		        $pri_echo ="y";
				$row = $result->fetch(PDO::FETCH_ASSOC);		
				$f_celephone1= $row["f_celephone"];
				$f_driver_email1= $row["f_driver_email"];
				$f_driver_id= $row["f_driver_id"];
				$f_driver_name= $row["f_driver_name"];
				$f_area= $row["f_driver_area_code"];
				$f_driver_address= $row["f_driver_address"];
				$f_driver_tel= $row["f_driver_tel"];
				
				$input = array(':f_driver_id' =>$f_driver_id);
				$sql_1  = "select * from equitment  where f_driver_id = '$f_driver_id'";
				$result_1=$db->prepare($sql_1);
				$result_1->execute();
			   // $sth = $db->prepare($sql_1);			   
				$sn_index_1 = $result_1->rowCount();			
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
				echo "<f_celephone>$f_celephone1</f_celephone>";
				echo "<f_driver_email>$f_driver_email1</f_driver_email>";
				echo "<f_driver_id>$f_driver_id</f_driver_id>";
				echo "<f_driver_name>$f_driver_name</f_driver_name>";
				echo "<f_driver_address>$f_driver_address</f_driver_address>";
				echo "<f_driver_area>$f_area</f_driver_area>";
				echo "<f_driver_tel>$f_driver_tel</f_driver_tel>";
				echo "<f_contact_number>$f_contact_number</f_contact_number>";
				echo "<f_registration_number>$f_registration_number</f_registration_number>";
				echo "<f_weight>$f_weight</f_weight>";
				echo "<f_length>$f_length</f_length>";
				echo "<f_width>$f_width</f_width>";
				echo "<f_height>$f_height</f_height>";
				echo "<f_property>$f_property</f_property>";
				echo "<f_c_date>$f_c_date</f_c_date>"; 
				echo "<pri_echo>$pri_echo</pri_echo>";
				echo "<action>y</action>";				
				echo "<sn_index_1>$sn_index_1</sn_index_1>";				
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
				echo "<sno>$sno</sno>";	
				echo "</sales>";
				$_SESSION["passok"]="y";
				$_SESSION["f_driver_id"]=$f_driver_id1;
				$_SESSION["f_driver_name"]=$f_driver_name1;
				$_SESSION["f_celephone"]=$f_celephone1;
				$level1=0;				
				$display="n";
			} 
			else
			{
				$display="y";
				$_SESSION["passok"]="n";
				$sql ="select * from  custom where f_celephone = '$f_celephone1'";
				$result = $db->query($sql);		
				$sn_index= $result->rowCount(); //查詢結果的記錄筆數 
				if ($sn_index >0) 	 
				{ //判斷是否重複 
					$pri_echo ="密碼錯誤" ;
				}
				else
				{     //密碼是錯的
					$pri_echo ="手機錯誤"; 
				}	
			}  
            break;
		case '修改會員登入':			
			$display="n";
			switch($sel_type)
			{
			case "0" :
				$sql="select * from custom where  (f_celephone = '$f_driver_id1') ";  //判斷是否重複
				break;
			case "1" :
				$sql ="select * from  custom where (f_driver_email ='$f_driver_id1') "; 				     
				break;
			case "2" :
				$sql="select * from custom where  (f_line_id = '$f_driver_id1') ";  //判斷是否重複
				break;				
			}
			$sql.=" and (f_passwd  = '$f_passwd1')";
			$result = $db->query($sql);		
			$sn_index= $result->rowCount(); //查詢結果的記錄筆數 		
			
			echo '<?xml version="1.0" encoding="utf8"?> ';
			if ($sn_index >0) 	 
			{ //判斷是否重複
				$row=mysql_fetch_array($result);
				$f_introduction=trim($row["f_introduction"]);
				$f_driver_id=$row["f_driver_id"];   //會員編號
				$f_driver_name=$row["f_driver_name"];					 
				$f_driver_email=$row["f_driver_email"];   //
				$f_passwd1=$row["f_passwd"];   //
				$f_birthday=$row["f_birthday"];   //
				$f_celephone=$row["f_celephone"];   //
				$f_driver_tel=$row["f_driver_tel"];   //
				$f_driver_address=$row["f_driver_address"];   //
				$f_line_id=$row["f_line_id"];   //
				$sno=$row["sno"];   //
				$_SESSION["passok"]="y";
				$_SESSION["f_driver_id"]=$f_driver_id;
				$_SESSION["f_driver_name"]=$f_driver_name;
				$pri_echo ="y";
				echo "<factory>";
				echo "<pri_echo>$sql</pri_echo>";
				echo "<f_driver_id>$f_driver_id</f_driver_id>";
				echo "<f_celephone>$f_celephone</f_celephone>";
				echo "<f_driver_email>$f_driver_email</f_driver_email>";
				echo "<f_line_id>$f_line_id</f_line_id>";
				echo "<f_driver_address>$f_driver_address</f_driver_address>";
				echo "<f_driver_name>$f_driver_name</f_driver_name>";
				echo "<f_passwd>$f_passwd1</f_passwd>";
				echo "<f_birthday>$f_birthday</f_birthday>";
				echo "<f_driver_tel>$f_driver_tel</f_driver_tel>";
				echo "<sno>$sno</sno>";	
				echo "</factory>";
			} 
			else
			{
				$pri_echo ="n"; 
				echo "<factory>";
				echo "<pri_echo>$pri_echo</pri_echo>";
												
				echo "</factory>";				
			}   
			
			break;					
    }
	
	if ($display=="y")	
	{
		echo '<?xml version="1.0" encoding="utf8"?> ';
		echo "<factory>";
		echo "<pri_echo>$pri_echo</pri_echo>";
		echo "<up_line>$up_line</up_line>";
		echo "<down_line>$down_line</down_line>";
		echo "<f_driver_id>$f_driver_id1</f_driver_id>";
		echo "<f_driver_name>$f_driver_name1</f_driver_name>";	
		echo "</factory>";
	}
?>