<?php
	//include database connection
	//the connection variable is $conn
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	
	$userID = $_POST['userID'];
	$userName = $_POST['userName'];
	$query = "DELETE FROM user WHERE user.userID = '$userID'";
		
	if ($conn->query($query) === true){
		echo "User '$userName' has been succesfully removed. Returning to user management page.";
	} else {
		echo "Error removing user from database: " . $conn->error;
	}
	$conn->close();
	header("Refresh: 5; url=/user/"); 
?>