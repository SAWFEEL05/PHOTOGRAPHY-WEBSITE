<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "captured_moments"; 

$conn = new mysqli($servername, $username, $password,
 $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_form (name, email, phone, message) VALUES ('$name', '$email',
     '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message submitted successfully!'); window.location.href =
         'contactus.html';</script>";

    } else {
        echo "<script>alert('There was an error submitting your message. Please try again.');
         window.location.href = 'contactus.html';</script>";
    }
}

$conn->close();
?>
