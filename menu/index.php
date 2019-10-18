<!DOCTYPE html>

<html lang="en">

<head>
	<title>Menu Management Page</title>
	<meta charset="utf-8">
	<meta name="author" content="Jason">
	
	<link rel="stylesheet" href="menu_style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>
	
<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
?>
	<h1>Menu Mangement Page</h1>
	<article>
		
		<div class="table-group">
	<?php
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	
		$index = 1;
		$categoryQuery = "SELECT * FROM category";
		$categoryResult = $conn->query($categoryQuery);
		
		while ($categoryRow = $categoryResult->fetch_assoc())
		{
			$menuQuery = "SELECT * FROM menu WHERE categoryID = $index";
			$menuResult = $conn->query($menuQuery);
			
			// Echos table and values from database
			echo "<h2>" . $categoryRow["categoryName"] . "</h2>";
			echo "<table class='theTables'><tr><th>Item Name</th><th>Item Price</th></tr>";
			if ($menuResult->num_rows > 0)
			{
				while($menuRow = $menuResult->fetch_assoc())
				{
					echo "<tr class='list-items'><td>" . $menuRow["itemName"] . "</td><td>" . number_format($menuRow["itemPrice"], 2) . "</td></tr>";
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
	<script src="menu_script.js"></script>
</body>




</html>