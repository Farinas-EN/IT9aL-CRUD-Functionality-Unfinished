<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "CRMSystem";

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set character set to avoid encoding issues
$conn->set_charset("utf8mb4");

echo "Database connection successful!";
?>
