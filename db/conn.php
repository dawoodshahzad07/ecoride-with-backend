<?php
// Add at the top of the file for debugging
error_log("Host: " . getenv('MYSQLHOST'));
error_log("Database: " . getenv('MYSQLDATABASE'));
error_log("Port: " . getenv('MYSQLPORT'));
// Don't log username/password for security

// Database connection - using Railway's variable names
$servername = getenv('MYSQLHOST');
$username = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$dbname = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT');

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validate that we have all required connection details
if (!$servername || !$username || !$password || !$dbname || !$port) {
    die("Missing required database connection details. Please check environment variables." . 
        "\nHost: $servername" .
        "\nDatabase: $dbname" .
        "\nPort: $port" .
        "\nUser: $username");
}

try {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname, (int)$port);

    // Check connection
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }

    // Start session
    session_start();
} catch (Exception $e) {
    die("Connection error: " . $e->getMessage() . " (Host: $servername, Database: $dbname, Port: $port)");
}
