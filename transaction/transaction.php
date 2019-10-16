<!DOCTYPE html>

<html lang="en">

<head>
	<title>Transaction</title>
	<meta charset="utf-8">
	<meta name="author" content="Caleb Teng">
	<meta name="description" content="Transaction Management">
	<meta name="keywords" content="Transaction, Management">

	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>

	<script src="script.js"></script>

	<?php
		include "../template/header.php";
	?>
	
	<article>
		<h1>Transaction History</h1>
		<div id='article-elements'>
			<div id='left-transaction-list'>
				<table id="transaction-table">
					<tr>
						<th>Transaction ID </th>
						<th>Event</th>
						<th>Order Price</th>
						<th>Time</th>
						<th>Staff</th>
					</tr>
					<tr class="list-items">
						<td>abc12345</td>
						<td>Paid</td>
						<td>RMxxxx</td>
						<td>7:00 10/10/2019</td>
						<td>Jason</td>
					</tr>
					<tr class="list-items">
						<td>def67890</td>
						<td>Paid</td>
						<td>RMxxxx</td>
						<td>19:00 10/10/2019</td>
						<td>Chris</td>
					</tr>
					
					
					
					
				</table>
			</div>
			<div id='right-btns'>
				<button id='add-button'>
					<p>Add</p>
				</button>
				<button id='edit-button'>
					<p>Edit</p>
				</button>
				
			</div>
		</div>
	</article>
	
	<footer>
		
	</footer>
	
</body>