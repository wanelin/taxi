<?php
session_start();
require_once "config.php";
//require_once "function.php";
$dsn = "mysql:dbname=" ._DB_NAME .";host=" . _DB_HOST.  ";port=3306";
$username = _DB_ID;
$password = _DB_PW;
try {
   // 建立MySQL伺服器連接和開啟資料庫 
   $db = new PDO($dsn, $username, $password);
   $db->exec("set names utf8");
   // 指定PDO錯誤模式和錯誤處理
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "成功建立MySQL伺服器連接和開啟資料庫" . $dsn; 
} catch (PDOException $e) {
  // echo "連接失敗: " . $dsn;
}
?>