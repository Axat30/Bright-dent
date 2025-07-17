<?php
session_start();
session_regenerate_id(true); 
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}

// Include DB connection
$host = "sql101.infinityfree.com";
$dbname = "if0_38699045_brightdent_db";
$username = "if0_38699045";
$password = "brightdent123"; // Replace with your actual password

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointment form data
$sql_appointment = "SELECT * FROM appointments ORDER BY date DESC, time DESC";
$result_appointment = $conn->query($sql_appointment);

// Fetch contact form data
$sql_contact = "SELECT * FROM contact_form ORDER BY submitted_at DESC";
$result_contact = $conn->query($sql_contact);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="../Images/fav-icon.png">
  <title>Admin Dashboard | BrightDent</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 20px;
    }
    h2 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background: #007BFF;
      color: white;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
    .logout {
      display: block;
      margin: 20px auto;
      width: 100px;
      padding: 10px;
      text-align: center;
      background: #dc3545;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    .logout:hover {
      background: #b52a37;
    }
    button {
      padding: 10px 15px;
      background: green;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: darkgreen;
    }
  </style>
</head>
<body>

  <h2>Appointment Form Data</h2>
<!-- For Appointments -->
<form action="export_excel.php" method="post">
  <input type="hidden" name="type" value="appointments">
  <button type="submit">Export Appointments to Excel</button>
</form>
  <table>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Appointment Date</th>
      <th>Appointment Time</th>
      <th>Notes</th>
      <th>Action</th>
    </tr>
    <?php if ($result_appointment->num_rows > 0): ?>
      <?php while($row = $result_appointment->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['fname']) ?></td>
          <td><?= htmlspecialchars($row['last_name']) ?></td>
          <td><?= htmlspecialchars($row['ph_no']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['date']) ?></td>
          <td><?= htmlspecialchars($row['time']) ?></td>
          <td><?= htmlspecialchars($row['notes']) ?></td>
          <td><a href="delete.php?type=appointment&id=<?= $row['id'] ?>" onclick="return confirm('Delete this appointment?')">Delete</a></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="9">No appointment submissions found.</td></tr>
    <?php endif; ?>
  </table>

  <h2>Contact Form Data</h2>
<!-- For Contacts -->
<form action="export_excel.php" method="post">
  <input type="hidden" name="type" value="contacts">
  <button type="submit">Export Contacts to Excel</button>
</form>
  <table>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Subject</th>
      <th>Message</th>
      <th>Submitted At</th>
      <th>Action</th>
    </tr>
    <?php if ($result_contact->num_rows > 0): ?>
      <?php while($row = $result_contact->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['full_name']) ?></td>
          <td><?= htmlspecialchars($row['last_name']) ?></td>
          <td><?= htmlspecialchars($row['phone_number']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['subject']) ?></td>
          <td><?= htmlspecialchars($row['message']) ?></td>
          <td><?= $row['submitted_at'] ?></td>
          <td><a href="delete.php?type=contact&id=<?= $row['id'] ?>" onclick="return confirm('Delete this message?')">Delete</a></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="9">No contact submissions found.</td></tr>
    <?php endif; ?>
  </table>

  <a href="logout.php" class="logout">Logout</a>

</body>
</html>
