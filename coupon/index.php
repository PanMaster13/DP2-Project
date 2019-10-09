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
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
	?>
		</div>
		
		<div class='coupon-buttons-group'>
			<button class='coupon-buttons' onclick="test()">
				<p>Add Coupon</p>
			</button>
			<button class='coupon-buttons'>
				<p>Edit Coupon</p>
			</button>
			<button class='coupon-buttons'>
				<p>Delete Coupon</p>
			</button>
		</div>
		
	</article>
	
	<footer>
	</footer>
	<script src="couponScript.js"></script>
</body>
</html>