<?php
include_once('db/conn.php');
if ($_SESSION['type'] != 'employee') {
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
      <h3>Évaluation des conducteurs</h3>

      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>note</th>
            <th>commentaire</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
          <?php

          $query = "SELECT * FROM avis ";
          $stmt = $conn->prepare($query);

          $stmt->execute();
          $result = $stmt->get_result();
          while ($res = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo htmlspecialchars($res['note']); ?></td>
              <td><?php echo htmlspecialchars($res['commentaire']); ?></td>
              <?php if ($res['statut'] == 'accepted') { ?>
                <td>accepté</td>
              <?php } elseif ($res['statut'] == 'rejected') { ?>
                <td>rejeté</td>
              <?php } else { ?>
                <td><a href="db/employee.php?accept=<?php echo $res['id']; ?>&driver=<?php echo $res['chauffeur_id']; ?>">accepter</a> /
                  <a href="db/employee.php?reject=<?php echo $res['id']; ?>">rejeter</a>
                </td>
              <?php } ?>
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