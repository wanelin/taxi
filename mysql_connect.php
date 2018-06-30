<?php
session_start();
define('_SHOP_NAME', '會員處理樣板');
define('_UPLOAD_PATH', 'C:/UniServerZ/www/mini_shop/uploads/');
define('_UPLOAD_URL', 'http://localhost/mini_shop/uploads/');
define('_DB_HOST', 'localhost');
define('_DB_ID', 'root');
define('_DB_PW', '');
define('_DB_NAME', 'taxi');
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