$(document).ready(function(){
		console.log("script loaded...");
		$('#login_button').click(checksignup);
	})

var checksignup=function(){
	var $username=$('#username').val();
	var $password=$('#password').val();
	var $age=$('#age').val();
	var $sex=$('#sex').val();
	console.log($sex);
	$.ajax({
		url: './cgi-bin/sign_up_for_html.py',
		data:{
			username:$username,
			password:$password,
			age:$age,
			sex:$sex
		},
		type: "POST",
		dataType: "json",
		success: function(data){
			console.log('success!');
			alert('success!');
			window.location.href="http://localhost/index.html";
		},
		error: function(request){
			console.log("error!");
			$('#password').val('');
			$('#passwordAgain').val('');
			$('#message').html('UserName exists!');
		}
	})
}

var flag1 = false, flag2 = false, flag3 = false, flag4 = false;

function judgement1(obj){

	var name = obj.value.trim();
	if(name == obj.defaultValue){
		return;
	}
	if(name.length == 0){
		obj.value = obj.defaultValue;
		obj.style.color = '#999';
		flag1 = false;  
	}
	else if(name.length > 20){
		obj.value = "UserName must less than 20 values";
		obj.style.color = '#ff0000';
		flag1 = false;  
	}
	else{
		flag1 = true;  
	}
}
function clearusername(obj){
	
	if(!flag1){
		obj.value = ''; 
		obj.style.color='#000';
	}
}
function judgement2(obj){

	var password = obj.value.trim();
	if(password == obj.defaultValue){
		return;
	}
	if(password.length == 0){
		obj.value = obj.defaultValue;
		obj.style.color = '#999';
		flag2 = false;
		obj.type = "text";
	}
	else if(password.length < 6){
		obj.value = "Password must more than 6 values";
		obj.style.color = '#ff0000';
		flag2 = false;
		obj.type = "text";			
	}
	else if(password.length > 100){
		obj.value = "Password must less than 100 values";
		obj.style.color = '#ff0000';
		flag2 = false;
		obj.type = "text";
	}
	else{
		flag2 = true;  
		obj.type = "password";
	}
}
function clearpassword(obj){
	
	if(!flag2){
		obj.value = ''; 
		obj.style.color='#000';
		obj.type = "password";
	}
}
function judgement3(obj){

	var passwordagain = obj.value.trim();
	if(passwordagain == obj.defaultValue){
		return;
	}
	if(!flag2){
		obj.value = "Set your password first";
		obj.style.color = '#ff0000';
		flag3 = false; 
		obj.type = "text";			
		return;
	}
	var pwd2 = $('#password').val();
	if(passwordagain.length == 0){
		obj.value = obj.defaultValue;
		obj.style.color = '#999';
		obj.type = "text";
		flag3 = false;
		
	}
	else if(passwordagain != pwd2){
		obj.value = "Two PassWords are DIFFERENT";
		obj.style.color = '#ff0000';
		obj.type = "text";
		flag3 = false;  
	}
	else{
		flag3 = true;  
		obj.type = "password";
	}
}
function clearpasswordagain(obj){
	
	if(!flag3){
		obj.value = ''; 
		obj.style.color='#000';
		obj.type = "password";
	}
}
function judgement4(obj){

	var age = obj.value.trim();
	if(!(/(^[1-9]\d*$)/.test(age))){
		obj.value = "Age must be positive integer";
		obj.style.color = '#ff0000';
		flag4 = false; 
	}
	else{
		flag4 = true;
	}
}
function clearage(obj){
	if(!flag4){
		obj.value = ''; 
		obj.style.color='#000';
	}
}
function pushmessage(){

	if(flag1 & flag2 & flag3 & flag4){
		document.register.submit();
	}
	else{
		alert("Please enter all the information!!!");
	}
}
