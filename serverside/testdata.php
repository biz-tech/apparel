<?php
header('Access-Control-Allow-Origin: *');

function getDBInstance()
{
	$servername = "localhost";
	$username = "i714364_vtig1";
	$password = "J@va5vrgqj08(]4";
	$dbname = "i714364_vtig1";
	
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
		'firstname'=>$row['firstname'],
		'lastname'=>$row['lastname'],
		'email'=>$row['email'],
		'mobile'=>$row['mobile'],
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
if($oper == "Product"){

//$query = "select productname, productcode,attachmentsid, path, imagename from vtiger_products pd inner join vtiger_attachments at ON pd.imagename = at.name";
	$query = "SELECT pd.imagename, at.path, at.attachmentsid
FROM vtiger_crmentity ce, vtiger_products pd, vtiger_seattachmentsrel sa, vtiger_attachments at
WHERE ce.deleted =0
AND ce.crmid = pd.productid
AND pd.productid = sa.crmid
AND sa.attachmentsid = at.attachmentsid";

	$query_result = query($db_instance, $query);
	echo json_encode($query_result);
}
else if($oper == "Contact")
{
	$query = "select firstname, lastname, email, mobile from vtiger_contactdetails";

	$query_result = query($db_instance, $query);
	echo json_encode($query_result);
}else if($oper == "Order")
{
	$query = "SELECT * FROM vtiger_salesorder";

	$query_result = query($db_instance, $query);
	echo json_encode($query_result);
}
?>
 