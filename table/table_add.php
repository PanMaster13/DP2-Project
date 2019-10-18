<?php
	session_start();

	if (isset($_POST["add_submit_btn"])){
		$tableSeats = $_POST["add_seats"];
		$tableStatus = $_POST["add_status"];
		
		// Need some validation before inputting data
		if (!preg_match('/^\d+$/',$tableSeats)){
			$_SESSION["tableMsg"] = "Table seats is invalid, must be an integer value!";
			header("Location: index.php");
		} else{
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
			
			$query = "INSERT INTO tables (tableSeats, tableStatus) VALUES ('$tableSeats', '$tableStatus')";
			
			if ($conn->query($query) === true){
				$_SESSION["tableMsg"] = "Table record added successfully.";
			} else{
				$_SESSION["tableMsg"] = "Error adding record to database: " . $conn->error;
			}
			$conn->close();
			header("Location: index.php");
		}
	} else{
		$_SESSION["feedback"] = "";
		header("Location: index.php");
	}
?>