<?php
include_once('db/conn.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Barre de navigation -->
    <header>
        <?php include_once('nav.php'); ?>
    </header>

    <!-- Section Hero (Accueil) -->
    <section class="hero">
        <div class="container">
            <h1>Bienvenue sur EcoRide</h1>
            <p>Chez EcoRide, nous croyons que chaque geste compte pour préserver notre planète. C’est pourquoi nous avons créé une plateforme de covoiturage écologique et économique, destinée à simplifier vos trajets quotidiens tout en réduisant votre empreinte carbone. Que vous soyez à la recherche d’un trajet ponctuel ou d’une solution régulière pour vos déplacements, nous vous proposons une alternative durable aux transports traditionnels</p>
            <img src="images/ecologie.jpg" alt="Écologie et Covoiturage" class="img-fluid my-4">
            <a href="covoiturages.php" class="btn btn-primary">Explorer les covoiturages</a>
        </div>
    </section>

    <!-- Section Pourquoi choisir EcoRide ? -->
    <section class="why-choose-us">
        <div class="container">
            <h2>Pourquoi choisir EcoRide ?</h2>
            <p>EcoRide n'est pas seulement une plateforme de covoiturage, c'est un moyen de voyager de manière responsable, économique et agréable. Découvrez les raisons pour lesquelles vous devriez choisir EcoRide :</p>
            <div class="row">
                <div class="col-md-4">
                    <h3>Écologique</h3>
                    <img src="images/electric-car.jpg" alt="Voiture écologique" class="img-fluid">
                    <p>Réduisez votre empreinte carbone en partageant un trajet avec d'autres passagers dans des véhicules écologiques. Chaque trajet partagé contribue à un avenir plus vert.</p>
                </div>
                <div class="col-md-4">
                    <h3>Économique</h3>
                    <img src="images/price.jpg" alt="Prix abordable" class="img-fluid">
                    <p>Faites des économies substantielles en partageant les frais de voyage avec d'autres. Le covoiturage avec EcoRide est l'un des moyens les plus rentables pour se déplacer.</p>
                </div>
                <div class="col-md-4">
                    <h3>Communautaire</h3>
                    <img src="images/community.jpg" alt="Communauté" class="img-fluid">
                    <p>Rejoignez une communauté engagée. Voyager avec EcoRide, c'est rencontrer de nouvelles personnes et partager des moments conviviaux dans un esprit d'entraide.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Témoignages -->
    <section class="testimonials">
        <div class="container">
            <h2>Ce que nos utilisateurs disent</h2>
            <div class="testimonial-carousel">
                <div class="testimonial">
                    <p>"EcoRide a changé ma façon de voyager. C'est économique, écologique, et je fais de belles rencontres à chaque trajet."</p>
                    <p class="author">- Julie, utilisatrice fidèle</p>
                </div>
                <div class="testimonial">
                    <p>"J'adore l'idée du covoiturage avec EcoRide ! C'est facile à utiliser et j'économise de l'argent tout en contribuant à la protection de l'environnement."</p>
                    <p class="author">- Marc, utilisateur heureux</p>
                </div>
                <div class="testimonial">
                    <p>"Une expérience de covoiturage incroyable ! Des trajets confortables, des conducteurs sympas, et une vraie communauté !" </p>
                    <p class="author">- Sophie, voyageuse régulière</p>
                </div>
                <div class="testimonial">
                    <p>"J'ai trouvé un excellent trajet à un prix très abordable. L'interface est super facile à utiliser et c'est génial de partager des trajets avec d'autres."</p>
                    <p class="author">- Thierry, conducteur satisfait</p>
                </div>
                <div class="testimonial">
                    <p>"EcoRide est un moyen pratique de réduire mes coûts de transport tout en contribuant à l'environnement. J'ai fait de nouvelles connaissances à chaque voyage."</p>
                    <p class="author">- Emma, utilisateur enthousiaste</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Footer -->


    <footer>
        <div class="contact-info">
            <h3>Nos informations</h3>
            <p>📧 Email : <a href="mailto:contact@ecoride.com">contact@ecoride.com</a></p>
            <p>📞 Téléphone : +33 1 23 45 67 89</p>
            <p>🏢 Adresse : 123 Rue de l'Écologie, Paris, France</p>
        </div>
        <div class="container">
            <p>Pour toute question ou demande, <a href="contact.php">contactez-nous ici</a> !</p>
            <p><a href="mentions-legales.php">Mentions légales</a></p>
            <p>&copy; 2024 EcoRide - Tous droits réservés</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>

</html>