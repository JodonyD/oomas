<?php
$servername = "sql206.byethost10.com";
$username = "b10_39553702";      
$password = "Unconditional18!"; 
$dbname = "b10_39553702_oomas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
