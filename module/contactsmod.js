var appmodule = angular.module('appmodule',['ngRoute'])

/*Routes*/
	.config(['$routeProvider',function ($routeProvider)
	{
		var paramval;
		 $routeProvider
			 .when('/customers',{
				controller: 'CustomerCtrl',
				templateUrl: 'pages/customers.html'
			 })
			 .when('/login',{
				 templateUrl: 'pages/login.html'
			 })
			 .when('/calls',{
				 controller: 'CallController',
				 templateUrl: 'pages/calls.html'
			 })
			 .otherwise({redirectTo: '/login'});
	}]);