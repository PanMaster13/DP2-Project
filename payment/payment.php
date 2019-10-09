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
		
		$count = $correctCouponID = $couponID = "";
		$correct = false;
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['couponTextBox'])){
			$couponID = $_POST['couponTextBox'];
			
			$correct = false;
			
			$sql = "SELECT couponCode FROM coupon WHERE couponCode='$couponID'";
			$result = $conn->query($sql);
			$count = mysqli_num_rows($result);
			
			if($count == 1){
				$correctCouponID = $couponID;
				$correct = true;
			}
			else{
				echo "Invalid couponID";
				$correct = false;
			}
		}

		// Close connection (although it is done automatically when script ends
		//$conn->close();
	?>	
	
	
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
					<td>
						<?php 
							echo $correctCouponID;
							
							if($correct == true)
								echo "<style type='text/css'>
										#specialCoupon{
											display: table-row;
										}
								</style>"
							
						?>
					</td>
	
					<td>
					
						1
					
					</td>
					<td>
						<?php 
						if($correct == true){
							$sql = "SELECT couponAmount FROM coupon WHERE couponCode='$couponID'";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()) {
								echo $row['couponAmount'];
							}
						}
						else{
							echo 0.00;
						}
						?>
					</td>
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
			
			<?php 
						if($correct == true){
							echo "<script>
							
								var couponBtn = document.getElementById('coupon-btn');
								couponBtn.disabled = true;
							
							</script>";
						}
			?>
		</div>
		
		<div id="none-popup">
		<div id="popup">
		
			<div id="popup-content">
				<span class="popup-close-btn">&times;</span>
				<p id="popup-title"></p>
				
				<form id="couponForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off">
				
				
					<input id="textBox" required type="text" name="couponTextBox"/>
				
				
				<div class="submit-btn" id="couponSubmitBtn">
					<input id="submitBtn" type="submit" value="Submit"/>
				</div>
				
				</form>
				
				
				<div id ="payment-div">
				<div id="popup-RM-textBox">
					<span id="popup-RM-word">RM</span> 
					<input id="payTextBox" required type="text" name="paymentTextBox"/>
				</div>
				
				<div class="submit-btn" id="paymentSubmitBtn">
					<input id="paySubmitBtn" type="submit" value="Submit" onclick="submitOnClick()"/>
				</div>
				</div>
			</div>
			
		</div>
		</div>
	</article>

	</body>