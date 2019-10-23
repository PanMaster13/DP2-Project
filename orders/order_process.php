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
	$selectedTable = "";
	$prevSelectedTable = "";
	
	
	
	if(isset($_POST['submit'])){
		if($_POST['tableSelection']){
			$selectedTable = $_POST['tableSelection']; 
		}
		
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
			
			//CHANGE TO UPDATE
			$sql = "UPDATE orderlist SET itemList = '$itemList', itemQuantity = '$quantityList', itemRemarks = '$remarksList' WHERE orderID = $orderID";
			$update = $conn->query($sql);
			
			//Check previous tableID
			$tableQuery = "SELECT tableID FROM orderlist WHERE orderID=$orderID";
			$tableResult = $conn->query($tableQuery);
			
			$update2 = true;
			$update3 = true;
			$update4 = true;
			
			while($tableRow = $tableResult->fetch_assoc())
				$prevSelectedTable = $tableRow['tableID'];
			
			if($prevSelectedTable != $selectedTable){
				//Update tablestatus of selected tableID
				$sql = "UPDATE tables SET tableStatus='Occupied' WHERE tableID='$selectedTable'";
				$update2 = $conn->query($sql);
				//Update tablestatus of previous selected tableID
				$sql = "UPDATE tables SET tableStatus='Vacant' WHERE tableID='$prevSelectedTable'";
				$update3 = $conn->query($sql);
				//Update the tableID for that order
				$sql = "UPDATE orderlist SET tableID = '$selectedTable' WHERE orderID = $orderID";
				$update4 = $conn->query($sql);
			}
			
			if($update  && $update2 && $update3 && $update4){
				
				echo "Success!";
				
			}
			else{
				
				die("Error:" . mysqli_error($conn));
			}
		}
		else{
			echo "Please enter at least one food or drink.\n";
			echo "Redirecting in 5 seconds.";
			header("Refresh: 5; url=/orders");
		}
	}

?>