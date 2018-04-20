$(document).ready(function(){
	console.log("script loaded...");
	$('#send').click(response);
	$('#words').keypress(function(event){
		var key=event.which;
		if(key == 13){
			response;
		}
	})
})

var response=function(){
	var $name=$('#words').val();
	console.log("name: "+ $name);
	$.ajax({
		url: '../cgi-bin/try.py',
		data:{
			words: $name
		},
		type: "GET",

		dataType: "json",

		success: function(data11){
			console.log("success!");
			console.log(data11);
			$('#error').empty();
			$('#resp').html('Server said: '+data11.resp);
		},

		error: function(request){
			console.log("error!");
			console.log(data);
			$('#resp').empty();
			$('#error').html("<p>wrong input:</p>"+data.error);
		}
	});
};