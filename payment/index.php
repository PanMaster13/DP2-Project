<!DOCTYPE html>

<html lang="en">

<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="author" content="Low Lip Shen">
	<meta name="description" content="Admin Panel">
	<meta name="keywords" content="">

	<link rel="stylesheet" href="payment_style.css">

	<script src="payment_script.js"></script>
	
<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
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
			$couponCode = $_POST['couponTextBox'];
			$correctCouponName = "";
			$correct = false;
			
			$sql = "SELECT * FROM coupon WHERE couponCode='$couponCode'";
			$result = $conn->query($sql);
			$count = mysqli_num_rows($result);
			
			if($count == 1){
				while($row = $result->fetch_assoc()) {
					$correctCouponName = $row['couponName'];
				}
				$correct = true;
			}
			else{
				echo "Invalid couponID";
				$correct = false;
			}
		}

		// Close connection (although it is done automatically when script ends
		// $conn->close();
	?>	
	
		<h1>Payment</h1>
		<div id="article-elements">
			<table id="payment-table">
				<tr>
					<th>Items</th>
					<th>Qty</th>
					<th>Price</th>
				</tr>
				<?php
					$orderID = $_REQUEST['orderID'];
					$query = "SELECT itemList FROM orderList WHERE orderID='". $orderID."' ";
					
					$string = "";
					$itemListarray = array();
					$priceListarray = array();
				
					$itemListResult = $conn->query($query);
				
					while ($itemList = $itemListResult->fetch_assoc())
					{
						//join all of them into a string instead of an array consisting of just one string
						$string = implode("", $itemList);
					}
					//split them into an array
					$itemListarray = explode("\n", $string);
					//trim all the whitespaces to make sure it matches the data in database
					$itemListarray = array_filter(array_map('trim', $itemListarray));
				
					mysqli_free_result($itemListResult);
				
					for( $i = 0; $i < sizeof($itemListarray); $i++){
						$query = "SELECT itemPrice FROM menu WHERE itemName='" . $itemListarray[$i] . "' ";
						$itemPriceResult = $conn->query($query);
						
						$result = $conn->query($query);
						
						while ($priceList = $itemPriceResult->fetch_assoc())
						{
							//push the value to an array
							array_push($priceListarray , implode(" ", $priceList));
						}
					}
					
					mysqli_free_result($itemPriceResult);
				
				
					//display all the relevant data to table
					for($i = 0; $i < sizeof($itemListarray); $i++){
						echo "<tr class='list-items'><td>" . $itemListarray[$i] . "</td><td>" . 
						"1" . "</td><td>" . $priceListarray[$i] . "</td></tr>";
					}
				
				?>
				<tr id="specialCoupon">
					<td>
						<?php 
							echo $correctCouponName;
							
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
							$sql = "SELECT couponAmount FROM coupon WHERE couponCode='$couponCode'";
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
				<button id='cancel-btn' onclick="window.location.href='/orders'">
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
				
				<form id="couponForm" action="#" method="post" autocomplete="off">
				
				
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