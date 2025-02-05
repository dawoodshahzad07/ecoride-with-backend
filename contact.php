<?php
include_once('db/conn.php');
include_once('config.php');

if (isset($_POST['send_message'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    $to_email = to_email;

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = $to_email;
        $subject = "Nouveau message de contact d'EcoRide";
        $headers = "From: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $body = "<html>
                    <head><title>Message de Contact</title></head>
                    <body>
                        <h2>Message de Contact</h2>
                        <p><strong>Nom:</strong> $name</p>
                        <p><strong>Email:</strong> $email</p>
                        <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
                    </body>
                </html>";
    } else {
        echo "<script>alert('Adresse email invalide.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Contact</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Barre de navigation -->
    <header>
        <?php include_once('nav.php'); ?>
    </header>

    <!-- Section Contact -->
    <section class="contact-section">
        <div class="container">
            <h2>Contactez-nous</h2>
            <p>Si vous avez des questions ou souhaitez plus d'informations, n'hésitez pas à nous contacter via ce formulaire.</p>

            <!-- Formulaire de contact -->
            <form class="contact-form" method="post" action="">
                <div class="form-group">
                    <label for="name">Votre nom</label>
                    <input name="name" type="text" id="name" class="form-control" placeholder="Entrez votre nom" required>
                </div>
                <div class="form-group">
                    <label for="email">Votre email</label>
                    <input name="email" type="email" id="email" class="form-control" placeholder="Entrez votre email" required>
                </div>
                <div class="form-group">
                    <label for="message">Votre message</label>
                    <textarea name="message" id="message" class="form-control" placeholder="Écrivez votre message ici" rows="4" required></textarea>
                </div>
                <button type="submit" name="send_message" class="btn-primary">Envoyer le message</button>
            </form>

            <!-- Informations de contact -->
            <div class="contact-info">
                <h3>Nos informations</h3>
                <p>📧 Email : <a href="mailto:contact@ecoride.com">contact@ecoride.com</a></p>
                <p>📞 Téléphone : +33 1 23 45 67 89</p>
                <p>🏢 Adresse : 123 Rue de l'Écologie, Paris, France</p>
            </div>

            <!-- Carte Google Maps -->
            <div class="map-container">
                <h3>Nous trouver sur la carte</h3>
                <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>Contactez-nous : <a href="mailto:contact@ecoride.com">contact@ecoride.com</a></p>
        <p><a href="mentions-legales.php">Mentions légales</a></p>
    </footer>

    <script src="js/main.js"></script>
</body>

</html>