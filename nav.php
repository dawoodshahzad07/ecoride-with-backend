<?php
$current_page = basename($_SERVER['PHP_SELF']); // Get current page name
?>

<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">EcoRide</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">Accueil</a>
      </li>

      <?php
      $_SESSION['user_id'] = $_SESSION['user_id'] ?? null;
      if ($_SESSION['user_id'] && $_SESSION['type'] == 'driver') { ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'addCarpool.php') ? 'active' : '' ?>" href="addCarpool.php">Ajouter covoiturage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="db/auth.php?logout">Logout</a>
        </li>
      <?php } elseif ($_SESSION['user_id'] && $_SESSION['type'] == 'customer') { ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'covoiturages.php') ? 'active' : '' ?>" href="covoiturages.php">Covoiturages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'bookings.php') ? 'active' : '' ?>" href="bookings.php">Bookings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="db/auth.php?logout">Logout</a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'connexion.php') ? 'active' : '' ?>" href="connexion.php">Connexion</a>
        </li>
      <?php } ?>


      <li class="nav-item">
        <a class="nav-link <?= ($current_page == 'contact.php') ? 'active' : '' ?>" href="contact.php">Contact</a>
      </li>

    </ul>
    <?php
    if ($_SESSION['user_id'] && $_SESSION['type'] == 'customer') {
      $query = "SELECT * FROM utilisateurs WHERE id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $_SESSION['user_id']);
      $stmt->execute();
      $result = $stmt->get_result();
      $r = $result->fetch_assoc();
      $stmt->close();
      if ($r) {
        echo '<span style="float:right; margin-top:-60px; color:white">Available Credit:' . $r['credit'] . '</span>';
      }
    }
    ?>

  </div>
</nav>