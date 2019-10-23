<?php
	session_start();
	
	if (isset($_POST["add-report-btn"])){
		$reportID = $_POST["add_report_id"];
		$reportDate = $_POST["add_report_date"];
		$reportamount = $_POST["add_order_amount"];
		$reportProfit = $_POST["add_profit"];
		
		// Need some validation before inputting data
		if (!is_numeric($itemPrice)){
			$_SESSION["menuMsg"] = "Item price amount is invalid, must be numeric!";
			header("Location: index.php");
		} else{
			//include database connection
			//the connection variable is $conn
			include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
			
			$query = "INSERT INTO report (reportID, reportDate, orderAmount, profit) VALUES ('$reportID', '$reportDate', '$reportamount',$reportProfit')";
			
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