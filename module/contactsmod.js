var appmodule = angular.module('appmodule',['ngRoute'])

/*Routes*/
	.config(['$routeProvider',function ($routeProvider)
	{
		var paramval;
		 $routeProvider
			 .when('/customers',{
				controller: 'CustomerCtrl',
				templateUrl: 'pages/customers.php'
			 })
			 .when('/login',{
				 templateUrl: 'pages/login.php'
			 })
			 .when('/calls',{
				 controller: 'CallController',
				 templateUrl: 'pages/calls.php'
			 })
			 .otherwise({redirectTo: '/login'});
	}]);