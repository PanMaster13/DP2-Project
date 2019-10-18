<?php
	session_start();
	
	if (isset($_POST["delete_submit_btn"])){
		$tableNumber = $_POST["delete_number"];
		// Insert data into database
		// Parameters for connection
		$host = "127.0.0.1";
		$username = "root";
		$password = "";
		$database = "foodsmith";
		
		// Create connection
		$conn = new mysqli($host, $username, $password, $database);
		
		// Check connection
		if (mysqli_connect_error()){
			die("Database connection failed: " . mysqli_connect_error());
		}
		
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