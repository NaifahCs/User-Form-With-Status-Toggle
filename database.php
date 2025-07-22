<?php
// define database connection parameters
$host = "localhost";      
$user = "root";           
$password = "";           
$dbname = "toggle_db"; // Database name

$conn = new mysqli($host, $user, $password, $dbname);
// check if the connection failed
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>