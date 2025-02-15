<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoride_french";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

session_start();
include_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $type = trim($_POST['type']);
    $credit = registration_credit;

    if (empty($name) || empty($email) || empty($password) || empty($type)) {
      die("All fields are required.");
    }

    if ($password !== $confirm_password) {
      die("Passwords do not match.");
    }

    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
      $upload_dir = '../profiles/';
      $file_tmp = $_FILES['profile']['tmp_name'];
      $file_name = basename($_FILES['profile']['name']);
      $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
      $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

      if (!in_array(strtolower($file_ext), $allowed_ext)) {
        die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
      }

      $unique_name = uniqid("profile_", true) . '.' . $file_ext;
      $file_path = $upload_dir . $unique_name;
      if (!move_uploaded_file($file_tmp, $file_path)) {
        die("Failed to upload the profile picture.");
      }
    } else {
      $unique_name = null;
    }
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO utilisateurs (nom, credit, email, mot_de_passe, type, photo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ssssss", $name, $credit, $email, $hashed_password, $type, $unique_name);

      if (mysqli_stmt_execute($stmt)) {
        header('Location: ../connexion.php');
      } else {
        echo "Error: " . mysqli_stmt_error($stmt);
      }

      mysqli_stmt_close($stmt);
    } else {
      echo "Error preparing the query: " . mysqli_error($conn);
    }
  } elseif (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
      die("Email and password are required.");
    }

    $query = "SELECT id, nom, mot_de_passe, type FROM utilisateurs WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $email);

      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password, $type);

      if (mysqli_stmt_fetch($stmt)) {
        if (password_verify($password, $hashed_password)) {
          $_SESSION['user_id'] = $id;
          $_SESSION['name'] = $name;
          $_SESSION['type'] = $type;

          echo "Login successful! Redirecting...";
          if ($type === 'customer') {
            header("Location: ../covoiturages.php");
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
          echo "Invalid email or password.";
        }
      } else {
        echo "No account found with this email.";
      }
      mysqli_stmt_close($stmt);
    } else {
      echo "Error preparing the query: " . mysqli_error($conn);
    }
  }
  mysqli_close($conn);
}

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: ../index.php");
}
