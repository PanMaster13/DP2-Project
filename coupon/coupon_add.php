<?php
	session_start();
	
	if (isset($_POST["add_submit_btn"]))
	{
		$couponCode = $_POST["add_code"];
		$couponName = $_POST["add_name"];
		$couponAmount = $_POST["add_amount"];
		
		// Need some validation before inputting data
		if (!is_numeric($couponAmount)){
			$_SESSION["feedback"] = "Coupon amount is invalid!";
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