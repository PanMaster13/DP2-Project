<!DOCTYPE html>

<html lang="en">

<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="author" content="Low Lip Shen">
	<meta name="description" content="Admin Panel">
	<meta name="keywords" content="">

	<link rel="stylesheet" href="style.css">

	<script src="script.js"></script>
	
	<?php
		include "../template/header.php";
	?>
	
	<article>
		<h1>Payment</h1>
		<div id="article-elements">
			<table id="payment-table">
				<tr>
					<th>Items</th>
					<th>Qty</th>
					<th>Price</th>
				</tr>
				<tr>
					<td>Chicken rice</td>
					<td>1</td>
					<td>7.50</td>
				</tr>
				<tr>
					<td>Pasta</td>
					<td>1</td>
					<td>9.00</td>
				</tr>
				<tr>
					<td>Ramen</td>
					<td>1</td>
					<td>7.00</td>
				</tr>
				<tr>
					<td>Ramen</td>
					<td>1</td>
					<td>7.00</td>
				</tr>
				<tr>
					<td>Ramen</td>
					<td>1</td>
					<td>7.00</td>
				</tr>
				<tr>
					<td>Ramen</td>
					<td>1</td>
					<td>7.00</td>
				</tr>
				<tr id="specialCoupon">
					<td></td>
					<td></td>
					<td>0.00</td>
				</tr>
				<tr id="totalPrice">
					<td>Total:</td>
					<td></td>
					<td></td>
				</tr>
				<tr id="totalAmount">
					<td>Amount:</td>
					<td></td>
					<td></td>
				</tr>
				<tr id="totalChange">
					<td>Change:</td>
					<td></td>
					<td></td>
				</tr>
			</table>
			
			<div id='payment-btns'>
				<button id='cancel-btn'>
					<p>Cancel</p>
				</button>
				<div id='right-btns'>
					<button id='coupon-btn'>
						<p>Coupon</p>
					</button>
					<button id='pay-btn'>
						<p>Pay</p>
					</button>
				</div>
			</div>
		</div>
		
		<div id="none-popup">
		<div id="popup">
			<div id="popup-content">
				<span class="popup-close-btn">&times;</span>
				<p id="popup-title"></p>
				
				<div id="popup-RM-textBox">
					<span id="popup-RM-word">RM</span> 
					<input id="textBox" type="text" name="payment/coupon">
				</div>
				
				<div id="submit-btn">
					<input id="submitBtn" type="submit" value="Submit" onclick="submitOnClick()">
				</div>
			</div>
		</div>
		</div>
	</article>

	</body>