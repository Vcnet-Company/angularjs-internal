appmodule.controller('CallController',['$scope','CallsFact','CustomersFact',function($scope,CallsFact,CustomersFact){
	init();
	function init()
	{
		CallsFact.getData()
			.then(function(res){
				$scope.calls = JSON.parse(res);
				$scope.$apply();
			});
	}
	
	$scope.catchCustName = function()
	{
		CustomersFact.getFilterData($scope.custname,'name').then(function(res)
		{
			$scope.custs = JSON.parse(res);
			$scope.$apply();
		});
	};
	
	$scope.addCall = function()
	{
		var custid = $('#customerslist option:selected').attr('data-custid');
		CallsFact.addCall(custid,$scope.custfeedback,$scope.custremarks).then(function(res){
			if(res == 1)
			{
				init();
			}
		});
	};
}]);