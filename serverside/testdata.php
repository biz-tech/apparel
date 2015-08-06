<?php
header('Access-Control-Allow-Origin: *');
require_once("require.php");

// html 에서 넘어온 oper 라는 파라메터
$oper = $_GET['oper'];

$db_instance = getDBInstance();

// product list
if($oper == "product"){

	$query = "SELECT pd.imagename, at.path, at.attachmentsid, pd.product_no
	FROM vtiger_crmentity ce, vtiger_products pd, vtiger_seattachmentsrel sa, vtiger_attachments at
	WHERE ce.deleted =0
	AND ce.crmid = pd.productid
	AND pd.productid = sa.crmid
	AND sa.attachmentsid = at.attachmentsid";	

	$query_result = query($db_instance, $query, true);
	echo json_encode($query_result);
}
 //product detail list
else if($oper == "productDetail"){
	$productno = $_GET['productno'];
	
	$query = "select distinct product_no, productname, unit_price, weight, pack_size, sales_start_date, sales_end_date
	from vtiger_products
	where product_no = '$productno'";	

	$query_result = query($db_instance, $query, true);
	echo json_encode($query_result);
}
// organization list
else if($oper == "acoount"){
	$query = "select accountid, accountname, phone, email1 from vtiger_account";

	$query_result = query($db_instance, $query, true);
	echo json_encode($query_result);
}
// organization detail list
else if($oper == "accountDetail"){
	$orgno = $_GET['orgno'];
	
	$query = "select distinct ac.accountid, ac.accountname, ac.phone, ac.email1, ab.bill_street, ab.bill_city, ab.bill_state, ab.bill_country, ab.bill_pobox
	from vtiger_account ac, vtiger_accountbillads ab
	where ac.accountid = ab.accountaddressid
	and ac.accountid = '$orgno'";	

	$query_result = query($db_instance, $query, true);
	echo json_encode($query_result);	
}
else if($oper == "accountEdit"){
	$accId = $_POST["accId"];
	$accName = $_POST["accountname"];	
	$email = $_POST["email"];
	$street = $_POST["street"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$stage = $_POST["stage"];
	$url = $_POST["currentUrl"];
	
	if($stage == "save"){
	$query = "update vtiger_account ac, vtiger_accountbillads ab
	set ac.accountname = '$accName', ac.email1 = '$email', ab.bill_street = '$street', ab.bill_city = '$city', ab.bill_state = '$state'	
	where ac.accountid = ab.accountaddressid
	and ac.accountid = '$accId'";	
	}else if($stage == "delete"){
	$query = "delete vtiger_account, vtiger_accountbillads
	FROM vtiger_account, vtiger_accountbillads
	WHERE vtiger_account.accountid = '$accId'
	and vtiger_account.accountid = vtiger_accountbillads.accountaddressid";		
	}
	
	$query_result = query($db_instance, $query);
	
	echo "<script>location.href='$url';</script>"; 

}
// order list
else if($oper == "order"){
	$query = "SELECT * FROM vtiger_salesorder";

	$query_result = query($db_instance, $query, true);
	echo json_encode($query_result);
}
/*
vtiger_sobillads for billing information(mandatory)
vtiger_soshipads for shipping information(mandatory)
vtiger_salesordercf for salesorderid(mandatory)
vtiger_inventoryproductrel for product information(mandatory)
vtiger_inventoryshippingrel for tax information(optional)
*/
 //order detail list
else if($oper == "orderDetail"){
	$orderno = $_GET['orderno'];
	
	$query = "select ac.accountname, so.salesorder_no, so.sostatus, so.total, ba.bill_street, ba.bill_city, ba.bill_code, 
	sa.ship_street, sa.ship_city, sa.ship_code, ip.quantity, ip.listprice, ip.tax1, ip.tax2, ip.tax3, ip.comment, isp.shtax1, isp.shtax2, isp.shtax3
	from vtiger_account ac, vtiger_salesorder so, vtiger_sobillads ba, vtiger_soshipads sa, vtiger_inventoryproductrel ip, vtiger_inventoryshippingrel isp
	where so.salesorder_no = '$orderno'
	and ba.sobilladdressid = so.salesorderid
	and sa.soshipaddressid = so.salesorderid
	and ip.id = so.salesorderid
	and isp.id = so.salesorderid
	and ac.accountid = so.accountid";	

	$query_result = query($db_instance, $query, true);
	echo json_encode($query_result);
};
?>
 