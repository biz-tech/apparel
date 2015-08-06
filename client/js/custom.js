var path = "http://crm.biztechus.com";
var test = "http://172.20.10.184/vtigercrm";
var params = location.search.split('&')[1]; // list 화면에서 클릭한 값을 담아서 detail 조회할때 사용.

//현재 url 담기.
var url =  window.location.href;			
var gourl = url.split('&');				
$('input[name="currentUrl"]').val(gourl[0]+"&"+gourl[1]);

// product list
function cntrProd($scope, $http){ 
	//var site= path+"/testdata.php?oper=product";
	var site= test+"/testdata.php?oper=product";		
	$http.get(site).success(function(response){
		$scope.data = response;
	});
}

// product detail
function cntrProductDetail($scope, $http){
	//var site= path+"/testdata.php?oper=productDetail&"+params;	
	var site= test+"/testdata.php?oper=productDetail&"+params;	
	$http.get(site).success(function(response){
		$scope.data = response;		
	}); 
}


// Account list
function cntrAccount($scope, $http){
	//var site= path+"/testdata.php?oper=acoount";
	var site= test+"/testdata.php?oper=acoount";	
	$http.get(site).success(function(response){	
		$scope.data = response;	
	});	
};

// Account detail
function cntrAccDetail($scope, $http){
	//var site= path+"/testdata.php?oper=accountDetail&"+params;
	var site= test+"/testdata.php?oper=accountDetail&"+params;	
	$http.get(site).success(function(response){
		$scope.data = response;		
	}); 
}

// order list
function cntrOrder($scope, $http){
	//var site= path+"/testdata.php?oper=Order";
	var site= test+"/testdata.php?oper=order";		
	$http.get(site).success(function(response){
		$scope.data = response;
	});
}

// order list
function cntrOrderDetail($scope, $http){

	//var site= path+"/testdata.php?oper=orderDetail&"+params;
	var site= test+"/testdata.php?oper=orderDetail&"+params;		
	$http.get(site).success(function(response){
		$scope.data = response;
	});
}

 $(function(){
        $("#edit").click(function(){
            var $this = $(this);
            var value = $this.attr('value');		
			
            if(value=="Edit"){
                $this.attr("value","Cancel");
				document.getElementById("save").style.display = "block";
				document.getElementById("delete").style.display = "none";
            }else{
                $this.attr("value","Edit");
				document.getElementById("save").style.display = "none";
				document.getElementById("delete").style.display = "block";
            }
            $(".editable").toggle();
			//original 정보 input에 담기.
			var accid = $('#originAccid').text();	
			$('input[name="accId"]').text(accid);			
        });		
		
        $("input.editable").change(function(){
            $(this).prev().value($(this).value());
        });		
		
		$("#save").click(function(){
			$('input[name="stage"]').val("save");	
			document.forms["accEdit"].submit();			
		});	
		$("#delete").click(function(){
			$(".editable").toggle();
			//original 정보 input에 담기.
			var accid = $('#originAccid').text();			
			$('input[name="accId"]').val(accid);
			$('input[name="stage"]').val("delete");	
			document.forms["accEdit"].submit();			
		});		
    });