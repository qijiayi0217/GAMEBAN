<!doctype html> 
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>GameBan: Account Info</title>
		<link rel="stylesheet" href="css/styles.css">
		<script language="javascript" type="text/javascript">
			function qjy(){
			
			var allcookie=document.cookie;
			
			var check =allcookie.indexOf('userName');
			
			if (check==-1){
				window.location.href="http://localhost";
			}
	    }
	    qjy();
	    function open1234(name,name2,path){
 var name = escape(name);  
 var name2= escape(name2);
    var expires = new Date(0);  
    path = path == "" ? "" : ";path=" + path;  
    document.cookie = name + "="+ ";expires=" + expires.toUTCString() + path;
    document.cookie = name2 + "="+ ";expires=" + expires.toUTCString() + path;
    document.cookie = "gameName" + "="+ ";expires=" + expires.toUTCString() + path;    
    window.location.href="http://localhost";
}	
		function edit(){
			var change=document.getElementById("input");
			var button=document.getElementById("button");
			change.innerHTML="<form action='update.php' method='post'><input type='text' name='email'><input type='submit' value='Edit E-mail'></form>";
			button.innerHTML="";
		}

		</script>
	</head>
    <body>
    	<form><input class="logout" value="log out!" type=button onclick="open1234('userName','userPass','/')"></form><br>
    	<div class="container">
	    	<header class="banner">
				<h1><a href="index.php">GameBan</a></h1>
			</header>
			<nav class="menu">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="upload.html">Post a New Game</a></li>
					<li><a class="current" href="account.php">My Account</a></li>
				</ul>
			</nav>
<?php
require_once('db_setup.php');
$sql = "USE 410db;";
if ($conn->query($sql) === TRUE) {
   // echo "successful"
} else {
   echo "Error using  database: " . $conn->error;
}

// Query:
$userName =$_COOKIE["userName"] ;
$sql = "SELECT * FROM 410users  where UserName = '$userName';";


$result = $conn->query($sql);

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
?>

			<div class="accInfo">
				<center>
					<div>
					<form action="delete.php" method="post">
						<input type="submit" value="Delete Your Account">
					</form><br>
				</div>
					<table cellPadding=0 cellspacing=0 style="width:300px;height: 200px">
						<tr>
							<td style="width:100px;height: 50px"><center> Username:</center> </td>
							<td><center>  <?php echo $row['UserName']?> </center></td>
						</tr>
						<tr>
							<td> <center>Age:</center> </td>
							<td> <center> <?php echo $row[age]?></center></td>
						</tr>
						<tr>
							<td><center>Gender:</center></td>
							<td> <center> <?php echo $row['gender']?></center></td>
						</tr>
						<tr>
							<td><center>Email:</center> </td>
							<td><center><?php echo $row['email']?></center></td>
						</tr>
					</table><br>	
				  <a id="input"><div id="button"><button value="Edit" name="Edit" id="Edit" onclick="edit()">Edit E-mail</button></div></a>
				<br></br>
			</center>
			</div>
	        	        
		</div> <!--.container-->
<?php
}
}
else {
echo "Item not found";
}


$conn->close();
?>

    </body>
</html>
