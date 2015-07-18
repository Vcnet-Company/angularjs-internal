appmodule.controller('CustomerCtrl',['$scope','CustomersFact',function($scope,CustomersFact){
	init();
	function init()
	{
		CustomersFact.getData()
			.then(function(res){
				$scope.customers = JSON.parse(res);
				$scope.$apply();
			});
	}
	
	/*functions*/
	$scope.getCustomerDetails = function(custid)
	{
		
	}
	
	$scope.addCustomer = function()
	{
		CustomersFact.addCustomer($scope.addname,$scope.addcompany,$scope.addaddress,$scope.addphone,$scope.addemail)
			.then(function(res){
				$scope.addname="",$scope.addcompany="",$scope.addaddress="",$scope.addphone="",$scope.addemail="";
				if(res == 1)
					init();
			});
	}
}]);