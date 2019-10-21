<?php
// Start the session
session_start();
?>
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
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		$correct = false;
		$orderID = $_REQUEST['orderID'];
		
		
		//check for previous inserted couponID from database
		$sql = "SELECT couponCode FROM orderList WHERE orderID ='$orderID'";
		$result = $conn->query($sql);
		
		while ($coupon = $result->fetch_assoc()){
			if(!is_null($coupon['couponCode'])){
				$couponCode = $coupon['couponCode'];
				$correct = true;
				
				$sql = "SELECT * FROM coupon WHERE couponCode='$couponCode'";
				$result = $conn->query($sql);
				
				while($row = $result->fetch_assoc()) {
					$correctCouponName = $row['couponName'];
				}
			}
		}
		
		
		
		//validate couponID and set it to this order if the couponID is valid and couponSubmitBtn is clicked
		$count = $correctCouponID = $couponID = "";
		if(isset($_POST['couponSubmitBtn'])){
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
				$sql = "UPDATE orderList SET couponCode='$couponCode' WHERE orderID='$orderID'";
				$result = $conn->query($sql);
				$correct = true;
			}
			else{
				echo "Invalid couponID";
				$correct = false;
			}
		}
		
		if(isset($_POST['paymentSubmitBtn'])){
			echo '<style type="text/css">
					#totalAmount, #totalChange{
						display: table-row;
					}
				</style>';
		}
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
					//Display all items from database
				
					$orderID = $_REQUEST['orderID'];
					$query = "SELECT itemList FROM orderList WHERE orderID='". $orderID."' ";
					
					$string = "";
					$string2 = "";
					$itemListarray = array();
					$quantityListarray = array();
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
				

					$query = "SELECT itemQuantity FROM orderList WHERE orderID='". $orderID."' ";
					
					$itemQtyResult = $conn->query($query);
					
					while ($itemQty = $itemQtyResult->fetch_assoc())
					{
						//join all of them into a string instead of an array consisting of just one string
						$string2 = implode("", $itemQty);
					}
					//split them into an array
					$quantityListarray = explode("\n", $string2);
					//trim all the whitespaces to make sure it matches the data in database
					$quantityListarray = array_filter(array_map('trim', $quantityListarray));
				
					mysqli_free_result($itemQtyResult);
					
					
				
				
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
						$quantityListarray[$i] . "</td><td>" . $priceListarray[$i] . "</td></tr>";
					}
				
				?>
				<tr id="specialCoupon">
					<td>
						<?php 
							//Display couponName
						
							echo $correctCouponName;
							
							if($correct)
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
							//Display couponAmount if it is valid
							
							if($correct){
								$sql = "SELECT couponAmount FROM coupon WHERE couponCode='" . $couponCode . "'";
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
					<?php
						//if paymentSubmitBtn is not empty, echo the amount given
						if(isset($_POST['paymentSubmitBtn'])){
							echo "<td>" . $_POST['paymentTextBox'] . "</td>";
						}
					?>
				</tr>
				<tr id="totalChange">
					<td>Change:</td>
					<td></td>
					<td>
					</td>
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
				//If coupon valid, below javascript codes are used
				
				if($correct){
					echo "<script>
					
						var couponBtn = document.getElementById('coupon-btn');
						couponBtn.disabled = true;
					
					</script>";
				}
				
				//If paymentSubmitBtn is not empty, below javascript codes are used
				
				if(isset($_POST['paymentSubmitBtn'])){
					echo "<script>
					
						var couponBtn = document.getElementById('coupon-btn');
						var payBtn = document.getElementById('pay-btn');
						couponBtn.disabled = true;
						payBtn.disabled = true;
					
					</script>";
				}
			?>
		</div>
		
		<div id="none-popup">
		<div id="popup">
		
			<div id="popup-content">
				<span class="popup-close-btn">&times;</span>
				<p id="popup-title"></p>
				
				<form id="couponForm" action="" method="post" autocomplete="off">
				
				
					<input id="textBox" required type="text" name="couponTextBox"/>
				
				
				<div class="submit-btn" id="couponSubmitBtn">
					<input id="submitBtn" type="submit" value="Submit" name="couponSubmitBtn"/>
				</div>
				
				</form>
				
				
				<div id ="payment-div">
				<form id="paymentForm" action="" method="post" autocomplete="off">
					<div id="popup-RM-textBox">
						<span id="popup-RM-word">RM</span> 
						<input id="payTextBox" required type="text" name="paymentTextBox"/>
						<input id="hidden" type="hidden" name="result"/>
					</div>
				
					<div class="submit-btn" id="paymentSubmitBtn">
						<input id="paySubmitBtn" type="submit" value="Submit" name="paymentSubmitBtn"/>
					</div>
				</form>
				</div>
			</div>
			
			
				<?php
					//call calculateTotalPrice function to calculate totalPrice
					echo "<script>calculateTotalPrice();</script>";
				
					//if paymentSubmitBtn is pressed, we trigger the javascript codes below, 
					//set the totalPrice and also update the orderStatus to database
					if(isset($_POST['paymentSubmitBtn'])){
						$totalPrice = $_POST['result'];
						
						echo "<script>
								var totalPrice = document.getElementById('totalPrice');
	
								var totalChange = document.getElementById('totalChange');
								
								var totalAmount = document.getElementById('totalAmount');
								
								var finalChange = totalAmount.children[2].innerHTML - parseFloat(totalPrice.children[2].innerHTML);
								
								totalChange.children[2].innerHTML = parseFloat(finalChange).toFixed(2);
								console.log(totalPrice.children[2].innerHTML);
								console.log(totalAmount.children[2].innerHTML);
								console.log(totalChange.children[2].innerHTML);
							</script>";
							
						$sql = "UPDATE orderList SET totalPrice='$totalPrice' WHERE orderID='$orderID'";
						$result = $conn->query($sql);
						
						
						$query = "UPDATE orderList SET orderStatus = 'Completed' WHERE orderID='$orderID'";
						$result = $conn->query($query);
					}
				?>
			
		</div>
		</div>
	</article>

</body>