<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Connexion et Créer un compte</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Barre de navigation -->
    <header>
        <?php include_once('nav.php'); ?>
    </header>

    <!-- Section Connexion -->
    <section class="connexion-section">
        <div class="container">
            <h2>Se connecter à EcoRide</h2>
            <form id="login-form" method="POST" action="db/auth.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="remember-me" class="form-check-input">
                    <label for="remember-me" class="form-check-label">Se souvenir de moi</label>
                </div>
                <input type="hidden" name="previous_url" id="previous_url" value="">
                <button type="submit" name="login" class="btn-primary">Se connecter</button>
                <p id="error-message" class="error-message"></p>
            </form>
            <div class="text-center">
                <p>Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>Vous avez des questions ? <a href="contact.php">Contactez-nous ici</a> !</p>
            <p><a href="mentions-legales.php">Mentions légales</a></p>
            <p>&copy; 2024 EcoRide - Tous droits réservés</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
    <script>
        // JavaScript to capture the referrer URL (previous page)
        document.getElementById('previous_url').value = document.referrer || '../index.php';
    </script>
</body>

</html>
