<?php
// XML文件
   use PHPMailer\PHPMailer\PHPMailer;  
   header("Content-Type: text/xml;charset=utf8");
 //   require 'PHPMailer.php';
//   require 'SMTP.php';
   
   //部門維護   
   error_reporting(0);
   session_start();
   require_once('mysql_connect.php'); // Connect to the database.  
   $input_date = date("Y-m-d H:i:s",mktime());
    $ip=$_SERVER['REMOTE_ADDR'];	
		$f_identity1	=(int) $_POST["f_identity1"];
		$f_user_id1     =$_POST["f_user_id1"];                  
		$f_passwd1		=$_POST["f_passwd1"];		   
		$f_passwd2      =$_POST["f_passwd2"];  
		$f_user_name2   =$_POST["f_user_name2"];  	
		$f_birthday2    =$_POST["f_birthday2"];  
		$f_celephone2   =$_POST["f_celephone2"];
		$f_cust_tel2    =$_POST["f_tel2"];
		$f_address2     =$_POST["f_address2"];  
		$f_line_id2     =$_POST["f_line_id2"];  
		$f_sug_user_id2 =$_POST["f_sug_user_id2"];
		$f_email2       =$_POST["f_email2"]; 		
		$sel_type       =$_POST["sel_type"];
		$out=$_POST["out"];
		$sno=$_POST["sno"];
   $f_user_name1="";
 //  $out=iconv("utf-8", "big5",$_POST["out"]);
 //  $out='登入';
	$pri_echo ="n".$f_identity1 ; 
    $display="y";
	$up_line="";
	$down_line="";
	switch($out)
    {
		case 'member_check' :
			$f_sug_user_id2=trim($f_sug_user_id2);							
			$sql="select * from custom where  f_cust_id  = '$f_sug_user_id2'";  //判斷介紹人是否存在					
			$result =mysql_query($sql);
			$sn_index= mysql_num_rows($result);
			
			if ($sn_index == 0) 
			{					
				$pri_echo = "介紹人帳號不存在" ; 
				$f_cust_name="";
			}
			else
			{
				$pri_echo="ok";
				$row=mysql_fetch_array($result);				
				$f_cust_name=$row["f_cust_name"];				
			}
			$display="n";			
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";
			echo "<f_cust_id>$f_sug_user_id2</f_cust_id>";
			echo "<f_cust_name>$f_cust_name</f_cust_name>";			
			echo "</factory>";			
			break;
		case '完成修改會員資料' :
		    $pri_echo="qq";
			$input_date = date("Y-m-d",mktime());
			$year=date("y");
			$month=date("m");
			$defaut_date=$year.$month;
			$update_flg="f";			
			$len=strlen($f_email2);
			if ($len>0)
			{
				$sql="select * from custom where  f_cust_mail = '$f_email2' and f_passwd = '$f_passwd2' and sno != " . $sno;   //判斷是否重複     
				$result1 =mysql_query($sql);
				$sn_index= mysql_num_rows($result1);
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
				$result1 =mysql_query($sql);
				$sn_index= mysql_num_rows($result1);
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
				$result1 =mysql_query($sql);
				$sn_index= mysql_num_rows($result1);
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
				$sql.="f_cust_mail='$f_email2',";					
				$sql.="f_passwd='$f_passwd2',";       
				$sql.="f_cust_name='$f_user_name2',";    
				$sql.="f_id='$f_id2',";           
				$sql.="f_birthday='$f_birthday2',";     
				$sql.="f_celephone='$f_celephone2',";
				$sql.="f_cust_tel='$f_cust_tel2',";					
				$sql.="f_cust_address='$f_address2',";      
				$sql.="f_line_id='$f_line_id2',";      
				$sql.="f_introduction='$f_sug_user_id2',";						
				$sql.="f_c_date='$input_date'";
				$sql.=" where sno=$sno";
				mysql_query($sql);
				$pri_echo ="會員更改完成" . $sql;						 
			}	
			$sql="select * from custom where sno=$sno";  //判斷是否重複
			$result =mysql_query($sql); 
			$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數			
			$row=mysql_fetch_array($result);
			$f_cust_id1=$row["f_cust_id"]; 
			$display="n";	
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";
			echo "<f_cust_id>$f_cust_id1</f_cust_id>";
			echo "</factory>";
			break;
		case '帳號確認' :
			$ins_flg="f";
			$len=strlen($f_email2);
			$pri_echo="";
		//	if ($len>0)
		//	{
			//	$sql="select * from custom where  f_cust_mail = '$f_email2' and f_passwd = '$f_passwd2'";   //判斷是否重複     
				$sql="select * from custom where  f_cust_mail = '$f_email2'";   //判斷是否重複     
			
			    $result1 =mysql_query($sql);
				$sn_index= mysql_num_rows($result1);
				if ($sn_index ==0  && $len>0) 
				{
					$ins_flg="t";					
				} 
				else
				{
					$ins_flg="f1";
					$pri_echo = "此會員(EMAIL 已存在 或 Email 未填)";
				}
		//	}
			$len=strlen($f_celephone2);
			if ($len>0)
			{
				$sql="select * from custom where  f_celephone= '$f_celephone2' and f_passwd = '$f_passwd2'";   //判斷是否重複     
				$result1 =mysql_query($sql);
				$sn_index= mysql_num_rows($result1);
				if ($sn_index>0) 				
				{
					$ins_flg="f2";
					$pri_echo .= "此會員(手機號碼+密碼)已存在";
				}
			}
			$len=strlen($f_line_id2);
			if ($len>0)
			{
				$sql="select * from custom where  f_line_id= '$f_line_id2' and f_passwd = '$f_passwd2'";   //判斷是否重複     
				$result1 =mysql_query($sql);
				$sn_index= mysql_num_rows($result1);
				if ($sn_index >0) 
				{
					$ins_flg="f3";
					$pri_echo .= "此會員(line+密碼)已存在";
				}
			}			
			if ($ins_flg=="t")
			{
				$pri_echo="pass";
			}
			$display="n";
			echo '<?xml version="1.0" encoding="utf8"?> ';
			echo "<factory>";
			echo "<pri_echo>$pri_echo</pri_echo>";				
			echo "</factory>";				
			break;
        case '送出' :
		    $input_date = date("Y-m-d",mktime());
			$year=date("y");
			$month=date("m");
			$defaut_date=$year.$month;					
			$sql="select * from custom where f_cust_id like '$defaut_date%' order by f_cust_id DESC";  //判斷是否有使用者帳號    
			$result =mysql_query($sql); 
			$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數			
			if ($sn_index>0) 
			{
				$row=mysql_fetch_array($result);				
				$f_cust_id=$row["f_cust_id"];
				$f_cust_id_int=(int) $f_cust_id;					
				$f_cust_id=$f_cust_id_int+1;
			}
			else
			{					
				$f_cust_id=$year . $month . "0001";					
			}			
			$f_cust_id1=strtolower($f_cust_id);
			srand(time(NULL));
			$f_code="";
			for ($i=0;$i<8;$i++)
			{
				$b=rand(0,9);
				$f_code.=$b;
			}
			$f_code.="hlg";
			$ret=sent_mail($f_cust_id1,$f_code);
			if ($ret=="ok")
			{
				$sql="insert into custom  (f_cust_mail,very_code,f_cust_id,f_passwd,f_cust_name,f_id,f_birthday,f_celephone,f_cust_tel,f_cust_address,f_line_id,f_introduction,f_c_date) values(";
				$sql.="'$f_email2',";
				$sql.="'" . $f_code . "',";
				$sql.="'" . $f_cust_id1 . "',";
				$sql.="'$f_passwd2',";       
				$sql.="'$f_user_name2',";    
				$sql.="'$f_id2',";           
				$sql.="'$f_birthday2',";     
				$sql.="'$f_celephone2',";
				$sql.="'$f_cust_tel2',";					
				$sql.="'$f_address2',";      
				$sql.="'$f_line_id2',";      
				$sql.="'$f_sug_user_id2',";						
				$sql.="'$input_date')";
				mysql_query($sql);
				$pri_echo ="會員註冊完成";
			}
			else
			{
				$pri_echo =$ret;
			}
			break;
        case '登入':						
			switch($sel_type)
			{
			case "0" :
				$sql ="select * from  custom where (f_cust_mail ='$f_user_id1') "; 				     
				break;
			case "1" :
				$sql="select * from custom where  (f_line_id = '$f_user_id1') ";  //判斷是否重複
				break;
			case "2" :
				$sql="select * from custom where  (f_celephone = '$f_user_id1') ";  //判斷是否重複
				break;	
			}
			$sql.=" and (f_passwd  = '$f_passwd1')";
			$result =mysql_query($sql); 
			$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數 		
			if ($sn_index >0) 	 
			{ //判斷是否重複
				$row=mysql_fetch_array($result);
				$f_cust_id1=$row["f_cust_id"];   //會員編號
				$f_cust_name1=$row["f_cust_name"];					 
				$f_introduction=trim($row["f_introduction"]);
				$strlen=strlen($f_introduction);
				$_SESSION["passok"]="y";
				$_SESSION["f_cust_id"]=$f_cust_id1;
				$_SESSION["f_cust_name"]=$f_cust_name1;
				$pri_echo ="y";
				$level1=0;
				$up_line="上線:";
//找上線
				while ($strlen>0 && $level1<4)
				{	
					$up_line.=$f_introduction . "->";
					$sql ="select * from  custom where f_cust_id = '$f_introduction'"; 
					$result =mysql_query($sql); 
					$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數 		
					$strlen=0;
					if ($sn_index >0)
					{
						$level1+=1;
						$row=mysql_fetch_array($result);
						$f_introduction=trim($row["f_introduction"]);
						$strlen=strlen($f_introduction);
					}
				}
//找第一層下線
				$down_line="第一層下線:";	
				$sql ="select * from  custom where f_introduction = '$f_cust_id1'"; 
				$result =mysql_query($sql); 
				$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數 		
				for ($i=0;$i<$sn_index;$i++)
				{ 	
					$row=mysql_fetch_array($result);
					$f_introduction=trim($row["f_cust_id"]);
					$down_line.=$f_introduction . ";";					
				}	
				$_SESSION["up_line"]=$up_line;
				$_SESSION["down_line"]=$down_line;
				$pri_echo="y";
				
			} 
			else
			{
				$_SESSION["passok"]="n";
				
				$sql ="select * from  custom where f_passwd  = '$f_passwd1'";
				$result =mysql_query($sql); 				
				$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數 		
				if ($sn_index >0) 	 
				{ //判斷是否重複  密碼是對的	    
			
					switch($sel_type)
					{
					case "0" :
						$pri_echo ="mail 是錯的";			     
						break;
					case "1" :
						$pri_echo ="LINE ID 是錯的";
						break;
					case "2" :
						$pri_echo ="手機號碼 是錯的";
						break;	
					}
				}
				else
				{     //密碼是錯的
					$pri_echo ="密碼是錯的"; 
					switch($sel_type)
					{
					case "0" :
						$sql ="select * from  custom where (f_cust_mail ='$f_user_id1') "; 				     
						break;
					case "1" :
						$sql="select * from custom where  (f_line_id = '$f_user_id1') ";  //判斷是否重複
						break;
					case "2" :
						$sql="select * from custom where  (f_celephone = '$f_user_id1') ";  //判斷是否重複
						break;	
					}					
					$result =mysql_query($sql); 
					$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數 		
					if ($sn_index ==0) 	 
					{ 
						switch($sel_type)
						{
						case "0" :
							$pri_echo ="mail 與 密碼是錯的";			     
							break;
						case "1" :
							$pri_echo ="LINE ID 與 密碼是錯的";
							break;
						case "2" :
							$pri_echo ="手機號碼 與 密碼是錯的";
							break;	
						}
					}
					
				}	  
			}  
            break;
		case '修改會員登入':			
			$display="n";
			switch($sel_type)
			{
			case "0" :
				$sql ="select * from  custom where (f_cust_mail ='$f_user_id1') "; 				     
				break;
			case "1" :
				$sql="select * from custom where  (f_line_id = '$f_user_id1') ";  //判斷是否重複
				break;
			case "2" :
				$sql="select * from custom where  (f_celephone = '$f_user_id1') ";  //判斷是否重複
				break;	
			}
			$sql.=" and (f_passwd  = '$f_passwd1')";
			$result =mysql_query($sql); 
			$sn_index = mysql_num_rows($result);   //查詢結果的記錄筆數 
			echo '<?xml version="1.0" encoding="utf8"?> ';
			if ($sn_index >0) 	 
			{ //判斷是否重複
				$row=mysql_fetch_array($result);
				$f_introduction=trim($row["f_introduction"]);
				$f_cust_id=$row["f_cust_id"];   //會員編號
				$f_cust_name=$row["f_cust_name"];					 
				$f_cust_mail=$row["f_cust_mail"];   //
				$f_passwd=$row["f_passwd"];   //
				$f_birthday=$row["f_birthday"];   //
				$f_celephone=$row["f_celephone"];   //
				$f_cust_tel=$row["f_cust_tel"];   //
				$f_cust_address=$row["f_cust_address"];   //
				$f_line_id=$row["f_line_id"];   //
				$sno=$row["sno"];   //
				$_SESSION["passok"]="y";
				$_SESSION["f_cust_id"]=$f_cust_id;
				$_SESSION["f_cust_name"]=$f_cust_name;
				$pri_echo ="y";
				echo "<factory>";
				echo "<pri_echo>$sql</pri_echo>";
				echo "<f_introduction>$f_introduction</f_introduction>";
				echo "<f_cust_id>$f_cust_id</f_cust_id>";
				echo "<f_cust_name>$f_cust_name</f_cust_name>";
				echo "<f_cust_mail>$f_cust_mail</f_cust_mail>";
				echo "<f_passwd>$f_passwd</f_passwd>";
				echo "<f_birthday>$f_birthday</f_birthday>";
				echo "<f_cust_tel>$f_cust_tel</f_cust_tel>";
				echo "<f_celephone>$f_celephone</f_celephone>";
				echo "<f_cust_address>$f_cust_address</f_cust_address>";
				echo "<f_line_id>$f_line_id</f_line_id>";									
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
		echo "<f_cust_id>$f_cust_id1</f_cust_id>";
		echo "<f_user_name>$f_user_name1</f_user_name>";
		echo "<f_cust_name>$f_cust_name1</f_cust_name>";		
		echo "</factory>";
	}
function sent_mail($f_code,$f_cust_id)
{
	$f_code="hlg";	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // turn on SMTP authentication
	//很重要
	$mail->Host='webmail.nutc.edu.tw';
	$mail->Port=25;
	
	//這幾行是必須的
	//這邊是你的gmail帳號和密碼
	$mail->CharSet = "utf-8";  
	$mail->Username = "wane";
	$mail->Password = "lin481028";
	$mail->FromName = "林老師";             // 寄件者名稱(你自己要顯示的名稱)
	$webmaster_email = "wane@nutc.edu.tw"; //回覆信件至此信箱
	
	$cust_email="wane@nutc.edu.tw";// 收件者信箱
	$name="wane";// 收件者的名稱or暱稱
	
	
	
	$mail->From = $webmaster_email;
	$mail->AddAddress($cust_email,$name);
	//$mail->AddReplyTo($webmaster_email,"Squall.f");//這不用改
	
	$mail->WordWrap = 50;//每50行斷一次行
	
	//$mail->AddAttachment("/XXX.rar");
	// 附加檔案可以用這種語法(記得把上一行的//去掉)
	
	$mail->IsHTML(true); // send as HTML
	$mail->Subject = "林老師的自動發信！！！";// 信件標題
	$message = "好利購的會員認證 <a href='http://holygo.com.tw/hlg_member.php?f_cust_id=$f_cust_id&very_code=$f_code> 請回覆</a>";
	$mail->Body = $message;
	//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
	$mail->AltBody = "林老師的自動發信 請回覆 http://holygo.com.tw/hlg_member.php?f_cust_id=$f_cust_id&very_code=$f_code" ; 
	//信件內容(純文字版)
	
	if(!$mail->Send())
	{
		return "寄信發生錯誤 !! "; 
	//如果有錯誤會印出原 . $mail->ErrorInfo;
	}
	else
	{ 
		return "ok";
	}
}
?>