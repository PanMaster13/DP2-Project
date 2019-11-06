<?php
$out = "";
//start session
session_start();

//if username and password is set
if (isset($_POST["uname"]) && isset($_POST["passwd"])){
	$uname = $_POST["uname"];
	//hash the password
	$passwd = $_POST["passwd"];
	
	//include database connection
	//the connection variable is $conn
	include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	
	//query
	$sql = "SELECT * FROM user WHERE userName = '$uname'";
	//run the query
	$result = $conn->query($sql);

	if (!$result) {
		trigger_error('Invalid SQL query: ' . $conn->error);
	}
	//if there is row returned, username is valid
	else if ($result->num_rows > 0){
		
		$row = $result->fetch_assoc();
		
		//verify password
		if(password_verify($passwd, $row["Password"])){
			$usertype = $row["userType"];
			
			//set username and type to session
			$_SESSION["userName"] = $uname;
			$_SESSION["userType"] = $usertype;
		}
		else $out = "Username or password is incorrect. Please try again";
	}
	else $out = "Username or password is incorrect. Please try again";
}
//redirect to page based on user type
if (isset($_SESSION["userType"])){
	if ($_SESSION["userType"] == "admin") header("Location: /admin/");
	else header("Location: /orders/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/styles/style.css">
	<link rel="stylesheet" href="/styles/font.css">
</head>
<body>

	<div id="center">
	<img id="login_logo" src="/template/images/logo_blue.png" alt="logo">

	<h1 class="login_form" >Login</h1>
	<form class="login_form" action="" method="post">
		<input class="login_input" type="text" name="uname" placeholder="Username" required></input>
		<br/>
		<input class="login_input" type="password" name="passwd" placeholder="Password" required></input>
		<br/>
		<p id="error_out"><?php echo $out; ?></p>
		<button id="login_button" type="submit">Submit</button>
	</form>
	</div>
</body>
</html>
