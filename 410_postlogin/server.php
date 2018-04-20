<?php
include_once("connect.php");
//$gameName= $_POST['gameName']

$q=mysql_query("select * from comment");
while($row=mysql_fetch_array($q)){
		//$comments[] = array("user"=>$row[UserName],"comment"=>$row[content],"addtime"=>$row[create_date]);
}
echo json_encode($comments);
?>
