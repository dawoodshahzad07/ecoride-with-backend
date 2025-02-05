// Exemple de données d'itinéraires (plusieurs covoiturages)
const itineraries = [
    {
        id: 1, // Identifiant unique pour chaque covoiturage
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
        id: 29,
        departure: "Marseille",
        destination: "Nice",
        date: "2024-11-28",
        timeStart: "09:00",
        timeEnd: "11:30",
        driver: { name: "Claire", photo: "images/driver2.jpg", rating: 4.7 },
        seats: 0,  // Pas de place disponible
        price: 20,
        ecological: false,
        car: { model: "Renault Clio", brand: "Renault", energy: "Gasoline" },
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

// Fonction pour afficher les résultats
document.getElementById("search-form").addEventListener("submit", function (e) {
    e.preventDefault(); // Empêcher l'envoi du formulaire

    const departure = document.getElementById("departure").value.trim().toLowerCase();
    const destination = document.getElementById("destination").value.trim().toLowerCase();
    const date = document.getElementById("date").value.trim();

    const resultsContainer = document.getElementById("results-container");
    const noResultsMessage = document.getElementById("no-results");

    resultsContainer.innerHTML = "";
    noResultsMessage.style.display = "none";

    // Filtrer les itinéraires disponibles
    const results = itineraries.filter(itinerary => {
        const depMatch = itinerary.departure.toLowerCase() === departure;
        const destMatch = itinerary.destination.toLowerCase() === destination;
        const dateMatch = itinerary.date === date;
        const seatsAvailable = itinerary.seats > 0;

        return depMatch && destMatch && dateMatch && seatsAvailable;
    });

    if (results.length > 0) {
        results.forEach(itinerary => {
            const covoiturageDiv = document.createElement("div");
            covoiturageDiv.classList.add("covoiturage");

            covoiturageDiv.innerHTML = `
                <img src="${itinerary.driver.photo}" alt="${itinerary.driver.name}">
                <div class="covoiturage-info">
                    <h3>${itinerary.driver.name} - Note : ${itinerary.driver.rating} ⭐</h3>
                    <p>Places restantes : ${itinerary.seats}</p>
                    <p class="price">Prix : ${itinerary.price} €</p>
                    <p>Départ : ${itinerary.timeStart} - Arrivée : ${itinerary.timeEnd}</p>
                    <p class="${itinerary.ecological ? "ecologique" : "not-ecologique"}">
                        ${itinerary.ecological ? "Voyage écologique ♻️" : "Non écologique 🚗"}
                    </p>
                    <a href="details.html?id=${itinerary.id}" class="details-btn">Détails</a>  <!-- Lien vers la page de détails -->
                </div>
            `;
            resultsContainer.appendChild(covoiturageDiv);
        });
    } else {
        noResultsMessage.style.display = "block";
        noResultsMessage.innerHTML = "Aucun covoiturage trouvé.";
    }
});

