<?php 
	session_start();
 ?>

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
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
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
			<button class='table-buttons' onclick="showModal('modal-add-table')">
				<p>Add Table</p>
			</button>
			<button id="edit-button" class='table-buttons' onclick="showModal('modal-edit-table')" disabled="disabled">
				<p>Edit Table</p>
			</button>
			<button id="remove-button" class='table-buttons' onclick="showModal('modal-delete-table')" disabled="disabled">
				<p>Delete Table</p>
			</button>
		</div>
	</article>
	
	<div id="modal" class="modal">
		<div id="modal-add-table" class="modal-content">
			<h2>Add a Table</h2>
			<p>Note: The 'Table Number' value is auto generated, so there's no need for you to input anything.</p>
			<form id="form-add-table" action="table_add.php" method="post">
				<p>Enter table seats*: <input type="text" name="add_seats" required="required" placeholder="Please input integer values only" size="30"></p>
				<p>Select table status: 
					<select name="add_status">
						<option value="Occupied">Occupied</option>
						<option value="Vacant">Vacant</option>
						<option value="Unavailable">Unavailable</option>
						<option value="Booked">Booked</option>
					</select>
				</p>
				<p><input type="submit" name="add_submit_btn"></p>
			</form>
		</div>
		
		<div id="modal-edit-table" class="modal-content">
			<h2>Edit a Table</h2>
			<form id="form-edit-table" action="table_edit.php" method="post">
				<p>Enter new table number: <input type="text" name="tableID"></p>
				<p>Enter new table seats amount: <input type="text" name="tableSeats"></p>
				<p>Select new table status:
					<select name="tableStatus">
						<option value="Occupied">Occupied</option>
						<option value="Vacant">Vacant</option>
						<option value="Unavailable">Unavailable</option>
						<option value="Booked">Booked</option>
					</select>
				</p>
				<p><input type="submit" name="edit_submit_btn"></p>
			</form>
		</div>
		
		<div id="modal-delete-table" class="modal-content">
			<h2>Delete a Table</h2>
			<form id="form-delete-table" action="table_delete.php" method="post">
				<p>Table number to be deleted: <input type="text" name="delete_number" readonly="readonly"></p>
				<p><input type="submit" name="delete_submit_btn"></p>
			</form>
		</div>
		<?php
			if (isset($_SESSION["tableMsg"])){
				echo "<p id='feedback-msg'>" . $_SESSION["tableMsg"] . "</p>";
			}
		?>
	</div>
	
	<footer>
	</footer>
	<script src="table_script.js"></script>
</body>
</html>