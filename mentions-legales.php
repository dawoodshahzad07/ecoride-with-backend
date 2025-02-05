<?php
include_once('db/conn.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions légales - EcoRide</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <?php include_once('nav.php'); ?>
    </header>

    <section class="mentions-legales-section">
        <div class="container">
            <h1>Mentions légales</h1>

            <h2>Éditeur du site</h2>
            <p>Le site <strong>EcoRide</strong> est édité par :</p>
            <ul>
                <li><strong>EcoRide SAS</strong></li>
                <li>Adresse : 123 Rue de l'Écologie, 75000 Paris, France</li>
                <li>Téléphone : +33 1 23 45 67 89</li>
                <li>Email : <a href="mailto:contact@ecoride.com">contact@ecoride.com</a></li>
                <li>Capital social : 100 000 €</li>
                <li>RCS Paris : 123 456 789</li>
            </ul>

            <h2>Hébergement</h2>
            <p>Le site est hébergé par :</p>
            <ul>
                <li><strong>Hébergeur Inc.</strong></li>
                <li>Adresse : 456 Rue des Serveurs, 75000 Paris, France</li>
                <li>Téléphone : +33 1 98 76 54 32</li>
            </ul>

            <h2>Conditions d'utilisation</h2>
            <p>En accédant à ce site, vous acceptez de vous conformer aux présentes mentions légales. EcoRide se réserve le droit de modifier ces conditions à tout moment et sans préavis.</p>

            <h2>Propriété intellectuelle</h2>
            <p>Le contenu de ce site, incluant les textes, images, logos, et autres éléments, est protégé par le droit d'auteur et appartient à EcoRide ou à ses partenaires. Toute reproduction ou représentation totale ou partielle de ce contenu sans autorisation est interdite.</p>

            <h2>Politique de confidentialité</h2>
            <p>EcoRide respecte la vie privée de ses utilisateurs. Les informations collectées via le site sont utilisées uniquement pour le bon fonctionnement du service de covoiturage. Aucune donnée personnelle ne sera partagée sans votre consentement.</p>

            <h2>Cookies</h2>
            <p>Le site utilise des cookies pour améliorer l'expérience utilisateur. Vous pouvez refuser l'utilisation des cookies en ajustant les paramètres de votre navigateur, mais certaines fonctionnalités du site pourraient ne pas fonctionner correctement.</p>

            <h2>Responsabilité</h2>
            <p>EcoRide s'efforce de maintenir le site à jour, mais ne peut garantir l'exactitude des informations fournies. EcoRide ne sera pas tenu responsable des erreurs, des interruptions du service ou des problèmes techniques pouvant survenir lors de l'utilisation du site.</p>

            <h2>Modification des mentions légales</h2>
            <p>EcoRide se réserve le droit de modifier les présentes mentions légales à tout moment. Toute modification sera publiée sur cette page.</p>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>📧 Email : <a href="mailto:contact@ecoride.com">contact@ecoride.com</a></p>
            <p><a href="index.php">Retour à l'accueil</a></p>
            <p>&copy; 2024 EcoRide - Tous droits réservés</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>

</html>