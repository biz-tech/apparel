var path = "http://crm.biztechus.com";

function cntrProd($scope, $http){
	var site= path+"/testdata.php?oper=Product";	
	$http.get(site).success(function(response){$scope.data = response;});
}

function cntrCont($scope, $http){
	var site= path+"/testdata.php?oper=Contact";	
	$http.get(site).success(function(response){$scope.data = response;});
}

function cntrOrder($scope, $http){
	var site= path+"/testdata.php?oper=Order";	
	$http.get(site).success(function(response){$scope.data = response;});
}