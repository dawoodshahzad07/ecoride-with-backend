<?php
// Database connection
$servername = "localhost"; // Default, will be overridden by env var if set
$username = "root";        // Default, will be overridden by env var if set
$password = "";            // Default, will be overridden by env var if set
$dbname = "ecoride_french"; // Default, will be overridden by env var if set

// Use environment variables if available (for Railway)
$servername = $_ENV['MYSQL_HOST'] ?? $servername; // Use MYSQL_HOST env var or default 'localhost'
$username = $_ENV['MYSQL_USER'] ?? $username;     // Use MYSQL_USER env var or default 'root'
$password = $_ENV['MYSQL_PASSWORD'] ?? $password; // Use MYSQL_PASSWORD env var or default ''
$dbname = $_ENV['MYSQL_DATABASE'] ?? $dbname;     // Use MYSQL_DATABASE env var or default 'ecoride_french'
$port = $_ENV['MYSQL_PORT'] ?? 3306;             // Use MYSQL_PORT env var or default 3306

// Construct connection string with port (important for TCP/IP)
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();
