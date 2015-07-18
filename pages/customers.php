<h1>Customers List</h1>

<section class="addingwrapper">
	<div class="row">
		<input class="col-sm-2" placeholder="Name" type="text" ng-model="addname" />
		<input class="col-sm-2" placeholder="Company" type="text" ng-model="addcompany" />
		<input class="col-sm-3" placeholder="Address" type="text" ng-model="addaddress" />
		<input class="col-sm-2" placeholder="Phone" type="text" ng-model="addphone" />
		<input class="col-sm-2" placeholder="Email" type="text" ng-model="addemail" />
		<input class="col-sm-1"  type="button" value="Add" ng-click="addCustomer()" />
	</div>
</section>

<section class="listwrapper">
	<div class="row listitem">
		<label class="col-sm-2">Name</label>
		<label class="col-sm-2">Company</label>
		<label class="col-sm-4">Address</label>
		<label class="col-sm-1">Phone</label>
		<label class="col-sm-2">Email</label>
	</div>
	<div class="row listitem">
		<label class="col-sm-12"><input type="text" ng-model="namefilter" placeholder="search" /></label>
	</div>
	<div class="row listitem" ng-click="getCustomerDetails(cust.custid)" ng-repeat="cust in customers | filter : namefilter">
		<label class="col-sm-2">{{ cust.name }}</label>
		<label class="col-sm-2">{{ cust.company }}</label>
		<label class="col-sm-4">{{ cust.address }}</label>
		<label class="col-sm-1">{{ cust.tel }}</label>
		<label class="col-sm-2">{{ cust.email }}</label>
	</div>
</section>