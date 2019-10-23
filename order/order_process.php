<?php
	// Order Process in ORDER page, used to insert an order to database

	
	//include database connection
	//the connection variable is $conn
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");

	$selectedItem = "";
	$itemList = "";
	$quantityList = "";
	$remarksList = "";
	$selectedTable = "";
	
	
	
	if(isset($_POST['submit'])){
		if($_POST['tableSelection']){
			$selectedTable = $_POST['tableSelection']; 
		}
		
		if(!empty($_POST['checkbox1'] and !empty($_POST['quantity']))){
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
			
			$sql = "INSERT INTO orderlist(orderDate,itemList,itemQuantity,itemRemarks,totalPrice,orderStatus,couponCode,tableID)
			VALUES (CURDATE(),'$itemList','$quantityList', '$remarksList', '0.00','Pending',NULL,'$selectedTable')";
			$insert = $conn->query($sql);
			
			$sql = "UPDATE tables SET tableStatus='Occupied' where tableID='$selectedTable'";
			$update = $conn->query($sql);
			
			if($insert && $update){
				echo "Success!";
			
			}
			else{
				
				die("Error:" . mysqli_error($conn));
			}
		}
		else{
			echo "Please enter at least one food or drink.\n";
			echo "Redirecting in 5 seconds.";
			header("Refresh: 5; url=/order/");
		}
	}
?>