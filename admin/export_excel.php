<?php
session_start();
session_regenerate_id(true); 
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}

$host = "sql101.infinityfree.com";
$dbname = "if0_38699045_brightdent_db";
$username = "if0_38699045";
$password = "brightdent123"; // Replace with your real DB password

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_POST['type'] ?? '';

header("Content-Type: application/vnd.ms-excel");

if ($type === 'appointments') {
    header("Content-Disposition: attachment; filename=appointments.xls");
    echo "ID\tFirst Name\tLast Name\tPhone Number\tEmail\tDate\tTime\tNotes\n";
    $result = $conn->query("SELECT * FROM appointments");
    while ($row = $result->fetch_assoc()) {
        echo "{$row['id']}\t{$row['fname']}\t{$row['last_name']}\t{$row['ph_no']}\t{$row['email']}\t{$row['date']}\t{$row['time']}\t{$row['notes']}\n";
    }
} elseif ($type === 'contacts') {
    header("Content-Disposition: attachment; filename=contacts.xls");
    echo "ID\tFirst Name\tLast Name\tPhone Number\tEmail\tSubject\tMessage\tSubmitted At\n";
    $result = $conn->query("SELECT * FROM contact_form");
    while ($row = $result->fetch_assoc()) {
        echo "{$row['id']}\t{$row['full_name']}\t{$row['last_name']}\t{$row['phone_number']}\t{$row['email']}\t{$row['subject']}\t{$row['message']}\t{$row['submitted_at']}\n";
    }
} else {
    echo "Invalid export type.";
}

$conn->close();
?>
