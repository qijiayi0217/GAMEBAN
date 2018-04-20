<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/gamePage.css">
<!--Ajax-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
        var comments = $("#comments");
        $.getJSON("server.php",function(json){
               
        });
        $("#add").click(function(){
              //  var user = $("").val();
              console.log("script loaded");
                var txt = $("#txt").val();
        	var game = $("#gameName").text();
	$.ajax({
             type: "POST",
             url: "comment.php",
             data: "txt="+txt+"&gameName="+game,
             success: function(now){
                                //var obj=JSON.parse(comments)
                                //alert(now);
                                var temp=now.split(",");
                                var temp1 = temp[0].split('"');
                                var temp2 = temp[1].split('"');
                                //alert(temp1);
                                if(now){
                                   var str = "<p><strong>"+temp1[3]+"</strong>: "+temp2[3]+"<span> Just now</span></p>";
                       comments.append(str);
                                   $("#message").show().html("Success！").fadeOut(1000);
                                   $("#txt").attr("value","");
                                }else{
                                   $("#message").show().html(now).fadeOut(1000);
                            }
             }
            });
        });
        $('#like').click(function(){
          var empty="";
          $.ajax({
            type: "POST",
            url: "like.php",
            data: "None",
            dataType: "json",
            success: function(now){
              console.log("success");
              var response1=document.getElementById("response");
              response1.innerHTML="<a style='color:green'>Success!</a>";
            },
            error: function(now){
              console.log("error");
              var response2=document.getElementById("response");
              response2.innerHTML="<a style='color:red'>You can't dislike this game again</a>";
            }

          });
        });
});
function qjy(){
      
      var allcookie=document.cookie;
      
      var check =allcookie.indexOf('userName');
      
      if (check==-1){
        window.location.href="http://localhost";
      }
      }
      qjy();
      function open1234(name,name2,name3,path){
 var name = escape(name);  
 var name2= escape(name2);
 var name3= escape(name3);
    var expires = new Date(0);  
    path = path == "" ? "" : ";path=" + path;  
    document.cookie = name + "="+ ";expires=" + expires.toUTCString() + path;
    document.cookie = name2 + "="+ ";expires=" + expires.toUTCString() + path;
    document.cookie = name3 + "="+ ";expires=" + expires.toUTCString() + path;    
    window.location.href="http://localhost";
}
function goback(path){
  var expires1= new Date(0);
  path = path == "" ? "" : ";path=" + path;
  document.cookie = "gameName" + "="+ ";expires=" + expires1.toUTCString() + path;
  window.location.href='http://localhost';
}
</script>


</head>
<body>
  <div class="nav_button">
  <form class="logoutform"><input class="logout" value="log out!" type=button onclick="open1234('userName','userPass','gameName','/')"></form>
  <form class="goBackform"><input class="goBack" value="Go Back!" type=button onclick="goback('/')"></form>
  <br>
  </div>
<?php
require_once('db_setup.php');
$sql = "USE 410db;";
if ($conn->query($sql) === FALSE) {echo "Error using  database: " . $conn->error;}
// Query:
$id = $_POST['id'];
setcookie("gameName","$id",time()+180,'/');
$sql = "SELECT * FROM games where gameName like '$id';";
$result = $conn->query($sql);
if($result->num_rows > 0){
?>
<?php
while($row = $result->fetch_assoc()){
?>
	<h1 class="gameName" id='gameName'><?php echo $row['gameName']?></h1>
  	<h3><?php echo $row['category']?></h3>
  	<figure>
    	<img style="width:500px;height: 300px" src="images/<?php echo $row['gameName']?>.jpg">
  	</figure>
    <center>
    <button id="like" value="Like" name="Like">Disike This Game</button>
    <div id="response"></div></center>
	<h4><?php echo $row['description']?></h4>
<?php
}
}
else {
echo "Item not found";
header("Location: http://localhost"); 
}
?>
<center class="comment">
<h3>The Comments</h3>
</center>
<?php
$sql = "SELECT * FROM comment where gameName like '$id' order by create_date;";
$result = $conn->query($sql);
if($result->num_rows > 0){
?>
<?php
while($row = $result->fetch_assoc()){
  ?>
  <p><strong><?php echo $row['UserName']?></strong>: <?php echo $row['content']?><span> <?php echo $row['create_date']?></span></p>
<?php
}
}
?>


<!--Ajax Comment Function-->

<div id="main">
<div class="demo">
  <div id="comments">
     <!--<h3>The comments</h3>
     <p><strong>Username</strong>:comment<span>2011-01-09 21:06:12</span></p>-->

  </div>
  <div class="postComment" id="post">
     <h3>POST A NEW COMMENT</h3>
    <!-- <p>USERNAME:</p>-->
    <!-- <p><input type="text" class="input" id="user" /></p>-->
     <p>COMMENT:</p>
     <p><textarea class="input" id="txt" style="width:100%; height:80px"></textarea></p>
     <p><input class="submitButton" type="submit" value="Submit" id="add" /></p>
     <div id="message"></div>
  </div>
</div>
</div>

<?php
$conn->close();
?>  

</body>
</html>
