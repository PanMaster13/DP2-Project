<!DOCTYPE html>

<html lang="en">

<head>
	<title>Order List</title>
	<meta charset="utf-8">
	<meta name="author" content="Low Lip Shen">
	<meta name="description" content="Order List">
	<meta name="keywords" content="Order, Order List">

	<link rel="stylesheet" href="orders_style.css">

	<script src="orders_script.js"></script>
<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
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
						<th>TableID</th>
					</tr>
				<?php
					//include database connection
					//the connection variable is $conn
					include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
					
					$orderListQuery = "SELECT * FROM orderList";
					$orderListResult = $conn->query($orderListQuery);
					
					//PHP function n12br - Inserts HTML line breaks before all newlines in a string
					while ($orderListRow = $orderListResult->fetch_assoc())
					{
						if($orderListRow["orderStatus"] == "Pending")
							echo "<tr class='list-items'><td>" . $orderListRow["orderID"] . "</td><td>" . 
							$orderListRow["orderDate"] . "</td><td>" . nl2br($orderListRow["itemList"]) . "</td><td>" .
							$orderListRow["orderStatus"] . "</td><td>" . 
							$orderListRow["tableID"] . "</td></tr>";
					}
					
					echo "</table>";
					mysqli_free_result($orderListResult);
					
				?>
			</div>
			<div class="table-buttons-group button-group">
				<button id='add-button' onclick="window.location.href='/order'">
					<p>Add</p>
				</button>
				<button id='amend-button'>
					<p>Amend</p>
				</button>
				<button id='cancel-button' class="button-red red-button-active">
					<p>Cancel</p>
				</button>
				<!--Validation in progress-->
				<button id='pay-button' class="button-green green-button-active">
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
				<button type="button" id="delete-popup-button" class="button-red red-button-active">Yes</button>
			</div>
		</div>
		</div>
		
	</article>
</body>