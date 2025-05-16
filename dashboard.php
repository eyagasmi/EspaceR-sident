<?php
session_start();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: index.php');
    exit;
} 

include 'includes/db.php';  // Connexion PDO
include 'includes/header.php';

// Récupérer le nombre de villas à louer (dans maison_louer)
$stmtLouer = $pdo->prepare("SELECT COUNT(*) FROM maison_louer");
$stmtLouer->execute();
$nombre_louer = $stmtLouer->fetchColumn();

// Récupérer le nombre de villas à vendre (dans villa_avendre)
$stmtVendre = $pdo->prepare("SELECT COUNT(*) FROM maison_avendre");
$stmtVendre->execute();
$nombre_vendre = $stmtVendre->fetchColumn();

// Récupérer total et nombre de satisfaits
$stmtSatisfaction = $pdo->query("SELECT 
    COUNT(*) as total, 
    SUM(CASE WHEN satisfait = 'satisfait' THEN 1 ELSE 0 END) as nb_satisfaits
FROM satisfaction");
$result = $stmtSatisfaction->fetch();

$total = (int)$result['total'];
$nb_satisfaits = (int)$result['nb_satisfaits'];
$taux_satisfaction = $total > 0 ? round(($nb_satisfaits / $total) * 100) : 0;
$nb_non_satisfaits = $total - $nb_satisfaits;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - Quartier</title>

    <!-- Lien vers ton fichier CSS -->
    <link rel="stylesheet" href="css/dashboard.css" />
    
    <!-- Chart.js depuis CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
</head>
<body>

<div class="dashboard-content">
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?> 👋</h1>

    <div class="cards">
        <div class="card villas-louer"> Villas à louer : <strong><?= $nombre_louer ?></strong></div>
        <div class="card villas-vendre"> Villas à vendre : <strong><?= $nombre_vendre ?></strong></div>
        <div class="card satisfaction"> Taux satisfaction : <strong><?= $taux_satisfaction ?>%</strong></div>
    </div>

    <div class="charts">
        <div class="chart-box">
            <h3>Satisfaction des habitants</h3>
            <canvas id="satisfactionChart"></canvas>
        </div>
    </div>
</div>

<!-- Script JS pour Chart.js -->
<script>
window.addEventListener("DOMContentLoaded", () => {
    const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
    new Chart(satisfactionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Satisfaits', 'Non satisfaits'],
            datasets: [{
                label: 'Taux satisfaction',
                data: [<?= $nb_satisfaits ?>, <?= $nb_non_satisfaits ?>],
                backgroundColor: ['#4CAF50', '#FF5252'],
                borderWidth: 1
            }]
        }
    });
});
</script>

</body>
</html>
