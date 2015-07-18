appmodule.factory('CustomersFact',function(){
	var factory = {};
	
	factory.getData = function(){
		return $.post('scripts/processor.php', {go:"getcustomers"})
			.then(function(res){
				return res;
			});
	};
	factory.getFilterData = function(fil,col){
		return $.post('scripts/processor.php', {go:"getcustomers",filter: fil,field: col})
			.then(function(res){
				return res;
			});
	};
	factory.addCustomer = function(namev,companyv,addressv,phonev,emailv)
	{
		return $.post('scripts/processor.php', {
				go:"addcustomer",
				name: namev,
				company: companyv,
				address: addressv,
				phone: phonev,
				email: emailv
			})
			.then(function(res){
				return res;
			});
	};
	return factory;
});