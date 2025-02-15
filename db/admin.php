<?php
include_once('conn.php');
include_once('../config.php');

if (isset($_POST['save_emp'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $type = 'employee';
  $query = "INSERT INTO utilisateurs (nom, email, mot_de_passe, type) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);
  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $type);
  mysqli_stmt_execute($stmt);
  header('Location: ../employees.php');
}

if (isset($_GET['suspend'])) {
  $user_id = $_GET['suspend'];

  $status = 'suspend';
  $sql = "UPDATE utilisateurs SET statut = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $status, $user_id);
  $stmt->execute();
  $stmt->close();
  header('Location: ../employees.php');
}
