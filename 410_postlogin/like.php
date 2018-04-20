<?php
include_once("connect.php");

$user=$_COOKIE["userName"];

$game=$_COOKIE["gameName"];

$query=mysql_query("insert into LikeGame values('$user','$game')");

$now=array("user"=>$user,"gameName"=>$game);

if($query) {
	header("Content-type: application/json");
	echo json_encode($now);
}
else
{
	header('HTTP/1.1 500 Internal Server Error');
	header("Content-type: application/json");
	die(json_encode($now));
}
?>