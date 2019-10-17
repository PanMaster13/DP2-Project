<!DOCTYPE html>

<html lang="en">

<head>
	<title>Order List</title>
	<meta charset="utf-8">
	<meta name="author" content="Low Lip Shen">
	<meta name="description" content="Order List">
	<meta name="keywords" content="Order, Order List">

	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>

	<script src="script.js"></script>

	<?php
		include "../template/header.php";
	?>
	
	<article>
		<h1>Orders</h1>
		<div id='article-elements'>
			<div id='left-order-list'>
				<table id="order-table">
					
					<tr>
						<th>OrderID</th>
						<th>Order Date</th>
						<th>Order Items</th>
						<th>Order Status</th>
						<th>Total Price</th>
						<th>TableID</th>
					</tr>
				<?php
					$host = "127.0.0.1";
					$username = "root";
					$password = "";
					$database = "foodsmith";
					
					// Create connection
					$conn = new mysqli($host, $username, $password, $database);
					
					// Check connection
					if (mysqli_connect_error())
					{
						die("Database connection failed: " . mysqli_connect_error());
					}
					$orderListQuery = "SELECT * FROM orderList";
					$orderListResult = $conn->query($orderListQuery);
					
					//PHP function n12br - Inserts HTML line breaks before all newlines in a string
					while ($orderListRow = $orderListResult->fetch_assoc())
					{
						echo "<tr class='list-items'><td>" . $orderListRow["orderID"] . "</td><td>" . 
						$orderListRow["orderDate"] . "</td><td>" . nl2br($orderListRow["itemList"]) . "</td><td>" .
						$orderListRow["orderStatus"] . "</td><td>" . $orderListRow["totalPrice"] . "</td><td>" . 
						$orderListRow["tableID"] . "</td></tr>";
					}
					
					echo "</table>";
					mysqli_free_result($orderListResult);
					
				?>
			</div>
			<div id='right-btns'>
				<button id='add-button' onclick="window.location.href='/orderprocess'">
					<p>Add</p>
				</button>
				<button id='amend-button'>
					<p>Amend</p>
				</button>
				<button id='cancel-button'>
					<p>Cancel</p>
				</button>
				<!--Validation in progress-->
				<button id='pay-button' onclick="window.location.href='/payment'">
					<p>Pay</p>
				</button>
			</div>
		</div>

		<div id="none-popup">
		<div id="popup">
		
			<div id="popup-content">
				<span class="popup-close-btn">&times;</span>
				<p id="popup-title">Are you sure to Cancel this Order?</p>
				<button type="button" id="cancel-popup-button">No</button>
				<button type="button" id="delete-popup-button">Cancel</button>
			</div>
		</div>
		</div>
		
	</article>
	
	<footer>
		
	</footer>
	
</body>