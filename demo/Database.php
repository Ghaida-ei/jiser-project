<?php
$servername = "127.0.0.1"; // Or your actual hostname if different
$username = "root"; // Or the correct username
$password = ""; // Or your MySQL password if set
$dbname = "Login";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
