<?php
	$userID = $_POST["userID"];
	$userName = $_POST["userName"];
	$userType = $_POST["userType"];
	
	//adding the '' into the hash variable if password is filled
	//if password is not filled, point to the same variable so password is not changed.
	if($_POST["password"] != "") $passwordHash = "'".password_hash($_POST["password"], PASSWORD_DEFAULT)."'";
	else $passwordHash = "Password";

	//include database connection
	//the connection variable is $conn
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");

	$query = "UPDATE user SET userType = '$userType', userName = '$userName', Password = $passwordHash WHERE user.userID = $userID";

	if ($conn->query($query) === true){
		echo "User '$userName' has been succesfully modified. Returning to user management page.";
	} else {
		echo "Error modifying user: " . $conn->error;
		echo "<br/>Returning to user management page.";
	}
	$conn->close();
	header("Refresh: 5; url=/user/");
?>