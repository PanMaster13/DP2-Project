<?php
	session_start();
	
	$host = "127.0.0.1";
	$username = "root";
	$password = "";
	$database = "foodsmith";
					
	// Create connection
	$conn = new mysqli($host, $username, $password, $database);
					
	// Check connection
	if (mysqli_connect_error())
	{
		die("Database connection failed: " . mysqli_connect_error());
	}
	
	$orderID = $_REQUEST['orderID'];
	$query = "DELETE FROM orderList WHERE orderID='". $orderID."' ";
	$result = mysqli_query($conn, $query) or die(mysqli_error());
	header("Location: index.php"); 
?>