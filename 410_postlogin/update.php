<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		$email=$_POST['email'];
		$user=$_COOKIE['userName'];
		require_once('db_setup.php');
		$sql = "USE 410db;";
		if ($conn->query($sql) === TRUE) {
   // echo "successful"
} else {
   echo "Error using  database: " . $conn->error;
}
		$sql= "update 410users set email='$email' where UserName='$user'";
		if ($conn->query($sql)){
			header("Location: http://localhost/410_postlogin/account.php"); 
		}
	?>
</body>
</html>