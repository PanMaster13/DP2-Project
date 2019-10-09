<!DOCTYPE html>

<html lang="en">

<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="author" content="Jason">
	
	<link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>
	
<?php
	include ("../template/header.php");
?>
	
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
		$index = 1;
		$categoryQuery = "SELECT * FROM category";
		$categoryResult = $conn->query($categoryQuery);
		
		while ($categoryRow = $categoryResult->fetch_assoc())
		{
			$menuQuery = "SELECT * FROM menu WHERE catID = $index";
			$menuResult = $conn->query($menuQuery);
			
			// Echos table and values from database
			echo "<h1>" . $categoryRow["catName"] . "</h1>";
			echo "<table><tr><th>Item ID</th><th>Item Name</th><th>Item Price</th></tr>";
			if ($menuResult->num_rows > 0)
			{
				while($menuRow = $menuResult->fetch_assoc())
				{
					echo "<tr class='list-items'><td>" . $menuRow["itemID"] . "</td><td>" . $menuRow["itemName"] . "</td><td>" . number_format($menuRow["price"], 2) . "</td></tr>";
				}
			}
			else
			{
				echo "0 results";
			}
			echo "</table>";
			$index++;
			mysqli_free_result($menuResult);
		}
		mysqli_free_result($categoryResult);
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
	?>
		</div>
	
		<div class='menu-buttons-group'>
			<button class='menu-buttons'>
				<p>Add Categories</p>
			</button>
			<button class='menu-buttons'>
				<p>Add Items</p>
			</button>
			<button class='menu-buttons'>
				<p>Edit Categories</p>
			</button>
			<button class='menu-buttons'>
				<p>Edit Items</p>
			</button>
			<button class='menu-buttons'>
				<p>Delete Categories</p>
			</button>
			<button class='menu-buttons'>
				<p>Delete Items</p>
			</button>
		</div>
	</article>
	
	<footer>
	</footer>

</body>




</html>