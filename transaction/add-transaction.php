<?php
	session_start();
	
	if (isset($_POST["add-transaction-btn"])){
		$orderID = $_POST["add_order_id"];
		$orderStatus = $_POST["add_order_status"];
		$orderPrice = $_POST["add_order_price"];
		$transtime = $_POST["add_time"];
		$transStaff = $_POST["add_staff"];
		
		// Need some validation before inputting data
		if (!is_numeric($itemPrice)){
			$_SESSION["menuMsg"] = "Item price amount is invalid, must be numeric!";
			header("Location: index.php");
		} else{
			//include database connection
			//the connection variable is $conn
			include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
			
			$query = "INSERT INTO transaction (orderID, orderDate, orderPrice,  ) VALUES ('$reportID', '$reportDate', '$reportamount',$reportProfit')";
			
			if ($conn->query($query) === true){
				$_SESSION["menuMsg"] = "Item record added successfully.";
			} else {
				$_SESSION["menuMsg"] = "Error adding record to database: <br/>" . $conn->error;
			}
			$conn->close();
			header("Location: index.php");
		}
	} else {
		$_SESSION["menuMsg"] = "";
		header("Location: index.php");
	}

?>