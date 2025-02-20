<?php
// Add at the top of the file for debugging
error_log("Host: " . getenv('MYSQL_HOST'));
error_log("Database: " . getenv('MYSQL_DATABASE'));
error_log("Port: " . getenv('MYSQL_PORT'));
// Don't log username/password for security

// Database connection
$servername = getenv('MYSQL_HOST') ?: 'localhost';
$username = getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQL_PASSWORD') ?: '';
$dbname = getenv('MYSQL_DATABASE') ?: 'ecoridebackend';
$port = getenv('MYSQL_PORT') ?: '3306';

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

    // Check connection
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }

    // Start session
    session_start();
} catch (Exception $e) {
    die("Connection error: " . $e->getMessage());
}
