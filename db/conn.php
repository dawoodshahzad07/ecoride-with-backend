<?php
// Database connection
$servername = "localhost"; // Default, will be overridden by env var if set
$username = "root";        // Default, will be overridden by env var if set
$password = "";            // Default, will be overridden by env var if set
$dbname = "ecoridebackend"; // Default, will be overridden by env var if set

// Use environment variables if available (for Railway)
$servername = $_ENV['MYSQL_HOST'] ?? $servername;
$username = $_ENV['MYSQL_USER'] ?? $username;
$password = $_ENV['MYSQL_PASSWORD'] ?? $password;
$dbname = $_ENV['MYSQL_DATABASE'] ?? $dbname;
$port = $_ENV['MYSQL_PORT'] ?? 3306;

// Construct connection string with port (important for TCP/IP)
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();
