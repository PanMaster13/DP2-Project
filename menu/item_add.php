<?php
	session_start();
	
	if (isset($_POST["add_item_btn"])){
		$categoryID = $_POST["add_item_cat"];
		$itemName = $_POST["add_item_name"];
		$itemPrice = $_POST["add_item_price"];
		
		// Need some validation before inputting data
		if (!is_numeric($itemPrice)){
			$_SESSION["menuMsg"] = "Item price amount is invalid, must be numeric!";
			header("Location: index.php");
		} else{
			//include database connection
			//the connection variable is $conn
			include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
			
			$query = "INSERT INTO menu (categoryID, itemName, itemPrice) VALUES ('$categoryID', '$itemName', '$itemPrice')";
			
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