var path = "http://crm.biztechus.com";
var test = "http://172.20.10.184/vtigercrm";


// product list
function cntrProd($scope, $http){ 
	//var site= path+"/testdata.php?oper=Product";
	var site= test+"/testdata.php?oper=Product";		
	$http.get(site).success(function(response){
		$scope.data = response;
	});
}

// organization list
function cntrCont($scope, $http){
	//var site= path+"/testdata.php?oper=Product";
	var site= test+"/testdata.php?oper=Contact";	
	$http.get(site).success(function(response){	
		$scope.data = response;	
	});	
};

// organization detail
function cntrOrgDetail($scope, $http){
var params = window.location.search.substr(1).split('&');

var site= test+"/testdata.php?oper=accountDetail&"+params;	
	$http.get(site).success(function(response){
		$scope.data = response;		
	}); 
}

// order list
function cntrOrder($scope, $http){
	//var site= path+"/testdata.php?oper=Product";
	var site= test+"/testdata.php?oper=Order";		
	$http.get(site).success(function(response){
		$scope.data = response;
	});
}

