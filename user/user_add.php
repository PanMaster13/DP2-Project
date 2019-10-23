<?php
	$userName = $_POST["userName"];
	$passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$userType = $_POST["userType"];

	// Insert data into database

	//include database connection
	//the connection variable is $conn
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");

	$query = "INSERT INTO user (userID, userType, userName, Password) VALUES (NULL, '$userType', '$userName', '$passwordHash')";

	if ($conn->query($query) === true){
		echo "User '$userName' has been succesfully created. Returning to user management page.";
	} else {
		echo "Error adding user to database: " . $conn->error;
	}
	$conn->close();
	header("Refresh: 5; url=/user/");
?>