<?php
include_once('db/conn.php');
if ($_SESSION['type'] != 'admin') {
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
      <form action="" method="get" style="float: right;">
        <input type="date" name="date" class="form-control" style="width: 140px;">
        <button type="submit" class="details-btn">Search</button>
      </form>
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
            <th>numéro d'immatriculation</th>
            <th>date d'immatriculation</th>

          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_GET['date'])) {
            $date = trim($_GET['date']);

            $query = "SELECT * FROM covoiturages WHERE date = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $date);
          } else {
            $query = "SELECT * FROM covoiturages";
            $stmt = $conn->prepare($query);
          }

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
              <td><?php echo htmlspecialchars($res['ecologique']); ?></td>
              <td><?php echo $res['animaux_autorises'] ? 'Oui' : 'Non'; ?></td>
              <td><?php echo $res['fumeur_autorise'] ? 'Oui' : 'Non'; ?></td>
              <td><?php echo htmlspecialchars($res['modele_voiture']); ?></td>
              <td><?php echo htmlspecialchars($res['marque_voiture']); ?></td>
              <td><?php echo htmlspecialchars($res['energie_voiture']); ?></td>
              <td><?php echo htmlspecialchars($res['numero_immatriculation']); ?></td>
              <td><?php echo htmlspecialchars($res['date_immatriculation']); ?></td>
            </tr>

          <?php
          }
          ?>

        </tbody>
      </table>
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