<?php

// Database configuration
$host = 'localhost'; 
$dbName = 'v3'; 
$user = 'root'; 
$password = '1234'; 

// Create a new MySQLi instance
$con = new mysqli($host, $user, $password, $dbName);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);

} 

?>

