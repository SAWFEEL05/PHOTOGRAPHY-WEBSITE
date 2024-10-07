<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "captured_moments";

// Create connection
$conn = new mysqli($servername, $username, $password,
 $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the contact_form table
$sql = "SELECT name, email, phone, message FROM contact_form";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submissions</title>
    <link rel="stylesheet" href="retrieve_data.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
        <div class="logo">
            <a href="#"><span>Captured Moments</span></a>
        </div>
        <div class="list-section">
            <ul class="nav-items">
                <li><a href="admin.php">Gallery manager</a></li>
                <li><a href="retrieve_data.php">Message</a></li>
            </ul>
        </div>
        <div class="btn-section" id="auth-buttons">  
            <button class="login" onclick="onLogin()">Login</button>
            <button class="register" onclick="onRegister()">Register</button>
        </div>
    </nav>
    <h1 class="title2">Contact Form Submissions</h1>
    <div class="table-container">
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
        </tr>
        <?php
        // Display data in a table format
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["name"]. "</td><td>" . $row["email"] . "</td><td>" 
                . $row["phone"] . "</td><td>" . $row["message"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No submissions found</td></tr>";
        }
        ?>
    </table>
    </div>
</body>
<script src="script.js"></script>
</html>
<?php

$conn->close();

