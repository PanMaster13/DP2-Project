<!doctype html>
<html>

<head>
<title>Order</title>
<meta charset="utf-8">
	<meta name="author" content="Caleb Teng">
	<meta name="description" content="Order Process">
	<meta name="keywords" content="Order, Order Process">
	<link rel="stylesheet" href="style.css">

	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>

	<script src="script.js"></script>
</head>


<?php
		include $_SERVER['DOCUMENT_ROOT']."/template/header.php";
	?>
	
	
<body>

<article>


<form action ="order_process.php" method="post">



<?php
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	
		$index = 1;
		$rowIndex = 0;
		$categoryQuery = "SELECT * FROM category";
		$categoryResult = $conn->query($categoryQuery);
		
		//rowIndex acts as an index like an array
		//rowIndex is used to allow us to get the quantity and remarks of that specific row
		//therefore it will only get the quantity and remarks of the checkboxes which are checked
		while ($categoryRow = $categoryResult->fetch_assoc())
		{
			$menuQuery = "SELECT * FROM menu WHERE categoryID = $index";
			$menuResult = $conn->query($menuQuery);
			
			// Echos table and values from database
			echo "<h2>" . $categoryRow["categoryName"] . "</h2>";
			echo "<table id='food_table'><tr><th>Item Name</th><th>Checkbox</th><th>Quantity</th><th>Remarks</th></tr>";
			if ($menuResult->num_rows > 0)
			{
				while($menuRow = $menuResult->fetch_assoc())
				{
					echo 
					"<tr class='list-items'><td>" . $menuRow['itemName'] . "</td>
					<td><input type='checkbox' name='checkbox1[]' value='" . $rowIndex . "'></td>
						<td><input type='text' id='text_order' name='quantity[]'></td>
						<td><input type='text' id='text_order' name='remarks[]'></td>
					</tr>";
					
					$rowIndex++;
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
					<input type="submit" id="sendorder_btn" value="Send order" name="submit">
					
					</button>
			</div>

</form>
	
			

</article>
</body>

</html>