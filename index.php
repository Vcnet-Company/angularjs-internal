<?php session_start(); ?>
<!Doctype html>
<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.1/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.1/angular-route.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.1/angular-animate.js"></script>
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" src="https://normalize-css.googlecode.com/svn/trunk/normalize.min.css" />
	<link href="css/style.css" media="all" rel="stylesheet" />
	<link href="css/large_style.css" media="screen and (min-width:800px)" rel="stylesheet" />
	
	<script src="module/contactsmod.js"></script>
	
	<script src="factory/customers.js"></script>
	<script src="factory/users.js"></script>
	<script src="factory/calls.js"></script>
	
	<script src="controller/customersctrl.js"></script>
	<script src="controller/callsctrl.js"></script>
</head>
<body>
	<header id="mainheader">
		<h1>VCNET Company Portal</h1>
		<?php 
			if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1)
			{
				print '<nav>
						<a href="#/customers" >Customers</a>
						<a href="#/calls" >Calls</a>
						<a href="#" id="logoutlink">Logout</a>
					</nav>';
			}
		?>
	</header>
	<section id="views" ng-app="appmodule">
		<div ng-view></div>
	</section>
	<script>
		$(function(){
			$('#logoutlink').click(function(){
				$.post('scripts/processor.php',{
					go: "logout"
				},function(data,status){
					if(status == "success")
					{
						location.href = "#/login";
						location.reload();
					}
				});
			});
		});
	</script>
</body>
</html>