<!DOCTYPE html><!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">         
	<title>GameBan: Home</title>
        <!-- <link rel="stylesheet" href="sss/sss.css"> -->
        <link rel="stylesheet" href="css/styles.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
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

		</script>
</head>
<body>
	<form><input class="logout" value="log out!" type=button onclick="open1234('userName','userPass','/')"></form><br>
<!--Query-->
<?php
require_once('db_setup.php');
$sql = "USE 410db;";
if ($conn->query($sql) === FALSE) {echo "Error using  database: " . $conn->error;}
//QUERY
$sql = "SELECT g.gameName,g.category,g.description,count(l.gameName) as likes FROM games g left join LikeGame l on l.gameName=g.gameName group by gameName order by likes desc;";
$result = $conn->query($sql);
if($result->num_rows > 0){
?>

<div class="container">
	<header class="banner">
		<h1><a href="index.php">GameBan</a></h1>
        </header>
       
	 <nav class="menu">
                <ul>
                <li><a class="current" href="index.php">Home</a></li>
		<li><a href="upload.html">Post a New Game</a></li>
                <li><a href="account.php">My Account</a></li>
                </ul>
         </nav>
         <br></br>
<!--Search Form-->
<div>
	<form action="find_game.php" method="post">
	Search a game: <select style="width:132px" name="id">
		<?php
			while($row=$result->fetch_assoc()){
		?>
			<option value="<?php echo $row['gameName'] ?>"><?php echo $row['gameName'] ?></option>
		<?php }

		?>
	<input type="submit" value="Submit">
</div>

         <div class="sp-container">
<!--Display all games-->
<?php
$sql = "SELECT g.gameName,g.category,g.description,count(l.gameName) as likes FROM games g left join LikeGame l on l.gameName=g.gameName group by gameName order by likes desc;";
$result1 = $conn->query($sql);
while($row = $result1->fetch_assoc()){
?>

	<div class="game">
	<h2 style="color: #FF4500"><?php echo $row['gameName']?></h2>
	<figure><img style="width:300px;height:168px" src="images/<?php echo $row['gameName']?>.jpg"></figure>
	<p><strong>Category:  </strong><?php echo $row['category']?></p>
	<p style="text-align:left;width:900px;color:#FF0000"><strong>Disikes: <?php echo $row['likes']?></strong></p>
	<p style="text-align:left;width:900px"><?php echo $row['description']?></p>

	</div>
<?php
}
}
else {
echo "Nothing to display";
}
?>

	</div>
	<br><br>
</div>

<?php
$conn->close();
?>  

</body>
</html>
