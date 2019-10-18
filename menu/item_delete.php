<?php
	session_start();
	
	if (isset($_POST["delete_item_btn"])){
		$itemName = $_POST["delete_item"];
		
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		$validationQuery = "SELECT * FROM menu WHERE itemName = '$itemName'";
		$validationResult = $conn->query($validationQuery);
		// There is such row with that item name
		if ($validationResult->num_rows > 0){
			$query = "DELETE FROM menu WHERE itemName = '$itemName'";
			if ($conn->query($query) === true){
				$_SESSION["menuMsg"] = "Item record deleted successfully.";
			} else {
				$_SESSION["menuMsg"] = "Error deleting record: <br/>" . $conn->error;
			}
			$conn->close();
			header("Location: index.php");
		} else {
			$_SESSION["menuMsg"] = "Error deleting record: No such item is found!";
			header("Location: index.php");
		}
	} else {
		$_SESSION["menuMsg"] = "";
		header("Location: index.php");
	}
?>