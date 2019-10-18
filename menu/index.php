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
		
		while ($categoryRow = $categoryResult->fetch_assoc())
		{
			$menuQuery = "SELECT * FROM menu WHERE categoryID = " . $categoryRow["categoryID"];
			$menuResult = $conn->query($menuQuery);
			
			if ($menuResult->num_rows > 0)
			{
				// Echos table and values from database
				echo "<h2>" . $categoryRow["categoryName"] . " (Identifier: " . $categoryRow["categoryID"] .  ")</h2>";
				echo "<table class='theTables'><tr><th>Item Name</th><th>Item Price</th></tr>";
				
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
		}
		mysqli_free_result($categoryResult);
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
	?>
		</div>
	
		<div class='menu-buttons-group'>
			<button class='menu-buttons' onclick="showAddCategory()">
				<p>Add Category</p>
			</button>
			<button class='menu-buttons' onclick="showAddItem()">
				<p>Add Item</p>
			</button>
			<button class='menu-buttons' onclick="showEditCategory()">
				<p>Edit Category</p>
			</button>
			<button class='menu-buttons' onclick="showEditItem()">
				<p>Edit Item</p>
			</button>
			<button class='menu-buttons' onclick="showDeleteCategory()">
				<p>Delete Category</p>
			</button>
			<button class='menu-buttons' onclick="showDeleteItem()">
				<p>Delete Item</p>
			</button>
		</div>
	</article>
	
	<div class="menu-forms">
		<div id="add-category-form">
			<h2>Add a Category</h2>
			<p>Note: The 'Identifier' value is auto generated, so there's no need for you to input anything.</p>
			<form action="category_add.php" method="post">
				<p>Enter category name*: <input type="text" name="add_category_name" required="required"></p>
				<p><input type="submit" name="add_cat_btn"></p>
			</form>
		</div>
		
		<div id="add-item-form">
			<h2>Add an Item</h2>
			<form action="item_add.php" method="post">
				<p>Enter item name*: <input type="text" name="add_item_name" required="required"></p>
				<p>Select category (use identifier): <input type="number" name="add_item_cat" min="1" value="1"></p>
				<p>Enter item price*: <input type="text" name="add_item_price" required="required"></p>
				<p><input type="submit" name="add_item_btn"></p>
			</form>
		</div>
		
		<div id="edit-category-form">
			<h2>Edit a Category</h2>
			<p>Note: Please ensure that the desired category to be edited does not have any items before you edit it.</p>
			<form action="category_edit.php" method="post">
				<p>Enter category identifier to be edited*: <input type="text" name="edit_category" required="required"></p>
				<p>Enter new category identifier: <input type="number" name="categoryID" min="1" value="1" placeholder="Leave it empty if no change is needed"></p>
				<p>Enter new category name: <input type="text" name="categoryName" placeholder="Leave it empty if no change is needed" size="30"></p>
				<p><input type="submit" name="edit_cat_btn"></p>
			</form>
		</div>
		
		<div id="edit-item-form">
			<h2>Edit an Item</h2>
			<form action="item_edit.php" method="post">
				<p>Enter item name to be edited*: <input type="text" name="edit_item" required="required"></p>
				<p>Enter new item name: <input type="text" name="itemName" placeholder="Leave it empty if no change is needed"  size="30"></p>
				<p>Select new category: <input type="number" name="categoryID" min="1" value="1" placeholder="Leave it empty if no change is needed"></p>
				<p>Enter new item price: <input type="text" name="itemPrice" placeholder="Leave it empty if no change is needed"  size="30"></p>
				<p><input type="submit" name="edit_item_btn"></p>
			</form>
		</div>
		
		<div id="delete-category-form">
			<h2>Delete a Category</h2>
			<p>Note: Please ensure that the desired category to be deleted does not have any items before you delete it.</p>
			<form action="category_delete.php" method="post">
				<p>Enter category identifier to be deleted*: <input type="number" name="delete_category" min="1" value="1"></p>
				<p><input type="submit" name="delete_cat_btn"></p>
			</form>
		</div>
		
		<div id="delete-item-form">
			<h2>Delete an Item</h2>
			<form action="item_delete.php" method="post">
				<p>Enter item name to be deleted*: <input type="text" name="delete_item" required="required"></p>
				<p><input type="submit" name="delete_item_btn"></p>
			</form>
		</div>
		<?php
			if (isset($_SESSION["menuMsg"])){
				echo "<p id='feedback-msg'>" . $_SESSION["menuMsg"] . "</p>";
			}
		?>
	</div>
	
	<footer>
	</footer>
	<script src="menu_script.js"></script>
</body>




</html>