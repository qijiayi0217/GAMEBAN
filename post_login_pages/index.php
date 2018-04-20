<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">         
	<title>GameBan: Home</title>
        <link rel="stylesheet" href="sss/sss.css">
        <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<!--Query-->
<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('../information_v2.db');
      }
   }
$db = new MyDB();
$sql = "SELECT * FROM games;"
$result = $conn->query($sql);
if($result->num_rows > 0){
?>

<div class="container">
	<header class="banner">
		<h1><a href="index.html">GameBan</a></h1>
        </header>
       
	 <nav class="menu">
                <ul>
                <li><a class="current" href="index.html">Home</a></li>
                <li><a href="account.html">My Account</a></li>
                </ul>
         </nav>
         <br></br>
<!--Search Form-->
<div>
	<form action="find_game.php" method="post">
	Search a game you know: <input type="text" name="id"><br>
	<input type="submit">
</div>

         <div class="sp-container">
<!--Display all games-->
<?php
while($row = $result->fetch_assoc()){
?>

	<div class="game">
	<h2><?php echo $row['name']?></h2>
	<figure><img src="images/temp.jpg"></figure>
	<p>Overall Score: <?php echo $row['score']?></p>
	<p><?php echo $row['description']?></p>
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
