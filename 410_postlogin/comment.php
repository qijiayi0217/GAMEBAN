<?php
include_once("connect.php");

$user = $_COOKIE["userName"];
// $user = htmlspecialchars(trim($_POST['user']));
$txt = htmlspecialchars(trim($_POST['txt']));
$gameName = htmlspecialchars(trim($_POST['gameName']));
if(empty($user)){
   echo "Enter the username！";
   exit;
}
if(empty($txt)){
   echo "Enter the comment！";
   exit;
}
$time = date("Y-m-d H:i:s");
$query=mysql_query("insert into comment(UserName,gameName,content,create_date)values('$user','$gameName','$txt','$time')");
$now=array("user"=>$user,"comment"=>$txt);
if($query) echo json_encode($now);	
?>
