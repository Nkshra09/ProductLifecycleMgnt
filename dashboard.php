<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ProductDB"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $mysqli->select_db("ProductDB");

?>
