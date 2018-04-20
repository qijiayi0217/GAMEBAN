$(document).ready(function(){
	console.log("script loaded...");
	$('#login_button').click(checkpasswd);
})

var checkpasswd=function(){
	var $username=$('#username').val();
	var $password=$('#password').val();
	console.log($username);
	console.log($password);
	$.ajax({
		url: './cgi-bin/sign_in_for_html.py',
		data:{
			username: $username,
			password: $password
		},
		type: "POST",
		dataType: "json",
		success: function(data){
			console.log("success!");
			window.location.href="http://localhost/410_postlogin";

		},
		error: function(request){
			console.log("error!");
			$('#password').val('');
			$('#message').html("USERNAME or PASSWORD is wrong!");
		}
	})
}
