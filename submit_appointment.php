<?php
$servername = "sql101.infinityfree.com";
$username = "if0_38699045";
$password = "brightdent123"; // Replace with your real password
$dbname = "if0_38699045_brightdent_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $fname     = htmlspecialchars(trim($_POST['fname']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $ph_no     = htmlspecialchars(trim($_POST['ph_no']));
    $email_raw = trim($_POST['email']);
    $email     = filter_var($email_raw, FILTER_VALIDATE_EMAIL);
    $date      = $_POST['date'];
    $time      = $_POST['time'];
    $notes     = htmlspecialchars(trim($_POST['notes']));

    if (!$email) {
        die("Invalid email format.");
    }

    // Use prepared statements properly
    $stmt = $conn->prepare("INSERT INTO appointments (fname, last_name, ph_no, email, date, time, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fname, $last_name, $ph_no, $email, $date, $time, $notes);

    if ($stmt->execute()) {
    echo "<script>
            alert('Appointment submitted successfully!');
            window.location.href = 'index.html'; // replace with your home page
          </script>";
    exit();
} else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
