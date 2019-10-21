<?php
	// Order Process in ORDERS page, used to update the specified order to database 
	// Similar to Order Process in ORDER page, but order_process in ORDER page is for insertion and this is for updates
	
	//include database connection
	//the connection variable is $conn
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");

	$itemlist = "";
	
	$orderID = $_REQUEST['orderID'];
	
	$selectedItem = "";
	$itemList = "";
	$quantityList = "";
	$remarksList = "";
	
	
	
	if(isset($_POST['submit'])){
		
		if(!empty($_POST['checkbox1'])){
			foreach($_POST['checkbox1'] as $selected){
				
				if($selected == 0)
					$selectedItem = "Burger";
				else if($selected == 1)
					$selectedItem = "Sandwich";
				else if($selected == 2)
					$selectedItem = "Boba Milk Tea";
				else
					$selectedItem = "Latte";
				
				$itemList = $itemList . $selectedItem . "\n";
				$quantityList = $quantityList . $_POST['quantity'][$selected] . "\n";
				
				if(empty($_POST['remarks'][$selected]))
					$remarksList = $remarksList . "None" . "\n";
				else
					$remarksList = $remarksList . $_POST['remarks'][$selected] . "\n";
			}
		}
	}
	
	//CHANGE TO UPDATE
	$sql = "UPDATE orderlist SET itemList = '$itemList', itemQuantity = '$quantityList', itemRemarks = '$remarksList' WHERE orderID = $orderID";
	$update = $conn->query($sql);
	
	
	if($update){
		
		echo "Success!";
		
	}
	else{
		
		die("Error:" . mysqli_error($conn));
	}
	

?>