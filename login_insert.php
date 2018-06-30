<?php
// XML文件
//header("content-type:text/xml;charset=utf8"); 
use PHPMailer\PHPMailer\PHPMailer;  
require 'PHPMailer.php';
require 'SMTP.php';
error_reporting(0);
session_start();
//會員輸入
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
$f_user_name1="";
$pri_echo ="n".$f_identity1 ; 
$display="y";
$up_line="";
$down_line="";	
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
//$f_email2="wane@nutc.edu.tw";
//$f_user_name2="linwane";


$ret=sent_mail($f_email2,$f_user_name2,$f_code,$f_cust_id1);
if ($ret=="ok")
{
	$sql="insert into custom  (f_cust_mail,very_code,f_cust_id,f_passwd,f_cust_name,f_id,f_birthday,f_celephone,f_cust_tel,f_cust_address,f_line_id,f_introduction,f_c_date) values(";
	$sql.="'$f_email2',";
	$sql.="'$f_code',";
	$sql.="'$f_cust_id1',";
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
		
}
function sent_mail($f_email,$f_user_name,$f_code,$f_cust_id)
{
	
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
	
	$cust_email=$f_email;// 收件者信箱
	$name=$f_user_name;// 收件者的名稱or暱稱	
	$mail->From = $webmaster_email;
	$mail->AddAddress($cust_email,$name);
	//$mail->AddReplyTo($webmaster_email,"Squall.f");//這不用改
	
	$mail->WordWrap = 50;//每50行斷一次行
	
	//$mail->AddAttachment("/XXX.rar");
	// 附加檔案可以用這種語法(記得把上一行的//去掉)
	
	$mail->IsHTML(true); // send as HTML
	$mail->Subject = "林老師的自動發信！！！";// 信件標題
	$message = "好利購的會員認證 <a href='http://holygo.com.tw/hlg_member.php?f_cust_id=$f_cust_id&very_code=$f_code'> 請回覆</a>";
	$mail->Body = $message;
	//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
	$mail->AltBody = "林老師的自動發信 請回覆  ' http://holygo.com.tw/hlg_member.php?f_cust_id=$f_cust_id&very_code=$f_code '" ; 
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