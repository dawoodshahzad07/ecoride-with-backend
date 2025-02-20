<?php
// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

try {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname, (int)$port);

    // Check connection
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }

    // Get username and password from POST request
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Start session and store user data
        session_start();
        $user_data = $result->fetch_assoc();
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['username'];
        
        // Redirect to dashboard or home page
        header("Location: ../index.php");
        exit();
    } else {
        // Invalid credentials
        header("Location: ../login.php?error=1");
        exit();
    }

} catch (Exception $e) {
    die("Connection error: " . $e->getMessage() . 
        "\nHost: " . $servername . 
        "\nDatabase: " . $dbname . 
        "\nPort: " . $port);
}

// Close connection
$conn->close();
?>
