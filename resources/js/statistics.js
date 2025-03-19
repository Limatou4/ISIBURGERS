// resources/js/statistics.js
import Chart from 'chart.js';

const ctx = document.getElementById('monthly-orders-chart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'], // Mois
        datasets: [{
            label: 'Commandes par mois',
            data: [5, 10, 15, 20, 25], // Données
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
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
