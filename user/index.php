<!DOCTYPE html>
<html lang="en">

<head>
	<title>User Management</title>
	<meta charset="utf-8">
	<meta name="author" content="Bryan">
	<link rel="stylesheet" href="user_style.css">
	
<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
	session_start();
?>

	<h1>User Management</h1>
	
	<article>
		
		<div class="table-group center-media">
	<?php
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		$query = "SELECT * FROM user";
		$result = $conn->query($query);
		
		echo "<table class='user-list'><tr><th>User ID</th><th>User Name</th><th>User Type</th></tr>";
		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				echo "<tr class='list-items'><td>" . $row["userID"] . "</td><td>" . $row["userName"] . "</td><td>" . $row["userType"] . "</td></tr>";
			}
		}
		else
		{
			echo "0 results";
		}
		echo "</table>";
		mysqli_free_result($result);
		
		// Close connection (although it is done automatically when script ends)
		$conn->close();
	?>
		</div>
		
		<div class='button-group table-buttons-group center-media'>
			<button class='button' onclick="showModal('modal-add-user')">
				<p>Add User</p>
			</button>
			<button id="edit-button" class='button' onclick="showModal('modal-edit-user')" disabled="disabled">
				<p>Edit User</p>
			</button>
			<button id="remove-button" class='button button-red' onclick="showModal('modal-remove-user')" disabled="disabled">
				<p>Remove User</p>
			</button>
		</div>
	</article>
	
	<!-- modal forms -->
	<div id="modal" class="modal">
		<div id='modal-add-user' class="modal-content">
			<h2>Add User</h2>
			<form id='form-add-user' action="user_add.php" method="post">
			
				User Name: <input type="text" name="userName" required="required"/>
				<br/>
				Password: <input type="password" name="password" required="required"/>
				<br/>
				User Type: <select name="userType" required="required">
					<option value="staff">Staff</option>
					<option value="admin">Admin</option>
				</select>
				<br/>
				<button type="submit">Submit</button>
			</form>
		</div>
		
		<div id='modal-edit-user' class="modal-content">
			<h2>Edit User</h2>
			<form id='form-edit-user' action="user_edit.php" method="post">
			
				User ID: <input type="text" name="userID" readonly="readonly"/>
				<br/>
				User Name: <input type="text" name="userName"/>
				<br/>
				Password: <input type="password" name="password" />
				<br/>
				User type: <select name="userType" />
				<option value="staff">Staff</option>
				<option value="admin">Admin</option>
				</select>
				<br/>
				<button type="submit">Submit</button>
			</form>
		</div>
	
		<div id='modal-remove-user' class="modal-content">
			<h2>Delete User</h2>
			<form id="form-remove-user" action="user_remove.php" method="post">
			
				User ID: <input type="text" name="userID" readonly="readonly"/>
				<br/>
				User Name: <input type="text" name="userName" readonly="readonly"/>
				<br/>
				Confirm deletion: <input type="checkbox" required="required"/>
				<br/>
				<button type="submit">Submit</button>
				
			</form>
		</div>
		
	</div>
	<script src="user_script.js"></script>
</body>
</html>