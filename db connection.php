<?php
$host = "localhost";   // often localhost
$user = "root";        // your MySQL user
$pass = "";            // your MySQL password
$db   = "login_system";

$conn = new mysqli("localhost", "root", "", "login_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



