<?php
session_start();

session_destroy(); // Ends the session
header("Location: admin_login.html"); // Redirects to login page
exit();
?>
