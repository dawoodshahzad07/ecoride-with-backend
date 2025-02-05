<?php
include_once('db/conn.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoRide - Recherche de Covoiturages</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- Barre de navigation -->
  <header>
    <?php include_once('nav.php'); ?>
  </header>


  <!-- Résultats des covoiturages -->
  <section class="results-section">
    <div class="container">
      <div id="results-container">
        <h2>Bookings</h2>
        <?php
        if (isset($_SESSION['user_id'])) {
          $cus_id = $_SESSION['user_id'];

          $query = "
          SELECT 
              reservations.*, 
              reservations.chauffeur_id AS reservation_driver_id, 
              reservations.id AS reservation_id, 
              reservations.statut AS reservation_status, 
              covoiturages.*, 
              utilisateurs.nom AS chauffeur_nom, 
              utilisateurs.photo AS chauffeur_photo, 
              utilisateurs.email AS chauffeur_email, 
              utilisateurs.note AS driver_rating
          FROM reservations
          LEFT JOIN covoiturages ON covoiturages.id = reservations.covoiturage_id
          LEFT JOIN utilisateurs ON utilisateurs.id = covoiturages.chauffeur_id
          WHERE reservations.client_id = ?
      ";


          $stmt = $conn->prepare($query);
          $stmt->bind_param("s", $cus_id);
          $stmt->execute();
          $result = $stmt->get_result();

          while ($res = $result->fetch_assoc()) {
        ?>
            <div class="covoiturage">
              <img src="profiles/<?php echo htmlspecialchars($res['chauffeur_photo']); ?>" alt="<?php echo htmlspecialchars($res['chauffeur_nom']); ?>">

              <div class="covoiturage-info">
                <h3><?php echo htmlspecialchars($res['chauffeur_nom']); ?> - Note : <?php echo htmlspecialchars($res['driver_rating']); ?> ⭐
                  <?php if ($res['reservation_status'] == 'active') { ?>
                    <a href="db/carpool.php?cancelBooking=<?php echo $res['reservation_id'] ?>" class="details-btn">Annuler la réservation</a>
                  <?php } else {
                    echo 'Annulé';
                  } ?>
                </h3>
                <p>Départ : <?php echo htmlspecialchars($res['heure_depart']); ?> - Arrivée : <?php echo htmlspecialchars($res['heure_arrivee']); ?></p>

                <p class="<?php echo $res['ecologique'] ? "ecologique" : "non-ecologique"; ?>">
                  <?php echo $res['ecologique'] ?  "Voyage écologique ♻️" : "Non écologique 🚗"; ?>
                </p>
              </div>

              <form action="db/carpool.php" method="post">
                <h5>Laisser un avis</h5>
                <label for="">Évaluation</label>
                <select name="rating" class="form-control" id="">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <br>

                <label for="">Avis</label>
                <input type="hidden" name="driver_id" value="<?php echo htmlspecialchars($res['chauffeur_id']); ?>">
                <input type="text" class="form-control" name="review" placeholder="Écrire un avis">
                <button type="submit" name="submit_review" class="details-btn">Soumettre</button>
              </form>
            </div>

      </div>
  <?php
          }
          $stmt->close();
        }
  ?>
    </div>

    <p id="no-results" class="no-results" style="display: none;">Aucun covoiturage disponible pour les critères donnés. Essayez une autre date.</p>
  </section>

  <footer>
    <div class="container">
      <p>📧 Email : <a href="mailto:contact@ecoride.com">contact@ecoride.com</a></p>
      <p><a href="mentions-legales.php">Mentions légales</a></p>
      <p>&copy; 2024 EcoRide - Tous droits réservés</p>
    </div>
  </footer>

  <script src="js/main.js"></script>
</body>

</html>