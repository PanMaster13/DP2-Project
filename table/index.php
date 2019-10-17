<!DOCTYPE html>

<html lang="en">

<head>
	<title>Table Management Page</title>
	<meta charset="utf-8">
	<meta name="author" content="Jason">
	
	<link rel="stylesheet" href="table_style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>
	
<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
?>

	<h1>Table Management Page</h1>
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
		
		$tableQuery = "SELECT * FROM tables";
		$tableResult = $conn->query($tableQuery);
		
		echo "<table class='theTables'><tr><th>Table Number</th><th>Table Seats</th><th>Table Status</th></tr>";
		if ($tableResult->num_rows > 0)
		{
			while ($tableRow = $tableResult->fetch_assoc())
			{
				echo "<tr class='list-items'><td>" . $tableRow["tableID"] . "</td><td>" . $tableRow["tableSeats"] . "</td><td>" . $tableRow["tableStatus"] . "</td></tr>";
			}
		}
		else
		{
			echo "0 results";
		}
		echo "</table>";
		mysqli_free_result($tableResult);
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
	?>
		</div>
		<div class="table-buttons-group">
			<button class='table-buttons'>
				<p>Add Table</p>
			</button>
			<button class='table-buttons'>
				<p>Edit Table</p>
			</button>
			<button class='table-buttons'>
				<p>Delete Table</p>
			</button>
		</div>
	</article>
	
	<footer>
	
	</footer>
	<script src="table_script.js"></script>
</body>
</html>