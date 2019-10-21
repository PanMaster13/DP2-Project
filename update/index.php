<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
</head>

<body>

<?php
include $_SERVER["DOCUMENT_ROOT"].'/template/header.php';
?>
<!-- Set page title-->
<script>
	document.title = "Update | FoodSmithPOS";
</script>

<div >
	<h1> Update webpages from github repo </h1>
	<p> Note: This is for updating the latest changes from the github repository, the underlying script is written in bash. 
	</br>
	Press the button below or refresh to update.
	</p>
	<button type="button" onclick="updatePage()">Update</button>
	<p>
	<iframe src="update.php" style="width:40%; height:500px;">
		<p>Your browser does not support iframes.</p>
	</iframe>
	</p>
	<script>
		function updatePage() {
			location.reload();
		}
	</script>
</div>

</body>

</html>
