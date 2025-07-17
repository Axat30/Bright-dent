<?php
session_start();

// Hardcoded credentials (you can upgrade to DB-based login later)
$valid_username = "admin";
$valid_password = "brightdent123"; // Change this to a secure password

// Get form input
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Check credentials
if ($username === $valid_username && $password === $valid_password) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "<script>
        alert('Invalid username or password!');
        window.location.href = 'admin_login.html';
    </script>";
    exit();
}
?>
