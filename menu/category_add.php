<?php
	session_start();

	if (isset($_POST["add_cat_btn"])){
		$categoryName = $_POST["add_category_name"];
		
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		$query = "INSERT INTO category (categoryName) VALUES ('$categoryName')";
		
		if ($conn->query($query) === true){
			$_SESSION["menuMsg"] = "Category record added successfully.";
		} else {
			$_SESSION["menuMsg"] = "Error adding record to database: " . $conn->error;
		}
		$conn->close();
		header("Location: index.php");
	} else {
		$_SESSION["menuMsg"] = "";
		header("Location: index.php");
	}
?>