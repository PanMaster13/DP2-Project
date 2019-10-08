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
						<th>Order Number</th>
						<th>Order Items</th>
						<th>Table Number</th>
					</tr>
					<tr class="list-items">
						<td>1</td>
						<td>Chicken rice</td>
						<td>15</td>
					</tr>
					<tr class="list-items">
						<td>2</td>
						<td>Plain water</td>
						<td>20</td>
					</tr>
				</table>
			</div>
			<div id='right-btns'>
				<button id='add-button'>
					<p>Add</p>
				</button>
				<button id='amend-button'>
					<p>Amend</p>
				</button>
				<button id='cancel-button'>
					<p>Cancel</p>
				</button>
				<button id='pay-button'>
					<p>Pay</p>
				</button>
			</div>
		</div>
	</article>
	
	<footer>
		
	</footer>
	
</body>