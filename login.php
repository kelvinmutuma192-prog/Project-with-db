<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "db connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    
    $stmt = $conn->prepare(
        "SELECT id, username, password FROM users WHERE username = ? OR email = ?"
    );

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

      
        if (password_verify($password, $user['password'])) {

           
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: dashboard.php");
            exit;

        } else {
            
            echo " Wrong password. <a href='login.html'>Try again</a>";
        }

    } else {
        
        echo " User not found. <a href='register.html'>Register</a>";
    }
}
?>
s