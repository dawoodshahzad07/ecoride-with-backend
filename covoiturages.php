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

    <!-- Formulaire de recherche -->
    <section class="search-section">
        <div class="container">
            <h1>Rechercher un covoiturage</h1>
            <form action="" method="GET">
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
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="date">Nombre d'étoiles du conducteur:</label>
                    <select name="rating" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <button type="submit" name="search" class="btn-primary">Rechercher</button>
            </form>
        </div>
    </section>

    <!-- Résultats des covoiturages -->
    <section class="results-section">
        <div class="container">
            <div id="results-container">
                <h2>Résultats</h2>
                <?php
                if (isset($_GET['search'])) {
                    $departure = $_GET['departure'];
                    $destination = $_GET['destination'];
                    $rating = $_GET['rating'];
                    $date = $_GET['date'];

                    $query = "
                        SELECT covoiturages.*, utilisateurs.nom AS driver_name, utilisateurs.photo AS driver_photo, utilisateurs.email AS driver_email, utilisateurs.note AS driver_rating
                        FROM covoiturages
                        LEFT JOIN utilisateurs ON utilisateurs.id = covoiturages.chauffeur_id
                        WHERE covoiturages.depart = ? AND covoiturages.destination = ? AND covoiturages.date = ? AND covoiturages.statut = ? AND utilisateurs.note = ?
                    ";

                    $status = 'active';
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssss", $departure, $destination, $date, $status, $rating);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($res = $result->fetch_assoc()) {
                ?>
                        <div class="covoiturage">
                            <img src="profiles/<?php echo htmlspecialchars($res['driver_photo']); ?>" alt="<?php echo htmlspecialchars($res['driver_name']); ?>">

                            <div class="covoiturage-info">
                                <h3><?php echo htmlspecialchars($res['driver_name']); ?> - Note : <?php echo htmlspecialchars($res['driver_rating']); ?> ⭐</h3>
                                <p>Places restantes : <?php echo htmlspecialchars($res['places']); ?></p>

                                <p>Départ : <?php echo htmlspecialchars($res['heure_depart']); ?> - Arrivée : <?php echo htmlspecialchars($res['heure_arrivee']); ?></p>

                                <?php if ($res['ecologique'] == 'Electric' || $res['ecologique'] == 'Hybrid') { ?>

                                    <p class="<?php echo " ecologique"; ?>">
                                    <?php echo "Voyage écologique ♻️";
                                } else { ?>
                                    </p>
                                    <p class="<?php echo "not-ecologique"; ?>">
                                    <?php echo "Non écologique 🚗";
                                }
                                    ?>
                                    </p>

                                    <a href="details.php?id=<?php echo htmlspecialchars($res['id']); ?>" class=" details-btn">Détails</a> <!-- Lien vers la page de détails -->



                            </div>
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