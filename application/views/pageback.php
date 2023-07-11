<!DOCTYPE html>
<html>
<head>
    <title>Page Back</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>
<body>
    <h1>Page Back</h1>

    <h2>Statistiques par genre</h2>

    <canvas id="genderStatisticsChart"></canvas> <!-- Élément canvas pour le graphique des statistiques par genre -->

    <script>
    // Récupérer les données des statistiques depuis PHP
    var genderData = <?php echo json_encode($statisticsByGender); ?>;

    // Créer le graphique pour les statistiques par genre
    var genderChart = new Chart(document.getElementById('genderStatisticsChart'), {
        type: 'bar',
        data: {
            labels: ['Femme', 'Homme'],
            datasets: [{
                label: 'Statistiques par genre',
                data: genderData.map(item => item.percentage),
                backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)'],
                borderColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100, // Limite l'axe Y à 100 pourcentage
                    callback: function(value) {
                        return value + '%'; // Ajoute le symbole de pourcentage
                    }
                }
            }
        }
    });
</script>



</body>
</html>
