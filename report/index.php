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
				<table id="report-table">
					<tr>
						<th>Report ID</th>
						<th>Report Date</th>
						<th>Profit</th>
					</tr>
					<tr class="list-items">
						<td>123456789</td>
						<td>10/10/2019</td>
						<td>RMxxx</td>
					</tr>
					<tr class="list-items">
						<td>987654321</td>
						<td>11/10/2019</td>
						<td>RMxxx</td>
					</tr>
					
				</table>
			</div>
			<div id='right-btns'>
				<button id='add-button'>
					<p>Add</p>
				</button>
				<button id='edit-button'>
					<p>Edit</p>
				</button>
				
			</div>
		</div>
	</article>
	
	<footer>
		
	</footer>
	
</body>