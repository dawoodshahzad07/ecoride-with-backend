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
      <h3>utilisateurs</h3>
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Type</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $type = 'admin';
          $query = "SELECT * FROM utilisateurs WHERE type != ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("s", $type);
          $stmt->execute();
          $result = $stmt->get_result();
          while ($res = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo htmlspecialchars($res['nom']); ?></td>
              <td><?php echo htmlspecialchars($res['email']); ?></td>
              <td><?php echo htmlspecialchars($res['type']); ?></td>
              <?php if ($res['statut'] == 'suspend') { ?>
                <td>suspendu</td>
              <?php } else { ?>
                <td><a href="db/admin.php?suspend=<?php echo $res['id']; ?>">suspendre</a></td>
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
      <h1>Ajouter un Employee</h1>
      <form method="POST" action="db/admin.php">
        <div class="form-group">
          <label for="departure">Nom :</label>
          <input type="text" id="departure" name="name" class="form-control" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="destination">Email:</label>
          <input type="text" id="destination" name="email" class="form-control" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="destination">mot de passe:</label>
          <input type="text" id="destination" name="password" class="form-control" placeholder="" required>
        </div>
        <button type="submit" name="save_emp" class="btn-primary">Enregistrer</button>
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