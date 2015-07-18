appmodule.factory('CallsFact',function(){
	var factory = {};
	
	factory.getData = function(){
		return $.post('scripts/processor.php', {go:"getcalls"})
			.then(function(res){
				return res;
			});
	};
	
	factory.addCall = function(customerid,feedback,remarks)
	{
		return $.post('scripts/processor.php', {
			go:"addcall",
			custid: customerid,
			feed: feedback,
			rem: remarks
			})
			.then(function(res){
				return res;
			});
	}
	
	return factory;
});