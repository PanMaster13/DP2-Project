<!doctype html>
<html>

<head>
<title>Order</title>
<meta charset="utf-8">
	<meta name="author" content="Caleb Teng">
	<meta name="description" content="Order Process">
	<meta name="keywords" content="Order, Order Process">
	<link rel="stylesheet" href="order_style.css">

	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>

	<script src="order_script.js"></script>
</head>


<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
?>
	
<body>

<article>
<h1>Food</h1>

<form action ="/order_process.php">

<table id ="food_table">
<tr>
	<td>Food name</td>
	<td>CheckBox</td>
	<td>Quantity</td>
	<td>Remarks</td>

</tr>

<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
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
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order"  name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>
<tr>
	<td>Item Name</td><td><input type="checkbox" name="checkbox"></td>
	<td>
		<input type="text" id="text_order" name="quantity">
	</td>
	<td>
		<input type="text" id="text_order" name="remarks">
	</td>
</tr>

</table>

</form>
	
			
			<div id="send-btn">
					<button id="sendorder_btn">
					<p>Send Order</p>
					</button>
			</div>

</article>
</body>

</html>