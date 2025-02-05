<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Créer un Compte</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Barre de navigation -->
    <header>
        <?php include_once('nav.php'); ?>
    </header>

    <!-- Section Créer un Compte -->
    <section class="register-section">
        <div class="container">
            <h2>Créer un compte EcoRide</h2>
            <form id="register-form" method="POST" action="db/auth.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Entrez votre nom complet" required>
                </div>
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre adresse e-mail" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmer le mot de passe</label>
                    <input type="password" id="confirm-password" name="confirm_password" class="form-control" placeholder="Confirmez votre mot de passe" required>
                </div>
                <div class="form-group">
                    <label>Photo de profil</label>
                    <input type="file" name="profile" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="type">Type d'utilisateur</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="driver">Conducteur</option>
                        <option value="customer">Client</option>
                    </select>
                </div>
                <button type="submit" name="register" class="btn-primary">Créer un compte</button>
                <p id="error-message" class="error-message"></p>
            </form>

            <div class="text-center">
                <p>Vous avez déjà un compte ? <a href="connexion.php">Se connecter</a></p>
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
</body>

</html>