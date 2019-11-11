<?php 
	session_start();
 ?>
 
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
	
		$categoryQuery = "SELECT * FROM category";
		$categoryResult = $conn->query($categoryQuery);
		$tableIndex = 0;
		
		while ($categoryRow = $categoryResult->fetch_assoc())
		{
			$menuQuery = "SELECT * FROM menu WHERE categoryID = " . $categoryRow["categoryID"];
			$menuResult = $conn->query($menuQuery);
			
			// Echos table and values from database
			printf('<div class="catTitleBox"><h2 id="%s" class="catTitles" onclick="categoryClicked(\'%s\', \'%s\')">%s (%s)</h2></div>', $categoryRow["categoryName"], $categoryRow["categoryName"], $categoryRow["categoryID"], $categoryRow["categoryName"], $categoryRow["categoryID"]);
			if ($menuResult->num_rows > 0)
			{
				printf('<button class="tableBtn button-cyan" onclick="showHideTable(\'%s\')">Show / Hide Table</button>', $tableIndex);
				echo "<table class='theTables' style='display:none'><tr><th>Item Name</th><th>Item Price</th></tr>";
				
				while($menuRow = $menuResult->fetch_assoc())
				{
					echo "<tr class='list-items'><td>" . $menuRow["itemName"] . "</td><td>" . number_format($menuRow["itemPrice"], 2) . "</td></tr>";
				}
				
				echo "</table>";
			}
			else
			{
				echo "<p>No results for the " . $categoryRow["categoryName"] . " (Identifier: " . $categoryRow["categoryID"] .  ") category.</p>";
			}
			mysqli_free_result($menuResult);
			$tableIndex++;
		}
		mysqli_free_result($categoryResult);
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
	?>
		</div>
	
		<div class='button-group'>
			<button class='menu-buttons' onclick="showModal('modal-add-category')">
				<p>Add Category</p>
			</button>
			<button class='menu-buttons' onclick="showModal('modal-add-item')">
				<p>Add Item</p>
			</button>
			<button id="edit-cat-btn" class='' onclick="showModal('modal-edit-category')" disabled="disabled">
				<p>Edit Category</p>
			</button>
			<button id="edit-item-btn" class='' onclick="showModal('modal-edit-item')" disabled="disabled">
				<p>Edit Item</p>
			</button>
			<button id="delete-cat-btn" class=' button-red' onclick="showModal('modal-delete-category')" disabled="disabled">
				<p>Delete Category</p>
			</button>
			<button id="delete-item-btn" class=' button-red' onclick="showModal('modal-delete-item')" disabled="disabled">
				<p>Delete Item</p>
			</button>
		</div>
	</article>
	
	<div id="modal" class="modal">
		<div id="modal-add-category" class="modal-content">
			<h2>Add a Category</h2>
			<p>Note: The 'Identifier' value is auto generated, so there's no need for you to input anything.</p>
			<form id="form-add-category" action="category_add.php" method="post">
				<p>Enter category name*: <input type="text" name="add_category_name" required="required"></p>
				<p><input type="submit" name="add_cat_btn"></p>
			</form>
		</div>
		
		<div id="modal-add-item" class="modal-content">
			<h2>Add an Item</h2>
			<form id="form-add-item" action="item_add.php" method="post">
				<p>Enter item name*: <input type="text" name="add_item_name" required="required"></p>
				<p>Select category (use identifier): <input type="number" name="add_item_cat" min="1" value="1"></p>
				<p>Enter item price*: <input type="text" name="add_item_price" required="required"></p>
				<p><input type="submit" name="add_item_btn"></p>
			</form>
		</div>
		
		<div id="modal-edit-category" class="modal-content">
			<h2>Edit a Category</h2>
			<p>Note: Please ensure that the desired category to be edited does not have any items before you edit it.</p>
			<form id="form-edit-category" action="category_edit.php" method="post">
				<input type="hidden" name="edit_category">
				<p>Enter new category identifier: <input type="number" name="categoryID" min="1" value="1" placeholder="Leave it empty if no change is needed"></p>
				<p>Enter new category name: <input type="text" name="categoryName" placeholder="Leave it empty if no change is needed" size="30"></p>
				<p><input type="submit" name="edit_cat_btn"></p>
			</form>
		</div>
		
		<div id="modal-edit-item" class="modal-content">
			<h2>Edit an Item</h2>
			<form id="form-edit-item" action="item_edit.php" method="post">
				<input type="hidden" name="edit_item">
				<p>Enter new item name: <input type="text" name="itemName"></p>
				<p>Select new category: <input type="number" name="categoryID" min="1" value="1" placeholder="Leave it empty if no change is needed"></p>
				<p>Enter new item price: <input type="text" name="itemPrice"></p>
				<p><input type="submit" name="edit_item_btn"></p>
			</form>
		</div>
		
		<div id="modal-delete-category" class="modal-content">
			<h2>Delete a Category</h2>
			<p>Note: Please ensure that the desired category to be deleted does not have any items before you delete it.</p>
			<form id="form-delete-category" action="category_delete.php" method="post">
				<p>Category Identifier to be deleted*: <input type="number" name="delete_category" min="1" value="1"></p>
				<p><input type="submit" name="delete_cat_btn"></p>
			</form>
		</div>
		
		<div id="modal-delete-item" class="modal-content">
			<h2>Delete an Item</h2>
			<form id="form-delete-item" action="item_delete.php" method="post">
				<p>Item Name to be deleted*: <input type="text" name="delete_item" readonly="readonly"></p>
				<p><input type="submit" name="delete_item_btn"></p>
			</form>
		</div>
	</div>
	
	<?php
			if (isset($_SESSION["menuMsg"])){
				echo "<p id='feedback-msg'>Feedback from server of previous query: " . $_SESSION["menuMsg"] . "</p>";
			}
		?>
	
	<footer>
	</footer>
	<script src="menu_script.js"></script>
</body>




</html>