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
			
			//include database connection
			//the connection variable is $conn
			include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
			
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