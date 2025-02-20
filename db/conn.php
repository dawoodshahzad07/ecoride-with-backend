<?php
// Add at the top of the file for debugging
error_log("Attempting database connection...");

// Parse Railway's MySQL URL
$mysql_url = getenv('MYSQL_URL');  // This should be provided by Railway
if (!$mysql_url) {
    die("MYSQL_URL environment variable is not set");
}

// Parse the URL to get connection details
$url = parse_url($mysql_url);
$servername = $url['host'];
$username = $url['user'];
$password = $url['pass'];
$dbname = ltrim($url['path'], '/');
$port = $url['port'] ?? 3306;

error_log("Host: " . $servername);
error_log("Database: " . $dbname);
error_log("Port: " . $port);

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
