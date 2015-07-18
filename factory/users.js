$(function(){
	$('#views').on('click','#loginbtn',function(){
		var uname = $('#txtusername').val();
		var psw = $('#txtpassword').val();
		$.post('scripts/processor.php',
		{
			go: "login",
			un: uname,
			p: psw
		},function(data,status){
			if(status == "success")
			{
				if(data == 3)
					location.href = '#/customers';
				else
					alert('Incorrect credentials!!!');
			}
		});
	});
});