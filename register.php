<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "captured_moments"; 

$conn = new mysqli($servername, $username, $password, 
$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $username = $_POST['uName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['cPassword'];

    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email,
     password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $username, $email,
     $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>
                alert('User created successfully!');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
