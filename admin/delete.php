<?php
session_start();
session_regenerate_id(true); 
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}

if (!isset($_GET['id']) || !isset($_GET['type'])) {
    die("Invalid request");
}

$host = "sql101.infinityfree.com";
$dbname = "if0_38699045_brightdent_db";
$username = "if0_38699045";
$password = "brightdent123"; // Replace with your real DB password

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);
$type = $_GET['type'];

$table = '';
if ($type === 'appointment') {
    $table = 'appointments';
} elseif ($type === 'contact') {
    $table = 'contact_form';
} else {
    die("Invalid table type");
}

$stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Error deleting record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
