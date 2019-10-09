<?php
	if (isset($_POST["submit_btn"]))
	{
		$couponCode = $_POST["code"];
		$couponName = $_POST["name"];
		$couponAmount = $_POST["amount"];
		
		// Need some validation before inputting data
		
		// Insert data into database
		// Parameters for connection
		$host = "127.0.0.1";
		$username = "root";
		$password = "";
		$database = "foodsmith";
		
		// Create connection
		$conn = new mysqli($host, $username, $password, $database);
		
		// Check connection
		if (mysqli_connect_error())
		{
			die("Database connection failed: " . mysqli_connect_error());
		}
		
		$query = "INSERT INTO coupon (couponCode, couponName, couponAmount) VALUES ('$couponCode', '$couponName', '$couponAmount')";
		
		if ($conn->query($query) === true)
		{
			echo "<p>$couponCode, $couponName & $couponAmount added successfully</p>";
		}
		else
		{
			echo "<p>Error: " . $query . "<br/>" . $conn->error;
		}
		$conn->close();
	}
?>