<!doctype html>
<html>

<head>
<title>Order</title>
<meta charset="utf-8">
	<meta name="author" content="Chris">
	<meta name="description" content="Order Update">
	<meta name="keywords" content="Order, Order Update">
	<link rel="stylesheet" href="/order/order_style.css">

	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>
</head>


<?php
		include $_SERVER['DOCUMENT_ROOT']."/template/header.php";
		
		$orderID = $_REQUEST['orderID'];
	?>
	
	
<body>

<article>


<form action=<?php echo "order_process.php?orderID='" . $orderID . "'"?> method="post">



<?php
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	
		$orderID = $_REQUEST['orderID'];
		$string = "";
		$string2 = "";
		$string3 = "";
		
		$itemListArray = array();
		$quantityListArray = array();
		$remarksListArray = array();
	
		
		$tableQuery = "SELECT * FROM tables";
		$tableResult = $conn->query($tableQuery);
		$tableQuery2 = "SELECT tableID FROM orderList WHERE orderID = '" . $orderID . "'";
		$tableResult2 = $conn->query($tableQuery2);
	
		echo "<h2>" . "Table No." . "</h2>";
		if($tableResult->num_rows > 0)
		{
			echo "<select name='tableSelection'>";
			
			while($tableRow2 = $tableResult2->fetch_assoc())
				while($tableRow = $tableResult->fetch_assoc())
				{
					if($tableRow['tableStatus'] == 'Vacant')
						echo "<option value='" . $tableRow['tableID'] . "'>" . $tableRow['tableID'] . "</option>";
					else if($tableRow['tableID']==$tableRow2['tableID'])
						echo "<option value='" . $tableRow['tableID'] . "' selected>" . $tableRow['tableID'] . "</option>";
				}
			
			echo "</select>";
		}
	
	
		/////////////////////////
		//fetch the items names//
		/////////////////////////
		$orderQuery = "SELECT itemList FROM orderList WHERE orderID = '" . $orderID . "' AND orderStatus = 'Pending'";
		$orderResult = $conn->query($orderQuery);
		
		//fetch the items selected
		while($orderRow = $orderResult->fetch_assoc()){
			$string = implode("", $orderRow);
		}
		//split them into an array
		$itemListArray = explode("\n", $string);
		//trim all the whitespaces to make sure it matches the data in database
		$itemListArray = array_filter(array_map('trim', $itemListArray));
		
		
		////////////////////////////
		//fetch the items quantity//
		////////////////////////////
		$quantityQuery = "SELECT itemQuantity FROM orderList WHERE orderID = '" . $orderID . "' AND orderStatus = 'Pending'";
		$quantityResult = $conn->query($quantityQuery);
	
		while($quantityRow = $quantityResult->fetch_assoc()){
			$string2 = implode("", $quantityRow);
		}
		//split them into an array
		$quantityListArray = explode("\n", $string2);
		//trim all the whitespaces to make sure it matches the data in database
		$quantityListArray = array_filter(array_map('trim', $quantityListArray));
		
		
		///////////////////////////
		//fetch the items remarks//
		///////////////////////////
		$remarksQuery = "SELECT itemRemarks FROM orderList WHERE orderID = '" . $orderID . "' AND orderStatus = 'Pending'";
		$remarksResult = $conn->query($remarksQuery);
		
		while($remarksRow = $remarksResult->fetch_assoc()){
			$string3 = implode("", $remarksRow);
		}
		//split them into an array
		$remarksListArray = explode("\n", $string3);
		//trim all the whitespaces to make sure it matches the data in database
		$remarksListArray = array_filter(array_map('trim', $remarksListArray));
	
	
	
	
		$index = 1;
		$categoryQuery = "SELECT * FROM category";
		$categoryResult = $conn->query($categoryQuery);
		$rowIndex = 0;
		$rowIndex2 = 0;
		
		while ($categoryRow = $categoryResult->fetch_assoc())
		{
			$menuQuery = "SELECT * FROM menu WHERE categoryID = $index";
			$menuResult = $conn->query($menuQuery);
			
			
			// Echos table and values from database
			echo "<h2>" . $categoryRow["categoryName"] . "</h2>";
			echo "<table id='food_table'><tr><th>Item Name</th><th></th><th>Quantity</th><th>Remarks</th></tr>";
			if ($menuResult->num_rows > 0)
			{
				while($menuRow = $menuResult->fetch_assoc())
				{
					echo 
					"<tr class='list-items'><td>" . $menuRow['itemName'] . "</td>";
					
					if(in_array($menuRow['itemName'], $itemListArray)){
						echo"<td><input type='checkbox' name='checkbox1[]' value='" . $rowIndex2 . "' checked></td>";
						echo "<td><input type='number' id='text_order' name='quantity[]' value='" . $quantityListArray[$rowIndex] . "' min='0' max='10'></td>
							<td><input type='text' id='text_order' name='remarks[]' value='" . $remarksListArray[$rowIndex] . "'></td>
						</tr>";
						$rowIndex++;
					}
					else{
						echo"<td><input type='checkbox' name='checkbox1[]' value='" . $rowIndex2 . "'></td>";
						echo "<td><input type='number' id='text_order' name='quantity[]' min='0' max='10'></td>
							<td><input type='text' id='text_order' name='remarks[]'></td>
						</tr>";
					}
					$rowIndex2++;
				}
			}
			else
			{
				echo "0 results";
			}
			echo "</table>";
			$index++;
			mysqli_free_result($menuResult);
		}
		mysqli_free_result($categoryResult);
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
	?>

		<div id="send-btn">
				<input type="submit" id="sendorder_btn" value="Update order" name="submit"/>
		</div>

</form>

		<div id="back-btn">
				<button id="back_btn" onclick="window.location.href='/orders'">Back</button>
		</div>
			

</article>
</body>

</html>