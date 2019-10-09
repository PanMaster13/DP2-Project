<?php
$out = "";
//if username and password is set
if (isset($_POST["uname"]) && isset($_POST["passwd"])){
	$uname = $_POST["uname"];
	//hash the password
	$passwd = hash("sha256", $_POST["passwd"]);
	
	//init database
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "foodsmith";
	
	// Create connection
	$conn = new mysqli($host, $username, $password, $database);
	
	// Check connection
	if (mysqli_connect_error()) die("Database connection failed: " . mysqli_connect_error());
	
	//query
	$sql = "SELECT * FROM user WHERE userName = '$uname' AND Password = '$passwd'";
	//run the query
	$result = $conn->query($sql);

	if (!$result) {
		trigger_error('Invalid SQL query: ' . $conn->error);
	}
	//if there is row returned, login is valid
	else if ($result->num_rows > 0){
		
		$row = $result->fetch_assoc();
		$usertype = $row["userType"];
		
		session_start();
		
		$_SESSION["userName"] = $uname;
		$_SESSION["userType"] = $usertype;
		
		session_destroy();
		
		//redirect to page based on user type
		if ($usertype == "admin") header("Location: /adminPanel/adminPanel.php");
		else {
			$out = "You've logged in as staff, but the page hasn't been implemented. Please redirect to staff page when ready.";
			//header("Location: /");
		}
	}
	else $out = "Username or password is incorrect. Please try again";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/styles/style.css">
</head>
<body>

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
	
</body>
</html>
