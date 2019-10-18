<?php

	$host = "127.0.0.1";
	$username = "root";
	$password = "";
	$database = "foodsmith";
	
	// Create connection
	$mysqli = new mysqli($host, $username, $password, $database);
	
	// Check connection
		if (mysqli_connect_error())
		{
			die("Database connection failed: " . mysqli_connect_error());
		}

		$itemlist = "";
		
		
		
		if(isset($_POST['submit'])){
			
			if(!empty($_POST['checkbox1'])){
			
			
			foreach($_POST['checkbox1'] as $selected){
				
				$itemlist = $itemlist . $selected . "\n";
				
				
			}
			
			$insertitem = $itemlist;
			echo ($insertitem);
			
			}
			
		}
		
		$sql = "INSERT INTO orderlist(orderID,orderDate,itemList,totalPrice,orderStatus,tableID) VALUES ('1',CURDATE(),'$insertitem', '13.00','Pending','4')";
		$insert = $mysqli->query($sql);
		
		
		if($insert){
			
			echo "Success!";
			
		}
		else{
			
		die("Error:" . mysqli_error($mysqli));
		}
	

?>