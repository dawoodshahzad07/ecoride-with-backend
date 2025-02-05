// Récupérer l'ID du covoiturage dans l'URL
const urlParams = new URLSearchParams(window.location.search);
const covoiturageId = urlParams.get('id');

// Exemple de données des covoiturages (les mêmes que dans main.js)
const itineraries = [
    {
        id: 1,
        departure: "Paris",
        destination: "Lyon",
        date: "2024-11-28",
        timeStart: "08:00",
        timeEnd: "12:00",
        driver: { name: "Jean", photo: "images/driver1.jpg", rating: 4.5 },
        seats: 3,
        price: 25,
        ecological: true,
        car: { model: "Tesla Model 3", brand: "Tesla", energy: "Electric" },
        preferences: { pets: true, smoking: false },
        reviews: [
            { user: "Alice", comment: "Très bon conducteur, voyage agréable!", rating: 5 },
            { user: "Bob", comment: "Voyage tranquille, très bonne expérience.", rating: 4.5 }
        ]
    },
    {
        id: 20,
        departure: "Marseille",
        destination: "Nice",
        date: "2024-11-28",
        timeStart: "09:00",
        timeEnd: "11:30",
        driver: { name: "Claire", photo: "images/driver2.jpg", rating: 4.7 },
        seats: 0,
        price: 20,
        ecological: false,
        car: { model: "Renault Clio", brand: "Renault", energy: "Electric" },
        preferences: { pets: false, smoking: true },
        reviews: [
            { user: "David", comment: "Très sympa mais fumeur.", rating: 3 },
            { user: "Eva", comment: "Conduite agréable mais il y avait une forte odeur de tabac.", rating: 3.5 }
        ]
    },
    {
        id: 3,
        departure: "Paris",
        destination: "Toulouse",
        date: "2024-11-29",
        timeStart: "10:00",
        timeEnd: "15:00",
        driver: { name: "Pierre", photo: "images/driver3.jpg", rating: 4.2 },
        seats: 4,
        price: 30,
        ecological: false,
        car: { model: "Peugeot E-3008", brand: "Peugeot", energy: "Electric" },
        preferences: { pets: false, smoking: false },
        reviews: [
            { user: "Lucas", comment: "Bon conducteur, mais un peu rapide.", rating: 4 },
            { user: "Marie", comment: "Voyage calme, bon conducteur.", rating: 4.5 }
        ]
    },
    {
        id: 4,
        departure: "Bordeaux",
        destination: "Paris",
        date: "2024-12-01",
        timeStart: "06:30",
        timeEnd: "12:00",
        driver: { name: "Sophie", photo: "images/driver4.jpg", rating: 4.6 },
        seats: 2,
        price: 27,
        ecological: true,
        car: { model: "BMW i3", brand: "BMW", energy: "Electric" },
        preferences: { pets: true, smoking: false },
        reviews: [
            { user: "Chloe", comment: "Conduite parfaite et véhicule très agréable.", rating: 5 },
            { user: "Marc", comment: "Je recommande vivement!", rating: 5 }
        ]
    },
    {
        id: 5,
        departure: "Lyon",
        destination: "Marseille",
        date: "2024-12-02",
        timeStart: "14:00",
        timeEnd: "16:30",
        driver: { name: "Alex", photo: "images/driver5.jpg", rating: 4.0 },
        seats: 1,
        price: 18,
        ecological: true,
        car: { model: "Nissan Leaf", brand: "Nissan", energy: "Electric" },
        preferences: { pets: false, smoking: true },
        reviews: [
            { user: "Emma", comment: "Véhicule très confortable et écologique.", rating: 4.5 },
            { user: "John", comment: "Conducteur sympathique mais je n'aime pas fumer.", rating: 3.5 }
        ]
    },
    // Ajoutez d'autres covoiturages ici pour tester
];

// Trouver le covoiturage avec l'ID correspondant
const covoiturage = itineraries.find(item => item.id == covoiturageId);

// Afficher les détails
const detailsContainer = document.getElementById("covoiturage-details");

if (covoiturage) {
    detailsContainer.innerHTML = `
        <h2>Détails du Covoiturage</h2>
        <div class="covoiturage-detail">
            <img src="${covoiturage.driver.photo}" alt="${covoiturage.driver.name}">
            <h3>${covoiturage.driver.name}</h3>
            <p>Note : ${covoiturage.driver.rating} ⭐</p>
            <p><strong>Départ :</strong> ${covoiturage.departure} à ${covoiturage.timeStart}</p>
            <p><strong>Arrivée :</strong> ${covoiturage.destination} à ${covoiturage.timeEnd}</p>
            <p><strong>Prix :</strong> ${covoiturage.price} €</p>
            <p><strong>Écologique :</strong> ${covoiturage.ecological ? "Oui" : "Non"}</p>
            <p><strong>Véhicule :</strong> ${covoiturage.car.model} (${covoiturage.car.brand}) - ${covoiturage.car.energy}</p>
            <p><strong>Préférences du conducteur :</strong> Fumeurs : ${covoiturage.preferences.smoking ? "Oui" : "Non"}, Animaux : ${covoiturage.preferences.pets ? "Oui" : "Non"}</p>
            <h4>Avis des utilisateurs :</h4>
            <ul>
                ${covoiturage.reviews.map(review => `<li><strong>${review.user}</strong> : ${review.comment} (${review.rating} ⭐)</li>`).join('')}
            </ul>
        </div>
    `;
} else {
    detailsContainer.innerHTML = "<p>Covoiturage introuvable.</p>";
}
