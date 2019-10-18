<?php
	session_start();
	
	if (isset($_POST["delete_submit_btn"])){
		$tableNumber = $_POST["delete_number"];
		// Insert data into database
		
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		// Validates if such table number exists or not
		$validationQuery = "SELECT * FROM tables WHERE tableID = '$tableNumber'";
		$validationResult = $conn->query($validationQuery);
		// There is such row with that table number/ID
		if ($validationResult->num_rows > 0){
			$query = "DELETE FROM tables WHERE tableID = '$tableNumber'";
			if ($conn->query($query) === true){
				$_SESSION["tableMsg"] = "Table record deleted successfully.";
			} else {
				$_SESSION["tableMsg"] = "Error deleting record: " . $conn->error;
			}
			$conn->close();
			header("Location: index.php");
		// No such row with that table number is found
		} else {
			$_SESSION["tableMsg"] = "Error deleting record: No such table number is found!";
			header("Location: index.php");
		}
	} else{
		$_SESSION["tableMsg"] = "";
		header("Location: index.php");
	}

?>