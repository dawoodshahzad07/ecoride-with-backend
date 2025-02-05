<?php
include_once('db/conn.php');
if ($_SESSION['type'] != 'driver') {
  header("Location: connexion.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoRide - Recherche de Covoiturages</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border: 1px solid #ddd;
    }

    th {
      background-color: #343a40;
      color: white;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    td {
      font-size: 14px;
      color: #555;
    }

    .table-container {
      overflow-x: auto;
      margin-top: 20px;
    }

    .table-container table {
      min-width: 800px;
    }

    .table-container th,
    .table-container td {
      text-align: center;
    }
  </style>

</head>

<body>
  <!-- Barre de navigation -->
  <header>
    <?php include_once('nav.php'); ?>
  </header>

  <!-- Formulaire de recherche -->
  <section>
    <div class="container">
      <h3>covoiturages</h3>
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>Départ</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Heure de départ</th>
            <th>Heure d'arrivée</th>
            <th>Places</th>
            <th>Écologique</th>
            <th>Animaux autorisés</th>
            <th>Fumeur autorisé</th>
            <th>Modèle de voiture</th>
            <th>Marque de voiture</th>
            <th>Énergie de voiture</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $driver_id = $_SESSION['user_id'];
          $query = "SELECT * FROM covoiturages WHERE chauffeur_id = ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("i", $driver_id);
          $stmt->execute();
          $result = $stmt->get_result();
          while ($res = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo htmlspecialchars($res['depart']); ?></td>
              <td><?php echo htmlspecialchars($res['destination']); ?></td>
              <td><?php echo htmlspecialchars($res['date']); ?></td>
              <td><?php echo htmlspecialchars($res['heure_depart']); ?></td>
              <td><?php echo htmlspecialchars($res['heure_arrivee']); ?></td>
              <td><?php echo htmlspecialchars($res['places']); ?></td>
              <td><?php echo $res['ecologique'] ? 'Oui' : 'Non'; ?></td>
              <td><?php echo $res['animaux_autorises'] ? 'Oui' : 'Non'; ?></td>
              <td><?php echo $res['fumeur_autorise'] ? 'Oui' : 'Non'; ?></td>
              <td><?php echo htmlspecialchars($res['modele_voiture']); ?></td>
              <td><?php echo htmlspecialchars($res['marque_voiture']); ?></td>
              <td><?php echo htmlspecialchars($res['energie_voiture']); ?></td>
              <?php if ($res['statut'] == 'cancel') { ?>
                <td>Annulé</td>
              <?php } else { ?>
                <td><a href="db/saveCarpool.php?cancel=<?php echo $res['id']; ?>">Annuler</a></td>
              <?php } ?>
            </tr>

          <?php
          }
          ?>

        </tbody>
      </table>
    </div>
  </section>
  <section class="search-section">
    <div class="container">
      <h1>Ajouter un covoiturage</h1>
      <form method="POST" action="db/saveCarpool.php">
        <div class="form-group">
          <label for="departure">Adresse de départ :</label>
          <input type="text" id="departure" name="departure" class="form-control" placeholder="Ville de départ" required>
        </div>
        <div class="form-group">
          <label for="destination">Adresse d’arrivée :</label>
          <input type="text" id="destination" name="destination" class="form-control" placeholder="Ville d'arrivée" required>
        </div>
        <div class="form-group">
          <label for="date">Date :</label>
          <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="date">Heure de départ :</label>
          <input type="time" name="time_start" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="date">Heure d’arrivée :</label>
          <input type="time" name="time_end" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Modèle de voiture :</label>
          <input type="text" name="car_model" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Marque de voiture :</label>
          <input type="text" name="car_brand" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Type de carburant :</label>
          <input type="text" name="car_energy" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="date">Nombre de sièges :</label>
          <input type="number" name="seats" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="date">Écologique :</label>
          <select name="ecological" class="form-control" id="">
            <option value="1">Oui</option>
            <option value="0">Non</option>
          </select>
        </div>
        <div class="form-group">
          <label for="date">Animaux acceptés :</label>
          <select name="pets_allowed" class="form-control" id="">
            <option value="1">Oui</option>
            <option value="0">Non</option>
          </select>
        </div>
        <div class="form-group">
          <label for="date">Fumeur accepté :</label>
          <select name="smoking_allowed" class="form-control" id="">
            <option value="1">Oui</option>
            <option value="0">Non</option>
          </select>
        </div>
        <button type="submit" name="save_driver_info" class="btn-primary">Enregistrer</button>
      </form>
    </div>
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