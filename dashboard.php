<?php
session_start();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: index.php');
    exit;
}

include 'includes/header.php';
?>



<div class="dashboard-content">
<h1>Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?> 👋</h1>

  <div class="cards">
    <div class="card">🏠 Villas non louées : <strong>12</strong></div>
    <div class="card">🏡 Villas à vendre : <strong>5</strong></div>
    <div class="card">😊 Taux satisfaction : <strong>87%</strong></div>
  </div>
  
  <div class="charts">
  <div class="chart-box">
    <h3>Satisfaction des habitants</h3>
    <canvas id="satisfactionChart"></canvas>
  </div>

  <div class="chart-box">
    <h3>Villas louées vs non louées</h3>
    <canvas id="villaChart"></canvas>
  </div>
</div>


</div>

<!-- Chart.js depuis CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Fichier JS de ta page -->
<script src="js/dashboard.js"></script>

