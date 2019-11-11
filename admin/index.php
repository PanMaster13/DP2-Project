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
	session_start(); //needed to get user name
?>
	<header id="header">
		<a href="/"><img id="logo" src='/template/images/logo_white.png' alt='logo'></a>
		<button id='logout-button' onclick="location.href='/logout.php'">
			<i class='material-icons'>lock_open</i>
			Logout
		</button>
	</header>

<script>
var logo = document.getElementById("logo");
var button = document.getElementById("logout-button");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
	
	if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50){
		logo.style.paddingTop = "0%";
		logo.style.paddingBottom = "0%";
		logo.style.width = "150px";
		button.style.marginTop = "0%";
		button.style.marginBottom = "0%";
		button.style.height = "35px";
	} else {
		logo.style.paddingTop = "2%";
		logo.style.paddingBottom = "2%";
		logo.style.width = "300px";
		button.style.marginTop = "2%";
		button.style.marginBottom = "2%";
		button.style.height = "50px";
	}
}
</script>

	<article>
		<h1>Welcome Back <span id="name"><?php echo $_SESSION['userName']; ?>!</span></h1>
		<div id="admin-panel">
			<ul class="panel-selection-container">
				<li class="panel-items color1" onclick="window.location.href='/menu'">
					<i class="fas fa-utensils fa-5x"></i>
					<p class="title">Menu Management</p>
					<p class="description">Add, edit and delete category and item</p>
				</li>
				<li class="panel-items color2" onclick="window.location.href='/table'">
					<i class="fas fa-table fa-5x"></i>
					<p class="title">Table Management</p>
					<p class="description">Add, edit and delete table</p>
				</li>
				<li class="panel-items color3" onclick="window.location.href='/transaction'">
					<i class="fas fa-receipt fa-5x"></i>
					<p class="title">Transaction Management</p>
					<p class="description">Delete, print transaction</p>
				</li>
				<li class="panel-items color4" onclick="window.location.href='/coupon'">
					<i class="fas fa-ticket-alt fa-5x"></i>
					<p class="title">Coupon Management</p>
					<p class="description">Add, edit and delete coupon</p>
				</li>
				<li class="panel-items color5" onclick="window.location.href='/user'">
					<i class="fas fa-user fa-5x"></i>
					<p class="title">User Management</p>
					<p class="description">Add, edit and remove user</p>
				</li>
				<li class="panel-items color6" onclick="window.open('/admin/export.php', '_blank')">
					<i class="fas fa-database fa-5x"></i>
					<p class="title">Export Database</p>
					<p class="description">Export database to sql file</p>
				</li>
			</ul>
		</div>
	</article>
	
	<footer>
	
	</footer>

</body>




</html>