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
	session_start();
?>

	<h1>Transaction History Page</h1>
	
	<article>
		<div id='article-elements'>
			<div id='left-transaction-list'>
			
			<?php
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		//$currentDate = CURDATE();
		if (isset($_POST["date"])){
			$val = $_POST["date"];
			if ($val == "all"){
				$transacQuery = "SELECT * FROM orderlist";
			} else if ($val == "week"){
				$transacQuery = "SELECT * FROM orderlist WHERE orderDate BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()";
			} else if ($val == "month"){
				$transacQuery = "SELECT * FROM orderlist WHERE orderDate BETWEEN  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()";
			} else if ($val == "year"){
				$transacQuery = "SELECT * FROM orderlist WHERE orderDate BETWEEN  DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE()";
			} else {
				$transacQuery = "SELECT * FROM orderlist";
			}
		} else {
			$transacQuery = "SELECT * FROM orderlist";
		}
		
		$transacResult = $conn->query($transacQuery);
		$_SESSION["transaction"] = $transacQuery;
		if($val) $_SESSION["period"] = $val;
		else $_SESSION["period"] = "all";
		// Echos table and values from database	
			
			echo "<table id='transaction-table'>
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
					//if($transacRow['orderStatus']=="Completed")
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
	
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
?>
				
			</div>
			
			
			
		</div>
		
		
	
	<form id="filterForm" action="" method="post">
		<select name="date" onchange="this.form.submit()">
			<option value="-">-</option>
			<option value="all">Show All</option>
			<option value="week">This Week</option>
			<option value="month">This Month</option>
			<option value="year">This Year</option>
		
		</select>
	</form>
	
	<button onclick="window.location.href = 'generatepdf.php';">Generate Report</button>
	
	<script>
		function onClickSubmit(){
			document.getElementById('filterForm').submit();
		}
	</script>



			
	</article>
	
	
	<footer>
		
	</footer>
	
</body>