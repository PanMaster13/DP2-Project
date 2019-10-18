<?php
	session_start();
	
	if (isset($_POST["delete_cat_btn"])){
		$categoryID = $_POST["delete_category"];
		
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		// Validates if such category exists or not
		$validationQuery = "SELECT * FROM category WHERE categoryID = '$categoryID'";
		$validationResult = $conn->query($validationQuery);
		// There is such row with that category
		if ($validationResult->num_rows > 0){
			$query = "DELETE FROM category WHERE categoryID = '$categoryID'";
			if ($conn->query($query) === true){
				$_SESSION["menuMsg"] = "Category record deleted successfully.";
			} else {
				$_SESSION["menuMsg"] = "Error deleting record: <br/>" . $conn->error;
			}
			$conn->close();
			header("Location: index.php");
		} else {
			$_SESSION["menuMsg"] = "Error deleting record: No such category is found!";
			header("Location: index.php");
		}
	} else {
		$_SESSION["menuMsg"] = "";
		header("Location: index.php");
	}


?>