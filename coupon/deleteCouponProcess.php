<?php
	session_start();

	if (isset($_POST["delete_submit_btn"]))
	{
		$couponCode = $_POST["delete_code"];
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
			$query = "DELETE FROM coupon WHERE couponCode = '$couponCode'";
			if ($conn->query($query) === true){
				$_SESSION["feedback"] = "Coupon deleted successfully.";
			} else {
				$_SESSION["feedback"] = "Error deleting record: " . $conn->error;
			}
			$conn->close();
			header("Location: index.php");
		// No such row with that coupon code is found
		} else {
			$_SESSION["feedback"] = "Error deleting record: No such coupon code is found!";
			header("Location: index.php");
		}
	} else{
		$_SESSION["feedback"] = "";
		header("Location: index.php");
	}
?>