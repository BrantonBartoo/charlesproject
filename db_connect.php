<?php
$host = "localhost"; // Change if using a different host
$user = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$database = "bursary_system"; // Make sure this matches your database name

$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
