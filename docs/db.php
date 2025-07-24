
<?php
$servername = "localhost"; // keep as is
$username = "your_db_username"; // 🔁 replace this
$password = "your_db_password"; // 🔁 replace this
$dbname = "your_db_name";       // 🔁 replace this

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
