
<?php

header('Access-Control-Allow-Origin: *');

function getDBInstance()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "vtigercrm";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
		
	// Check connection
	if ($conn->connect_error) {		
		die("Connection failed: " . $conn->connect_error);
	} 
	
	mysqli_select_db($conn,"vtigercrm");

	return $conn;	
}

function query($dbconn, $query)
{
$result = mysqli_query($dbconn,$query)
		or die("Error: ".mysqli_error($dbconn));
	$success = array();
	while($row = mysqli_fetch_assoc($result)){
		$success[] = array(
		'status' => "Success",
		'productname' => $row['productname'],
		'productcode' => $row['productcode'],
		'attachmentsid' => $row['attachmentsid'],
		'path' => $row['path'], 
		'imagename'=>$row['imagename'],
		
		'accountname'=>$row['accountname'],
		'phone'=>$row['phone'],
		'email'=>$row['email1'],
		'accountid'=>$row['accountid'],
		'street'=>$row['bill_street'],
		'city'=>$row['bill_city'],
		'state'=>$row['bill_state'],
		'country'=>$row['bill_country'],
		'pobox'=>$row['bill_pobox'],
		
		'subject'=>$row['subject'],
		'customerno'=>$row['customerno'],
		'salesorder_no'=>$row['salesorder_no'],
		'total'=>$row['total'],
		'subtotal'=>$row['subtotal'],
		'sostatus'=>$row['sostatus'],
		'pre_tax_total'=>$row['pre_tax_total']
		);
	}
	return $success;  
	
}

// html 에서 넘어온 oper 라는 파라메터
$oper = $_GET['oper'];

$db_instance = getDBInstance();

// product list
if($oper == "Product"){

	$query = "SELECT pd.imagename, at.path, at.attachmentsid
	FROM vtiger_crmentity ce, vtiger_products pd, vtiger_seattachmentsrel sa, vtiger_attachments at
	WHERE ce.deleted =0
	AND ce.crmid = pd.productid
	AND pd.productid = sa.crmid
	AND sa.attachmentsid = at.attachmentsid";	

	$query_result = query($db_instance, $query);
	echo json_encode($query_result);
}
// organization list
else if($oper == "Contact"){
	$query = "select accountid, accountname, phone, email1 from vtiger_account";

	$query_result = query($db_instance, $query);
	echo json_encode($query_result);
}
// order list
else if($oper == "Order"){
	$query = "SELECT * FROM vtiger_salesorder";

	$query_result = query($db_instance, $query);
	echo json_encode($query_result);
}
// organization detail list
else if($oper == "accountDetail"){
	$orgname = $_GET['orgname'];
	
	$query = "select distinct ac.accountid, ac.accountname, ac.phone, ac.email1, ab.bill_street, ab.bill_city, ab.bill_state, ab.bill_country, ab.bill_pobox
	from vtiger_account ac, vtiger_accountbillads ab
	where ac.accountid = ab.accountaddressid
	and ac.accountname = '$orgname'";	

	$query_result = query($db_instance, $query);
	echo json_encode($query_result);	
}else if($oper == "orderDetail"){

}

;
?>
 