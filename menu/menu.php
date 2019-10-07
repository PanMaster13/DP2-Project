<!DOCTYPE html>

<html lang="en">

<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="author" content="Low Lip Shen">
	<meta name="description" content="Admin Panel">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="style.css">
<?php
	include ("../template/header.php");
?>
	
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
		
		$sql = "SELECT * FROM menu";
		$result = $conn->query($sql);
		
		// Echos table and values from database
		echo "<div class='dataBox'>";
		echo "<table>";
		echo "<tr>";
		echo "<th>Item ID</th>";
		echo "<th>Category ID</th>";
		echo "<th>Item Name</th>";
		echo "<th>Item Price</th>";
	    echo "</tr>";
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				echo "<tr>";
				echo "<td>" . $row["itemID"] . "</td>";
				echo "<td>" . $row["catID"] . "</td>";
				echo "<td>" . $row["itemName"] . "</td>";
				echo "<td>" . number_format($row["price"], 2) . "</td>";
				echo "</tr>";
			}
		}
		else
		{
			echo "0 results";
		}
		echo "</table>";
		echo "</div>";
		
		// Close connection (although it is done automatically when script ends
		//$conn->close();
	?>
	
	<div class="button_group">
		<div>Add Categories</div>
		<div>Add Items</div>
		<div>Edit Categories</div>
		<div>Edit Items</div>
		<div>Delete Categories</div>
		<div>Delete Items</div>
	</div>
	
	<footer>
	</footer>

</body>




</html>