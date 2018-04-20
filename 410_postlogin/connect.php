<?php
$host="127.0.0.1";
$db_user="root";
$db_pass="qjy19950217";
$db_name="410db";
$timezone="America/New_York";

$link=mysql_connect($host,$db_user,$db_pass);
mysql_select_db($db_name,$link);
mysql_query("SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); 
?>
