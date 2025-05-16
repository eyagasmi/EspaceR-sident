<?php
session_start();
include '../includes/db.php';
include '../includes/navbar.php';

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: ../login.php');
    exit;
}

// Récupérer les maisons à vendre
$stmt = $pdo->prepare("SELECT * FROM maison_avendre ORDER BY date_ajout DESC");
$stmt->execute();
$maisons = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Villas à Vendre</title>
    <link rel="stylesheet" href="../css/villa_louer.css">  <!-- même CSS que villa_louer -->
</head>
<body>
    <div class="main-content">
        <div class="page-title">
            <h1>MAISONS À VENDRE</h1>  <!-- titre centré -->
        </div>

        <div class="maisons-container">
            <?php if (count($maisons) === 0): ?>
                <p>Aucune villa à vendre pour le moment.</p>
            <?php else: ?>
                <?php foreach ($maisons as $maison): ?>
                    <div class="maison-card">
                        <?php if ($maison['image']): ?>
                            <img src="../uploads/<?= htmlspecialchars($maison['image']) ?>" alt="Villa à vendre">
                        <?php endif; ?>
                        <div class="maison-details">
                            <p><strong>Adresse:</strong> <?= htmlspecialchars($maison['adresse']) ?></p>
                            <p><strong>Description:</strong> <?= htmlspecialchars($maison['description']) ?></p>
                            <p><strong>Chambres:</strong> <?= $maison['nb_chambres'] ?></p>
                            <p><strong>Prix (€):</strong> <?= number_format($maison['prix'], 2) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
