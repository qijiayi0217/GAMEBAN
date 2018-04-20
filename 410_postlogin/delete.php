<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		require_once('db_setup.php');
		$UserName=$_COOKIE['userName'];
		$sql="USE 410db";
		if ($conn->query($sql)===FALSE){
	echo "Error using database:".$conn->error;
}
	$sql="delete from 410users where UserName='$UserName'";
	$conn->query($sql);
	setcookie("userName","",time()-3600,'/');
	setcookie("userPass","",time()-3600,'/');
	setcookie("gameName","",time()-3600,'/');
	$conn->close();
	header("Location: http://localhost"); 
	?>
</body>
</html>