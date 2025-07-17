<?php
// Database credentials
$host = "sql101.infinityfree.com";
$dbname = "if0_38699045_brightdent_db";
$username = "if0_38699045";
$password = "brightdent123"; // Replace with your actual password

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $last_name = htmlspecialchars(trim($_POST['lname']));
    $phone_number = htmlspecialchars(trim($_POST['ph-no']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Connect to DB
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepare and insert data into the contact_form table
    $stmt = $conn->prepare("INSERT INTO contact_form (full_name, last_name, phone_number, email, subject, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $last_name, $phone_number, $email, $subject, $message);

    if ($stmt->execute()) {
        // Success message page with auto redirection to home page after 3 seconds
        echo "<html><head><meta http-equiv='refresh' content='3;url=index.html'></head>";
        echo "<body><h1>Success! Your message has been sent.</h1>";
        echo "<p>Redirecting to home page...</p></body></html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
