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

    session_start();
    include_once('../config.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['register'])) {
            // ... your existing registration code ...
        } elseif (isset($_POST['login'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                die("Email and password are required.");
            }

            $query = "SELECT id, nom, mot_de_passe, type FROM utilisateurs WHERE email = ?";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($id, $name, $hashed_password, $type);

                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        $_SESSION['user_id'] = $id;
                        $_SESSION['name'] = $name;
                        $_SESSION['type'] = $type;

                        $redirect_url = isset($_POST['previous_url']) ? $_POST['previous_url'] : '../index.php';

                        if ($type === 'customer') {
                            header("Location: $redirect_url");
                        } elseif ($type === 'driver') {
                            header("Location: ../addCarpool.php");
                        } elseif ($type === 'admin') {
                            header("Location: ../carpools.php");
                        } elseif ($type === 'employee') {
                            header("Location: ../rating.php");
                        } else {
                            header("Location: ../index.php");
                        }
                        exit;
                    } else {
                        header("Location: ../connexion.php?error=invalid");
                        exit;
                    }
                } else {
                    header("Location: ../connexion.php?error=notfound");
                    exit;
                }
                $stmt->close();
            }
        }
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: ../index.php");
        exit;
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
