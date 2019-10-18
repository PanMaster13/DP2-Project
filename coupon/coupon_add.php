<?php
	session_start();
	
	if (isset($_POST["add_submit_btn"]))
	{
		$couponCode = $_POST["add_code"];
		$couponName = $_POST["add_name"];
		$couponAmount = $_POST["add_amount"];
		
		// Need some validation before inputting data
		if (!is_numeric($couponAmount)){
			$_SESSION["feedback"] = "Coupon amount is invalid, must be numeric!";
			header("Location: index.php");
		} else{
			// Insert data into database
			
			//include database connection
			//the connection variable is $conn
			include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
			$query = "INSERT INTO coupon (couponCode, couponName, couponAmount) VALUES ('$couponCode', '$couponName', '$couponAmount')";
			
			if ($conn->query($query) === true){
				$_SESSION["feedback"] = "Coupon added successfully.";
			} else {
				$_SESSION["feedback"] = "Error adding record to database: " . $conn->error;
			}
			$conn->close();
			header("Location: index.php");
		}
	} else{
		$_SESSION["feedback"] = "";
		header("Location: index.php");
	}
?>