<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "db connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm  = $_POST["confirm_password"];

    if ($password !== $confirm) {
        die("Passwords do not match!");
    }

    
    $hash = password_hash($password, PASSWORD_DEFAULT);

   
    $stmt = $conn->prepare(
        "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
    );

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $username, $email, $hash);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.html'>Login</a>";
    } else {
        die("Execution failed: " . $stmt->error);
    }
}
?>
