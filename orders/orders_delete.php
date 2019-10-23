<?php
	session_start();
	
	//include database connection
	//the connection variable is $conn
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	
	$orderID = $_REQUEST['orderID'];
	$query = "UPDATE orderList SET orderStatus = 'Cancelled' WHERE orderID='". $orderID."' ";
	$result = mysqli_query($conn, $query) or die(mysqli_error());
	
	$prevSelectedTable = "";
	//Check previous tableID
	$tableQuery = "SELECT tableID FROM orderlist WHERE orderID=$orderID";
	$tableResult = $conn->query($tableQuery);
	
	while($tableRow = $tableResult->fetch_assoc())
		$prevSelectedTable = $tableRow['tableID'];
	
	$sql = "UPDATE tables SET tableStatus='Vacant' where tableID='$prevSelectedTable'";
	$update = mysqli_query($conn, $sql) or die(mysqli_error());
	
	header("Location: index.php"); 
?>