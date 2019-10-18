<?php
//init database
$host = "localhost";
$username = "root";
$password = "";
$database = "foodsmith";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if (mysqli_connect_error()) die("Database connection failed: " . mysqli_connect_error());
?>