<?php
	session_start();
	
	if (isset($_POST["edit_item_btn"])){
		$itemName = $_POST["edit_item"];
		
		unset($_POST["edit_item"]);
		unset($_POST["edit_item_btn"]);
		
		// Need some validation before inputting data
		if ((!is_numeric($_POST["itemPrice"])) && (!empty($_POST["tableSeats"]))){
			$_SESSION["menuMsg"] = "Item price amount is invalid, must be numeric!";
			header("Location: index.php");
		} else {
			
			//include database connection
			//the connection variable is $conn
			include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
			
			$validationQuery = "SELECT * FROM menu WHERE itemName = '$itemName'";
			$validationResult = $conn->query($validationQuery);
			
			// There is such row with that itemName
			if ($validationResult->num_rows > 0){
				// Creating dynamic UPDATE statement (Only updates if form value is not blank)
				$query = "UPDATE menu SET";
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
						$_SESSION["menuMsg"] = "You think its funny huh, trying to editing something while leaving nothing changed. You think you've achieved the highest level of comedy huh? Guess what, your mum gay. How bout dat?";
				} else {
					$query .= " WHERE itemName = '$itemName'";
					if ($conn->query($query) === true){
						$_SESSION["menuMsg"] = "Item record edited succesfully.";
					} else {
						$_SESSION["menuMsg"] = "Error editing record: <br/>" . $conn->error;
					}
				}
				$conn->close();
				header("Location: index.php");
				// No such row with that table number is found
			} else {
				$_SESSION["menuMsg"] = "Error editing record: No such item is found!";
				header("Location: index.php");
			}
		}
	} else {
		$_SESSION["menuMsg"] = "";
		header("Location: index.php");
	}

?>