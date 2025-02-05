<?php
include_once('conn.php');
include_once('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_driver_info'])) {
  // Retrieve form data
  $departure = trim($_POST['departure']);
  $destination = trim($_POST['destination']);
  $date = trim($_POST['date']);
  $time_start = trim($_POST['time_start']);
  $time_end = trim($_POST['time_end']);
  $car_model = trim($_POST['car_model']);
  $car_brand = trim($_POST['car_brand']);
  $car_energy = trim($_POST['car_energy']);
  $seats = ($_POST['seats']);
  $price = 0;
  $ecological = intval($_POST['ecological']);
  $pets_allowed = intval($_POST['pets_allowed']);
  $smoking_allowed = intval($_POST['smoking_allowed']);

  // Validate required fields
  if (
    empty($departure) || empty($destination) || empty($date) || empty($time_start) ||
    empty($time_end) || empty($car_model) || empty($car_brand) || empty($car_energy)
  ) {
    die("All fields are required.");
  }

  // Escape inputs for security
  $departure = mysqli_real_escape_string($conn, $departure);
  $destination = mysqli_real_escape_string($conn, $destination);
  $date = mysqli_real_escape_string($conn, $date);
  $time_start = mysqli_real_escape_string($conn, $time_start);
  $time_end = mysqli_real_escape_string($conn, $time_end);
  $car_model = mysqli_real_escape_string($conn, $car_model);
  $car_brand = mysqli_real_escape_string($conn, $car_brand);
  $car_energy = mysqli_real_escape_string($conn, $car_energy);

  // Construct the query
  $query = "INSERT INTO covoiturages 
               (depart, destination, chauffeur_id, date, heure_depart, heure_arrivee, modele_voiture, marque_voiture, energie_voiture, places, prix, ecologique, animaux_autorises, fumeur_autorise)
 VALUES (
              '$departure', 
              '$destination', 
              {$_SESSION["user_id"]}, 
              '$date', 
              '$time_start', 
              '$time_end', 
              '$car_model', 
              '$car_brand', 
              '$car_energy', 
              $seats, 
              $price, 
              $ecological, 
              $pets_allowed, 
              $smoking_allowed
            )";

  if (mysqli_query($conn, $query)) {
    header("Location: ../addCarpool.php");
    exit;
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  mysqli_close($conn);
}

if (isset($_GET['cancel'])) {
  $carpool_id = $_GET['cancel'];

  // Fetching users who booked the carpool
  $query = "SELECT u.email, u.id AS user_id, b.credit AS booking_credit
            FROM reservations b 
            JOIN utilisateurs u ON b.client_id = u.id 
            WHERE b.covoiturage_id = ? AND b.statut != 'annulé'";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $carpool_id);
  $stmt->execute();
  $result = $stmt->get_result();

  $remboursements = [];
  while ($row = $result->fetch_assoc()) {
    $remboursements[] = $row;
  }
  $stmt->close();

  // Update booking status to 'annulé' (cancelled)
  $sql = "UPDATE reservations SET statut = 'cancel' WHERE covoiturage_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $carpool_id);
  $stmt->execute();
  $stmt->close();

  // Process refunds and send emails
  foreach ($remboursements as $remboursement) {
    $sql = "UPDATE utilisateurs SET credit = credit + ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $remboursement['booking_credit'], $remboursement['user_id']);
    $stmt->execute();
    $stmt->close();

    $to = $remboursement['email'];
    $from = 'sender_email'; // Make sure to define this
    $subject = "Notification d'annulation de réservation";
    $message = "Cher utilisateur,\n\nVotre réservation pour le covoiturage a été annulée. Votre compte a été remboursé avec " . $remboursement['booking_credit'] . " crédits.\n\nMerci.";

    // Email headers for HTML content
    $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $message_html = 'Nom: ' . htmlspecialchars($message) . '<br>Email: ' . htmlspecialchars($from_email) . '<br>';

    mail($to, $subject, $message_html, $headers);
  }

  // Update the carpool status to 'annulé' (cancelled)
  $sql = "UPDATE covoiturages SET statut = 'cancel' WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $carpool_id);
  $stmt->execute();
  $stmt->close();

  echo "Le statut du covoiturage a été mis à jour avec succès.";
  header("Location: ../addCarpool.php"); // Make sure this path is correct
}
