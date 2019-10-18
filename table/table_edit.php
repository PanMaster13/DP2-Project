<?php
	session_start();
	
	if (isset($_POST["edit_submit_btn"])){
		$tableNumber = $_POST["edit_number"];
		
		unset($_POST["edit_number"]);
		unset($_POST["edit_submit_btn"]);
		
		// Checks if there is a value in seat amount variable and the value is an integer
		if ((!preg_match('/^\d+$/', $_POST["tableSeats"])) && (!empty($_POST["tableSeats"]))){
			$_SESSION["tableMsg"] = "Table seats is invalid, must be an integer value!";
			header("Location: index.php");
		} else {
			// Insert data into database
			
			//include database connection
			//the connection variable is $conn
			include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
			
			// Validates if such table number exists or not
			$validationQuery = "SELECT * FROM tables WHERE tableID = '$tableNumber'";
			$validationResult = $conn->query($validationQuery);
			// There is such row with that table number/ID
			if ($validationResult->num_rows > 0){
				// Creating dynamic UPDATE statement (Only updates if form value is not blank)
				$query = "UPDATE tables SET";
				$comma = " ";
				$checkPrank = 0;
				foreach($_POST as $key => $val) {
					if( ! empty($val)) {
						$query .= $comma . $key . " = '" . $_POST[$key] . "'";
						$comma = ", ";
						$checkPrank++;
					}
				}
				if ($checkPrank == 0){
					$_SESSION["feedback"] = "You think its funny huh, trying to editing something while leaving nothing changed. You think you've achieved the highest level of comedy huh? Guess what, your mum gay. How bout dat?";
				} else {
					$query .= " WHERE tableID = '$tableNumber'";
					if ($conn->query($query) === true){
						$_SESSION["tableMsg"] = "Table record edited succesfully.";
					} else {
						$_SESSION["tableMsg"] = "Error editing record: " . $conn->error;
					}
				}
				$conn->close();
				header("Location: index.php");
			// No such row with that table number is found
			} else {
				$_SESSION["tableMsg"] = "Error deleting record: No such table number is found!";
				header("Location: index.php");
			}
		}
	} else {
		$_SESSION["feedback"] = "";
		header("Location: index.php");
	}

?>