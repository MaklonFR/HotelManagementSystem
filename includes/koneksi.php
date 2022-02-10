<?php
$namaserver = "localhost";
$username = "root";
$password = "";
$database= "hotel";

// Create connection
$conn = new mysqli($namaserver, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>