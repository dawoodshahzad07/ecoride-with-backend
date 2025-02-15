<?php
include_once('db/conn.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Détails du Covoiturage</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <?php include_once('nav.php'); ?>
    </header>

    <section class="details-section">
        <div class="container" id="covoiturage-det9ails">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $query = "
            SELECT covoiturages.*, utilisateurs.nom AS driver_name, utilisateurs.photo AS driver_photo, utilisateurs.email AS driver_email, utilisateurs.note AS driver_rating
            FROM covoiturages
            LEFT JOIN utilisateurs ON utilisateurs.id = covoiturages.chauffeur_id
            WHERE covoiturages.id = ?
        ";

                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($res = $result->fetch_assoc()) {
            ?>
                    <h2>Détails du Covoiturage</h2>
                    <div class="covoiturage-detail">
                        <img src="profiles/<?php echo htmlspecialchars($res['driver_photo']); ?>" alt="<?php echo htmlspecialchars($res['driver_name']); ?>">

                        <h3><?php echo htmlspecialchars($res['driver_name']); ?> </h3>
                        <form action="db/carpool.php" method="post" style="width: 100px; margin:0 auto">
                            <input type="hidden" name="carpool_id" value="<?php echo ($res['id']); ?>">
                            <input type="hidden" name="driver_id" value="<?php echo ($res['chauffeur_id']); ?>">
                            <label for="">Number of Seats</label>
                            <input type="number" style="width: 100%; height:30px" name="seats" min='1' max='<?php echo ($res['places']); ?>'>
                            <button type="submit" style="width: 100%;" name="book_now" class=" details-btn">Book Now</button>
                        </form>

                        <p>Note : <?php echo htmlspecialchars($res['driver_rating']); ?> ⭐</p>

                        <p><strong>Départ :</strong> <?php echo htmlspecialchars($res['depart']); ?> à <?php echo htmlspecialchars($res['heure_depart']); ?></p>
                        <p><strong>Arrivée :</strong> <?php echo htmlspecialchars($res['destination']); ?> à <?php echo htmlspecialchars($res['heure_arrivee']); ?></p>
                        <p><strong>Écologique :</strong>
                            <?php if ($res['ecologique'] == 'Electric' || $res['ecologique'] == 'Hybrid') {

                                echo "Voyage écologique ♻️";
                            } else {
                                echo "Non écologique 🚗";
                            } ?>
                        </p>
                        <p><strong>Véhicule :</strong> <?php echo htmlspecialchars($res['modele_voiture']); ?> (<?php echo htmlspecialchars($res['marque_voiture']); ?>) - <?php echo htmlspecialchars($res['energie_voiture']); ?></p>
                        <p><strong>Préférences du conducteur :</strong>
                            Fumeurs : <?php echo $res['animaux_autorises'] ? "Oui" : "Non"; ?>,
                            Animaux : <?php echo $res['fumeur_autorise'] ? "Oui" : "Non"; ?>
                        </p>
                        <h4>Avis des utilisateurs :</h4>
                        <?php

                        $status = 'accepted';
                        $chauffeur_id = isset($res['chauffeur_id']) ? intval($res['chauffeur_id']) : 0;

                        $reviews = "SELECT avis.*, utilisateurs.nom 
            FROM avis 
            LEFT JOIN utilisateurs ON utilisateurs.id = avis.client_id 
            WHERE chauffeur_id = ? AND avis.statut = ?";

                        $stmt_reviews = $conn->prepare($reviews);

                        if ($stmt_reviews) {
                            $stmt_reviews->bind_param("is", $chauffeur_id, $status); // Corrected to "is"
                            $stmt_reviews->execute();
                            $result_reviews = $stmt_reviews->get_result();
                        } else {
                            echo "Error preparing statement: " . $conn->error;
                        }


                        while ($res_reviews = $result_reviews->fetch_assoc()) {
                        ?>
                            <ul>
                            <?php
                            echo '<li><strong>' . htmlspecialchars($res_reviews['nom']) . '</strong> : ' . htmlspecialchars($res_reviews['commentaire']) . ' (' . htmlspecialchars($res_reviews['note']) . ' ⭐)</li>';
                        } ?>
                            </ul>



                    </div>
        </div>
<?php
                    break;
                }

                $stmt->close();
            }
?>
</div>
</div>
    </section>

    <footer>
        <div class="container">
            <p>📧 Email : <a href="mailto:contact@ecoride.com">contact@ecoride.com</a></p>
            <p><a href="mentions-legales.php">Mentions légales</a></p>
            <p>&copy; 2024 EcoRide - Tous droits réservés</p>
        </div>
    </footer>

    <script src="js/details.js"></script>
</body>

</html>