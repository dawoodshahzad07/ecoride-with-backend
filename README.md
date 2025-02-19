Projet EcoRide
1:Créez une nouvelle base de données avec le nom "ecoride_french".

2:Ajoutez les identifiants dans "auth.php" et "conn.php".

3:Créez un nouveau dossier "ecoride" dans le dossier htdocs et placez-y tous les fichiers et dossiers.

4:Ouvrez un navigateur et entrez l'URL "/ecoride" pour accéder au projet.

Inscription de l'utilisateur
Lorsqu'un utilisateur s'inscrit, il doit choisir son type de compte :
Si l'utilisateur choisit le type "Conducteur", il sera redirigé vers la page "Ajouter un covoiturage", où il pourra :
Ajouter des covoiturages
Voir l'historique de ses covoiturages
Annuler un covoiturage
Si l'utilisateur choisit le type "Client", il sera redirigé vers la page "Rechercher un covoiturage", où il pourra :
Entrer des lieux et une date pour rechercher des covoiturages disponibles
Voir les résultats correspondants affichés en dessous, avec un bouton "Détails"
En cliquant sur "Détails", il pourra voir les informations du covoiturage et réserver un ou plusieurs sièges
Pour réserver, il doit entrer le nombre de sièges souhaités et cliquer sur "Réserver maintenant"
La réservation sera effectuée, soustrayant le nombre de sièges du covoiturage et le montant correspondant du crédit du client
Après la réservation
L'utilisateur est redirigé vers une page de réservation, où il pourra :

Écrire un avis et donner une note au conducteur
Annuler la réservation (dans ce cas, le crédit sera remboursé et les sièges seront remis à disposition)
Si un conducteur annule un covoiturage, le crédit est remboursé à tous les passagers et un email leur est envoyé.

Compte Administrateur
Email : admin@gmail.com
Mot de passe : admin

Fonctionnalités de l'administrateur :
a. Voir tous les utilisateurs
b. Suspendre n'importe quel utilisateur
c. Ajouter un employé

Compte Employé
Fonctionnalités de l'employé :

Voir les avis des clients
Accepter ou rejeter un avis
Une fois accepté, la note est ajoutée au conducteur et l'avis est affiché sur la page des détails

