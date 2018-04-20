<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>GameBan: Post a New Game</title>
<link rel="stylesheet" href="css/styles.css">
<script language="javascript" type="text/javascript">
function open1234(name,name2,path){
 var name = escape(name);  
 var name2= escape(name2);
    var expires = new Date(0);  
    path = path == "" ? "" : ";path=" + path;  
    document.cookie = name + "="+ ";expires=" + expires.toUTCString() + path;
    document.cookie = name2 + "="+ ";expires=" + expires.toUTCString() + path;    
    window.location.href="http://localhost";
}
</script>
</head>

<body>

<form><input class="logout" value="log out!" type=button onclick="open1234('userName','userPass','/')"></form>
<div class="container">
  <header class="banner">
        <h1><a href="index.php">GameBan</a></h1>
        </header>
        <nav class="menu">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a class="current" href="upload.html">Post a New Game</a></li>
        <li><a href="account.php">My Account</a></li>
                                </ul>
                        </nav>
<?php
require_once('db_setup.php');
$sql = "USE 410db;";
if ($conn->query($sql) === TRUE) {
   // echo "connected successfully";
} else {
   echo "Error using  database: " . $conn->error;
}

//Insert:
$gameName = $_POST['gameName'];
$category = $_POST['category'];
$description = $_POST['description'];
//valid file

$sql = "INSERT INTO games values ('$gameName', '$category', '$description');";


$result = $conn->query($sql);

if ($result === TRUE) {
   // echo "New record created successfully" . "<br />";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
<?php
//upload image
if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    //echo "Type: " . $_FILES["file"]["type"] . "<br />";
    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
    //echo $_FILES["file"]["size"];
    //if (file_exists("images/" . $_FILES["file"]["name"]))
  
    // {
    //  echo $_FILES["file"]["name"] . " already exists. ";
    //  }
    //else
    //  {
    // to save the image in the name of the game   
      $fileName=$_FILES['file']['name'];
      //echo $fileName;
      $name=explode('.',$fileName);
      $newPath=$gameName.'.'.$name[1];
      if ($name[1] == "jpg")
      {
      move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $newPath);
      echo "Successfully Post a New Game!";
      }
      else
      {
        $sql = "delete from games where gameName = '$gameName';";
        $conn->query($sql);
        echo "Invalid File." ;
      }
    //  echo "Stored in: " . "images/" . $_FILES["file"]["name"];
    //  }
  }
?>
    
<?php
$conn->close();
?>

</body>

</html>
