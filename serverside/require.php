<?php
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

function query($dbconn, $query, $rs = false)
{
	$result = mysqli_query($dbconn,$query)
		or die("Error: ".mysqli_error($dbconn));	
	$rows = array();		
	if($rs === true){
		while($row = mysqli_fetch_assoc($result)){		
			$rows[] = $row;
		}
		$result = $rows;
	}
	
	return $result; 			
}

?>