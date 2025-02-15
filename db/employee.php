<?php
include_once('conn.php');
include_once('../config.php');

if (isset($_GET['accept'])) {
  $user_id = $_GET['driver'];

  $updateRatingQuery = "
    UPDATE utilisateurs 
    SET note = (
        SELECT COALESCE(AVG(note), 0) 
        FROM avis 
        WHERE chauffeur_id = ?
    )
    WHERE id = ?
  ";

  $updateStmt = mysqli_prepare($conn, $updateRatingQuery);

  if ($updateStmt) {
    mysqli_stmt_bind_param($updateStmt, "ii", $user_id, $user_id);
    mysqli_stmt_execute($updateStmt);

    $status = 'accepted';
    $id = $_GET['accept'];
    $updateReview = "UPDATE avis SET statut = ? WHERE id = ?";
    $updateReviewStmt = mysqli_prepare($conn, $updateReview);
    mysqli_stmt_bind_param($updateReviewStmt, "si", $status, $id);
    mysqli_stmt_execute($updateReviewStmt);
    header('Location: ../rating.php');
  }
}

if (isset($_GET['reject'])) {
  $status = 'rejected';
  $id = $_GET['reject'];
  $updateReview = "UPDATE avis SET statut = ? WHERE id = ?";
  $updateReviewStmt = mysqli_prepare($conn, $updateReview);
  mysqli_stmt_bind_param($updateReviewStmt, "si", $status, $id);
  mysqli_stmt_execute($updateReviewStmt);
  header('Location: ../rating.php');
}
