<?php
	session_start();
	
	//include database connection
	//the connection variable is $conn
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	
	$orderID = $_REQUEST['orderID'];
	$query = "DELETE FROM orderList WHERE orderID='". $orderID."' ";
	$result = mysqli_query($conn, $query) or die(mysqli_error());
	header("Location: index.php"); 
?>