<?php
	session_start();
	
	if (isset($_POST["edit_submit_btn"])){
		
		$couponCode = $_POST["edit_code"];
		// Removes it from post array, to make implementing update statement easier
		unset($_POST["edit_code"]);
		unset($_POST["edit_submit_btn"]);
		
		// Checks if there is a value in amount variable and the value is a number
		if ((!is_numeric($_POST["couponAmount"])) && (!empty($_POST["couponAmount"]))){
			$_SESSION["feedback"] = "Coupon amount is invalid!";
			header("Location: index.php");
		} else {
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
			// Validates if such coupon code exists or not
			$validationQuery = "SELECT * FROM coupon WHERE couponCode = '$couponCode'";
			$validationResult = $conn->query($validationQuery);
			// There is such row with that coupon code
			if ($validationResult -> num_rows > 0){
				// Creating dynamic UPDATE statement (Only updates if form value is not blank)
				$query = "UPDATE coupon SET";
				$comma = " ";
				foreach($_POST as $key => $val) {
					if( ! empty($val)) {
						$query .= $comma . $key . " = '" . $_POST[$key] . "'";
						$comma = ", ";
					}
				}
				$query .= " WHERE couponCode = '$couponCode'";
				if ($conn->query($query) === true){
					$_SESSION["feedback"] = "Coupon edited successfully.";
				} else {
					$_SESSION["feedback"] = "Error editing record: " . $conn->error;
				}
				$conn->close();
				header("Location: index.php");
			// No such row with that coupon code is found
			} else {
				$_SESSION["feedback"] = "Error editing record: No such coupon code is found!";
				header("Location: index.php");
			}
		}
	} else{
		$_SESSION["feedback"] = "";
		header("Location: index.php");
	}

?>