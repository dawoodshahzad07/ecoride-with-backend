<?php
// Add at the top of the file for debugging
error_log("Attempting database connection...");

// Database connection with Railway environment variables
$servername = getenv('MYSQLHOST');  // Get the Railway internal host
if (!$servername) {
    error_log("MYSQLHOST not set, falling back to localhost");
    $servername = 'localhost';
}

$username = getenv('MYSQLUSER') ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: '';
$dbname = getenv('MYSQLDATABASE') ?: 'ecoride_french';
$port = getenv('MYSQLPORT') ?: '3306';

error_log("Connection details:");
error_log("Host: " . $servername);
error_log("Database: " . $dbname);
error_log("Port: " . $port);
error_log("User: " . $username);

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    die("Connection error: " . $e->getMessage() . 
        "\nHost: " . $servername . 
        "\nDatabase: " . $dbname . 
        "\nPort: " . $port);
}
