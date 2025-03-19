<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Commandes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            text-align: center;
        }
        canvas {
            max-width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>📊 Statistiques des Commandes</h1>

        <!-- Commandes du jour -->
        <h2>📅 Commandes du jour</h2>
        <p><strong>En attente :</strong> <span id="cmdEnCours">0</span></p>
        <p><strong>Payée :</strong> <span id="cmdValidees">0</span></p>

        <!-- Nombre de commandes par mois -->
        <h2>📊 Nombre de commandes par mois</h2>
        <canvas id="commandeChart"></canvas>

        <!-- Nombre de produits par catégorie par mois -->
        <h2>📦 Nombre de Burgers par mois</h2>
        <canvas id="produitChart"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    // 📅 1️⃣ Récupérer les commandes en cours et validées de la journée
    fetch('/stats/commandes-en-cours')
        .then(response => response.json())
        .then(data => document.getElementById('cmdEnCours').textContent = data.en_cours);

    fetch('/stats/commandes-validees')
        .then(response => response.json())
        .then(data => document.getElementById('cmdValidees').textContent = data.validees);

    // 📊 2️⃣ Afficher le graphique des commandes par mois
    fetch('/stats/commandes-par-mois')
        .then(response => response.json())
        .then(data => {
            let labels = data.map(item => item.mois); // Utilisation des noms de mois
            let values = data.map(item => item.total);

            let ctx = document.getElementById('commandeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Afficher les mois en texte
                    datasets: [{
                        label: 'Nombre de commandes par mois',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

    // 📦 3️⃣ Afficher le graphique des produits par catégorie par mois
    fetch('/stats/burgers-par-mois')  // Récupérer les burgers par mois
    .then(response => response.json())
    .then(data => {
        // Extraire les mois et les totaux de burgers
        let labels = data.map(item => 'Mois ' + item.mois); // Affichage du mois
        let values = data.map(item => item.total); // Nombre de burgers

        // Créer le graphique
        let ctx = document.getElementById('produitChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Affichage des mois avec leur nom
                datasets: [{
                    label: 'Nombre de burgers par mois',
                    data: values, // Totaux des burgers
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',  // Couleur du graphique
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

});

    </script>

</body>
</html>
