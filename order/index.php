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
		$categoryQuery = "SELECT * FROM category";
		$categoryResult = $conn->query($categoryQuery);
		
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
					<td><input type='checkbox' name='checkbox1[]' value='" . $menuRow['itemName'] . "'></td>
						<td><input type='text' id='text_order' name='quantity1'></td>
						<td><input type='text' id='text_order' name='remarks1'></td>
					</tr>";
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

<!--

	<table id ="food_table">
<tr>
	<td>Food name</td>
	<td>CheckBox</td>
	<td>Quantity</td>
	<td>Remarks</td>

</tr>
	<tr>


	<td>Item Name</td>
	
	<td><input type="checkbox" name="checkbox1"></td>
	<td>
		<input type="text" id="text_order" name="quantity1">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks1">
	</td>
</tr>

<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox2"></td>
	<td>
		<input type="text" id="text_order" name="quantity2">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks2">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox3"></td>
	<td>
		<input type="text" id="text_order" name="quantity3">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks3">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox4"></td>
	<td>
		<input type="text" id="text_order" name="quantity4">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks4">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox5 "></td>
	<td>
		<input type="text" id="text_order" name="quantity5 ">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks5"      >
	</td>
</tr>


</table>

<h2>Drinks</h2>

<table id ="drinks_table">

<tr>
	<td>Drinks</td>
	<td>CheckBox</td>
	<td>Quantity</td>
	<td>Remarks</td>

</tr>

<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkboxd1"></td>
	<td>
		<input type="text" id="text_order"  name="quantityd1">
	</td>
	<td>
		<input type="text" id="text_order" name="remarksd1">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkboxd2"></td>
	<td>
		<input type="text" id="text_order" name="quantityd2">
	</td>
	<td>
		<input type="text" id="text_order" name="remarksd2">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkboxd3"></td>
	<td>
		<input type="text" id="text_order" name="quantityd3">
	</td>
	<td>
		<input type="text" id="text_order" name="remarksd3">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkboxd4"></td>
	<td>
		<input type="text" id="text_order" name="quantityd4">
	</td>
	<td>
		<input type="text" id="text_order" name="remarksd4">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkboxd5"></td>
	<td>
		<input type="text" id="text_order" name="quantityd5">
	</td>
	<td>
		<input type="text" id="text_order" name="remarksd5">
	</td>
</tr>

</table>
-->

			<div id="send-btn">
					<input type="submit" id="sendorder_btn" value="Send order" name="submit">
					
					</button>
			</div>

</form>
	
			

</article>
</body>

</html>