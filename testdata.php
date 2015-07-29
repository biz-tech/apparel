<?php
header('Access-Control-Allow-Origin: *');
dbConnect();
$_GET[func] = $test;
function dbConnect(){
	$servername = "localhost";
	//$username = "sgoctrakker";
	//$password = "lrnToW1n";
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
	//$sql="SELECT * FROM game_master";
	
	//$sql="SELECT firstname, lastname, email FROM vtiger_contactdetails ORDER BY firstname asc";
	$sql="select productname, productcode,attachmentsid, path, imagename from vtiger_products pd inner join vtiger_attachments at ON pd.imagename = at.name";
	
	$result = mysqli_query($conn,$sql)
		or die("Error: ".mysqli_error($conn));
		
	while($row = mysqli_fetch_assoc($result)) {		
		//$success[] = array('status' => "Success", "msg" => "OK", "id" => $row['Id'],"game" => $row['Game']);
		$success[] = array('status' => "Success", 'productname' => $row['productname'], 'productcode' => $row['productcode'],'attachmentsid' => $row['attachmentsid'],'path' => $row['path'], 'imagename'=>$row['imagename']);		
	}
	
	print json_encode($success);	
	//mysqli_close($conn);
}
?>
 