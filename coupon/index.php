<?php 
	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Coupon Management Page</title>
	<meta charset="utf-8">
	<meta name="author" content="Jason">
	<link rel="stylesheet" href="couponStyle.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>
	
<?php
	include ("../template/header.php");
?>

	<h1>Coupon Management Page</h1>
	<article>
		
		<div class="table-group">
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
		
		$couponQuery = "SELECT * FROM coupon";
		$couponResult = $conn->query($couponQuery);
		
		echo "<table class='theTables'><tr><th>Coupon Code</th><th>Coupon Name</th><th>Coupon Discount Amount</th></tr>";
		if ($couponResult->num_rows > 0)
		{
			while ($couponRow = $couponResult->fetch_assoc())
			{
				echo "<tr class='list-items'><td>" . $couponRow["couponCode"] . "</td><td>" . $couponRow["couponName"] . "</td><td>" . number_format($couponRow["couponAmount"], 2) . "</td></tr>";
			}
		}
		else
		{
			echo "0 results";
		}
		echo "</table>";
		mysqli_free_result($couponResult);
		
		// Close connection (although it is done automatically when script ends)
		$conn->close();
	?>
		</div>
		
		<div class='coupon-buttons-group'>
			<button class='coupon-buttons' onclick="showAddCoupon()">
				<p>Add Coupon</p>
			</button>
			<button class='coupon-buttons' onclick="showEditCoupon()">
				<p>Edit Coupon</p>
			</button>
			<button class='coupon-buttons' onclick="showDeleteCoupon()">
				<p>Delete Coupon</p>
			</button>
		</div>
	</article>
	
	<div class="coupon-forms">
		<div id='add-coupon-form'>
			<h2>Add a Coupon</h2>
			<form action="addCouponProcess.php" method="post">
				<p>Enter coupon code*: <input type="text" name="add_code" required="required"></p>
				<p>Enter coupon name*: <input type="text" name="add_name" required="required"></p>
				<p>Enter coupon discount amount*: <input type="text" name="add_amount" required="required" placeholder="Please input numbers only"></p>
				<p><input type="submit" name="add_submit_btn"></p>
			</form>
		</div>
	
		<div id='edit-coupon-form'>
			<h2>Edit a Coupon</h2>
			<form action="editCouponProcess.php" method="post">
				<p>Enter coupon code to be edited*: <input type="text" name="edit_code" required="required"></p>
				<p>Enter new coupon code: <input type="text" name="couponCode" placeholder="Leave it empty if no change is needed" size="30"></p>
				<p>Enter new coupon name: <input type="text" name="couponName" placeholder="Leave it empty if no change is needed" size="30"></p>
				<p>Enter new coupon discount amount: <input type="text" name="couponAmount" placeholder="Leave it empty if no change is needed" size="30"></p>
				<p><input type="submit" name="edit_submit_btn"></p>
			</form>
		</div>
	
		<div id='delete-coupon-form'>
			<h2>Delete a Coupon</h2>
			<form action="deleteCouponProcess.php" method="post">
				<p>Enter coupon code to be deleted*: <input type="text" name="delete_code" required="required"></p>
				<p><input type="submit" name="delete_submit_btn"></p>
			</form>
		</div>
		
		<?php 
			if (isset($_SESSION["feedback"])){
				echo "<p>" . $_SESSION["feedback"] . "</p>";
			}
		?>
	</div>
	
	<footer>
	</footer>
	<script src="couponScript.js"></script>
</body>
</html>