<?php
include_once('conn.php');
include_once('../config.php');

if (isset($_SESSION['user_id'])) {
  $driver_id = $_SESSION['user_id'];
  $query = "SELECT * FROM covoiturages WHERE chauffeur_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $driver_id);
  $stmt->execute();
  $result = $stmt->get_result();
}

if (isset($_POST['book_now'])) {
  $id_utilisateur = $_SESSION['user_id'];

  // Fetch user details
  $query = "SELECT * FROM utilisateurs WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $id_utilisateur);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $nouveau_credit = $row['credit'] - booking_credit;

  // Update user's credit
  $sql = "UPDATE utilisateurs SET credit = ? WHERE id = ?";
  $stmt->close();
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $nouveau_credit, $id_utilisateur);
  $stmt->execute();
  $stmt->close();

  // Carpool booking details
  $id_covoiturage = $_POST['carpool_id'];
  $id_chauffeur = $_POST['driver_id'];
  $places = $_POST['seats'];

  // Insert new booking
  $query = "INSERT INTO reservations (client_id, chauffeur_id, covoiturage_id, places, credit) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  $credit = booking_credit;

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssss", $id_utilisateur, $id_chauffeur, $id_covoiturage, $places, $credit);

    if (mysqli_stmt_execute($stmt)) {

      // Update available seats in the carpool
      $update_places = "UPDATE covoiturages SET places = places - ? WHERE id = ?";
      $stmt->close();
      $stmt = $conn->prepare($update_places);
      $stmt->bind_param("ii", $places, $id_covoiturage);
      $stmt->execute();
      $stmt->close();

      header('Location: ../bookings.php');
    } else {
      echo "Erreur: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
  }
}


if (isset($_POST['submit_review'])) {
  echo 9;
  $review = $_POST['review'];
  $rating = $_POST['rating'];
  $driver_id = $_POST['driver_id'];
  $cus_id = $_SESSION['user_id'];

  $query = "INSERT INTO avis (client_id, chauffeur_id, note, commentaire) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssss", $cus_id, $driver_id, $rating, $review);

    if (mysqli_stmt_execute($stmt)) {
      $updateRatingQuery = "
              UPDATE utilisateurs 
              SET note = (
                  SELECT AVG(note) 
                  FROM avis 
                  WHERE chauffeur_id = ?
              )
              WHERE id = ?
          ";
      $updateStmt = mysqli_prepare($conn, $updateRatingQuery);

      if ($updateStmt) {
        mysqli_stmt_bind_param($updateStmt, "ss", $driver_id, $driver_id);

        if (!mysqli_stmt_execute($updateStmt)) {
          echo "Error updating driver's rating: " . mysqli_stmt_error($updateStmt);
        }

        mysqli_stmt_close($updateStmt);
      } else {
        echo "Error preparing update query: " . mysqli_error($conn);
      }

      header('Location: ../index.php');
      exit;
    } else {
      echo "Error inserting review: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
  } else {
    echo "Error preparing insert query: " . mysqli_error($conn);
  }
}

if (isset($_GET['cancelBooking'])) {
  $id = $_GET['cancelBooking'];
  $cus_id = $_SESSION['user_id'];

  $sql = "UPDATE reservations SET statut = ? WHERE client_id = ? AND id = ?";
  $stmt = $conn->prepare($sql);
  $status = "cancel";
  $stmt->bind_param("sii", $status, $cus_id, $id);
  $stmt->execute();
  $stmt->close();

  $query = "SELECT * FROM reservations WHERE client_id = ? AND id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ii", $cus_id, $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $stmt->close();

  if (!$row) {
    echo "Booking not found.";
    exit();
  }

  $seats = $row['places'];
  $carpool_id = $row['covoiturage_id'];

  $update_seats = "UPDATE covoiturages SET places = places + ? WHERE id = ?";
  $stmt = $conn->prepare($update_seats);
  $stmt->bind_param("ii", $seats, $carpool_id);
  $stmt->execute();
  $stmt->close();

  $query = "SELECT credit FROM utilisateurs WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $cus_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $stmt->close();

  if (!$user) {
    echo "User not found.";
    exit();
  }

  $booking_credit = $row['credit'];
  $new_credit = $user['credit'] + $booking_credit;

  $sql = "UPDATE utilisateurs SET credit = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $new_credit, $cus_id);
  $stmt->execute();
  $stmt->close();

  header('Location: ../index.php');
  exit();
}
