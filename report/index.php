<!DOCTYPE html>

<html lang="en">

<head>
	<title>Report</title>
	<meta charset="utf-8">
	<meta name="author" content="Caleb Teng">
	<meta name="description" content="Report Management">
	<meta name="keywords" content="Report, Management">

	<link rel="stylesheet" href="report_style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>

	<script src="script.js"></script>

<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
?>
	
	
<article>
	
		<h1>Report</h1>
		<div id='article-elements'>
			<div id='left-report-list'>
			
		<?php
		//include database connection
		//the connection variable is $conn
		include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
		
		$reportQuery = "SELECT * FROM report";
		$reportResult = $conn->query($reportQuery);
		
		
		{
			$reportQuery = "SELECT * FROM report";
			$reportResult = $conn->query($reportQuery);
			
			// Echos table and values from database
			
			echo "<table id='report-table'>
					<tr>
						<th>Report ID</th>
						<th>Report Date</th>
						<th>Order Amount</th>
						<th>Profit</th>
					</tr>";
			if ($reportResult->num_rows > 0)
			{
				while($reportRow = $reportResult->fetch_assoc())
				{
					echo 
					"<tr'>
					<td>" . $reportRow['reportID'] . "</td>
					<td>" . $reportRow['reportDate']."</td>
					<td>" . $reportRow['orderAmount'] . "</td>	
					<td>" . $reportRow['profit'] . "</td>
					</tr>";
					
					
				}
			}
			else
			{
				echo "0 results";
			}
			echo "</table>";
			mysqli_free_result($reportResult);
		}
	
		
		// Close connection (although it is done automatically when script ends
		$conn->close();
?>
			</div>
			<div id='right-btns'>
				<button id='add-report-button'>
					<p>Add</p>
				</button>
				<button id='edit-report-button'>
					<p>Edit</p>
				</button>
				
			</div>
		</div>
	</article>
	
		<!--<div id="add-report-form">
			<h2>Add new Report</h2>
			<form action="add-report.php" method="post">
				<p>Enter Report ID: <input type="text" name="add_report_id" required="required"></p>
				<p>Enter Report date: <input type="number" name="add_report_date" ></p>
				<p>Enter Order Amount: <input type="number" name="add_order_amount" ></p>
				<p>Enter Amount of Profit: <input type="text" name="add_profit" required="required"></p>
				<p><input type="submit" name="add_report_btn"></p>
			</form>
		</div>
		
		<div id="edit-report-form">
			<h2>Edit a Report</h2>
			<form action="add-report.php" method="post">
				<p>Enter new Report ID: <input type="text" name="edit_report_id" required="required"></p>
				<p>Enter new Report date: <input type="number" name="edit_report_date" ></p>
				<p>Enter Order Amount: <input type="number" name="edit_order_amount" ></p>
				<p>Enter new Amount of Profit: <input type="text" name="edit_profit" required="required"></p>
				<p><input type="submit" name="edit_report_btn"></p>
			</form>
		</div>-->
	
	<footer>
		
	</footer>
	
</body>