<?php
	session_start();
	
	if (isset($_POST["edit_cat_btn"])){
		$categoryID = $_POST["edit_category"];
		
		unset($_POST["edit_category"]);
		unset($_POST["edit_cat_btn"]);
		
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		// Validates if such category exists or not
		$validationQuery = "SELECT * FROM category WHERE categoryID = '$categoryID'";
		$validationResult = $conn->query($validationQuery);
		
		// There is such row with that category
		if ($validationResult->num_rows > 0){
			// Creating dynamic UPDATE statement (Only updates if form value is not blank)
			$query = "UPDATE category SET";
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
				$query .= " WHERE categoryID = '$categoryID'";
				if ($conn->query($query) === true){
					$_SESSION["menuMsg"] = "Category record edited succesfully.";
				} else {
					$_SESSION["menuMsg"] = "Error editing record: <br/>" . $conn->error;
				}
			}
			$conn->close();
			header("Location: index.php");
			// No such row with that table number is found
		} else {
			$_SESSION["menuMsg"] = "Error editing record: No such category is found!";
			header("Location: index.php");
		}
	} else {
		$_SESSION["menuMsg"] = "";
		header("Location: index.php");
	}