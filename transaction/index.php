<!DOCTYPE html>

<html lang="en">

<head>
	<title>Transaction</title>
	<meta charset="utf-8">
	<meta name="author" content="Caleb Teng">
	<meta name="description" content="Transaction Management">
	<meta name="keywords" content="Transaction, Management">

	<link rel="stylesheet" href="transaction_style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>

	<script src="transaction_script.js"></script>

<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
?>
	<h1>Table Management Page</h1>
	
	<article>
		<div id="article-elements">
			
			<?php
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		$transacQuery = "SELECT * FROM orderlist";
		$transacResult = $conn->query($transacQuery);
		
		
		{
			$transacQuery = "SELECT * FROM orderlist";
			$transacResult = $conn->query($transacQuery);
			
			// Echos table and values from database
			
			echo "<table id='transaction-table'  class='table-group center-media'>
					<tr>
						<th>Order ID</th>
						<th>Order Status</th>
						<th>Order Price</th>
						<th>Item List</th>
						<th>Table ID</th>
						<th>Order Date</th>
					
					</tr>";
			if ($transacResult->num_rows > 0)
			{
				while($transacRow = $transacResult->fetch_assoc())
				{
					if($transacRow['orderStatus']=="Completed")
					echo 
					"<tr'>
					<td>" . $transacRow['orderID'] . "</td>
					<td>" . $transacRow['orderStatus']."</td>
					<td>" . $transacRow['totalPrice'] . "</td>
					<td>" . nl2br($transacRow['itemList']) . "</td>	
					<td>" . $transacRow['tableID'] . "</td>	
					<td>" . $transacRow['orderDate'] . "</td>						
					
					</tr>";
					
					
				}
			}
			else
			{
				echo "0 results";
			}
			echo "</table>";
			mysqli_free_result($transacResult);
		}
	
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
?>
				
			<div class="table-buttons-group button-group">
				<button id='delete-button' class="button-red red-button-active">
					<p>Delete</p>
				</button>
				
			</div>
			</div>
		
		<div class="dropdown">
		<button onclick="dropdownFunction()" class="dropbtn">Check Transaction</button>
		<div id="Dropdownfunc" class="dropdown-content">
			<a href="#Daily">Daily</a>
			<a href="#Weekly">Weekly</a>
			<a href="#Monthly">Monthly</a>
		</div>
	</div>
	</article>
	
	
	<footer>
		
	</footer>
	
</body>