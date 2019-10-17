<!DOCTYPE html>

<html lang="en">

<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="author" content="Low Lip Shen">
	<meta name="description" content="Admin Panel">
	<meta name="keywords" content="">

	<link rel="stylesheet" href="admin_style.css">
	<script src="https://kit.fontawesome.com/335541e0f5.js" crossorigin="anonymous"></script>

<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/template/header.php");
?>
	
	<article>
		<h1>Welcome Back <span id="name">Chris!</span></h1>
		<div id="admin-panel">
			<ul class="panel-selection-container">
				<li class="panel-items color1" onclick="window.location.href='/menu'">
					<i class="fas fa-utensils fa-5x"></i>
					<p>Menu Management</p>
				</li>
				<li class="panel-items color2" onclick="window.location.href='/table'">
					<i class="fas fa-table fa-5x"></i>
					<p>Table Management</p>
				</li>
				<li class="panel-items color3" onclick="window.location.href='/transaction'">
					<i class="fas fa-receipt fa-5x"></i>
					<p>Transaction Management</p>
				</li>
				<li class="panel-items color4" onclick="window.location.href='/report'">
					<i class="fas fa-clipboard-list fa-5x"></i>
					<p>Report Management</p>
				</li>
				<li class="panel-items color5" onclick="window.location.href='/coupon'">
					<i class="fas fa-ticket-alt fa-5x"></i>
					<p>Coupon Management</p>
				</li>
				<li class="panel-items color6" onclick="window.open('/admin/export.php', '_blank')">
					<i class="fas fa-database fa-5x"></i>
					<p>Export Database</p>
				</li>
			</ul>
		</div>
	</article>
	
	<footer>
	
	</footer>

</body>




</html>