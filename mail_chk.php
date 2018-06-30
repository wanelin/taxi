<?php
error_reporting(0);
function checkemail($bail) 
{ 
	if(preg_match("^[a-za-z0-9_]+@[a-za-z0-9\-]+\.[a-za-z0-9\-\.]+$]^", $bail))
	{
		return false;
	}
	list($username, $domain) = preg_split("@",$bail);
	if(getmxrr($domain, $mxhost)) 
	{
		return true;
	}
	else 
	{
		echo $domain;
		if(fsockopen($domain, 25, $errno, $errstr, 30)) 
		{
			return true; 
		}
		else 
		{
			return false; 
		}
	}
}

if(checkemail('wane@nutc.edu.tw') == false) 
{
	echo "您輸入的e_mail是不正確的.";
} 
else 
{
	echo "輸入的e_mail是正確的.";
}
?>