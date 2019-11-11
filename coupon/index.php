<?php 
	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Coupon Management Page</title>
	<meta charset="utf-8">
	<meta name="author" content="Jason">
	<link rel="stylesheet" href="coupon_style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>
	
<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
?>

	<h1>Coupon Management Page</h1>
	<article>
		
		<div class="table-group center-media">
	<?php
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
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
		
		<div class='table-buttons-group button-group'>
			<button class='button' onclick="showModal('modal-add-coupon')">
				<p>Add Coupon</p>
			</button>
			<button id="edit-button" class='button' onclick="showModal('modal-edit-coupon')" disabled="disabled">
				<p>Edit Coupon</p>
			</button>
			<button id="remove-button" class='red-button-active button button-red' onclick="showModal('modal-delete-coupon')" disabled="disabled">
				<p>Delete Coupon</p>
			</button>
		</div>
	</article>
	
	<div id="modal" class="modal">
		<div id='modal-add-coupon' class="modal-content">
			<h2>Add a Coupon</h2>
			<form id="form-add-coupon" action="coupon_add.php" method="post">
				<p>Enter coupon code*: <input type="text" name="add_code" required="required"></p>
				<p>Enter coupon name*: <input type="text" name="add_name" required="required" size="60"></p>
				<p>Enter coupon discount amount*: <input type="text" name="add_amount" required="required" placeholder="Please input numbers only"></p>
				<p><input type="submit" name="add_submit_btn"></p>
			</form>
		</div>
	
		<div id='modal-edit-coupon' class="modal-content">
			<h2>Edit a Coupon</h2>
			<form id="form-edit-coupon" action="coupon_edit.php" method="post">
				<input type="hidden" name="edit_code">
				<p>Enter new coupon code: <input type="text" name="couponCode"></p>
				<p>Enter new coupon name: <input type="text" name="couponName" size="60"></p>
				<p>Enter new coupon discount amount: <input type="text" name="couponAmount"></p>
				<p><input type="submit" name="edit_submit_btn"></p>
			</form>
		</div>
	
		<div id='modal-delete-coupon' class="modal-content">
			<h2>Delete a Coupon</h2>
			<form id="form-delete-coupon" action="coupon_delete.php" method="post">
				<p>Code of coupon to be deleted: <input type="text" name="delete_code" readonly="readonly"></p>
				<p><input type="submit" name="delete_submit_btn" value="Confirm Deletion?"></p>
			</form>
		</div>
	</div>
	
	<?php 
			if (isset($_SESSION["feedback"])){
				echo "<p id='feedback-msg'>Feedback from server of previous query: " . $_SESSION["feedback"] . "</p>";
			}
		?>
	
	<footer>
	</footer>
	<script src="coupon_script.js"></script>
</body>
</html>