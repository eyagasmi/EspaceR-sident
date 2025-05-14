<?php
session_start();
include '../includes/db.php';
include '../includes/navbar.php';

if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'habitant') {
    header('Location: ../index.php');
    exit;
}

$questions = [
    "Es-tu satisfait de ton quartier ?",
    "Es-tu satisfait par le syndic ?",
    "Le voisinage est-il agréable ?",
    "Les services d'entretien sont-ils efficaces ?",
    "La sécurité est-elle suffisante ?",
    "La propreté des lieux te convient-elle ?",
    "Es-tu satisfait des espaces verts ?",
    "Es-tu satisfait de l'éclairage public ?",
    "Le stationnement est-il suffisant ?",
    "Les informations sont-elles bien communiquées ?"
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Enquête de Satisfaction</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<div class="main-content">
    <h1>Enquête de Satisfaction</h1>
    <form action="traiter_satisfaction.php" method="POST" class="card-box">
        <?php foreach ($questions as $index => $question): ?>
            <div class="question-block">
                <p><?= ($index + 1) ?>. <?= $question ?></p>
                <div class="radio-group">
                    <label><input type="radio" name="q<?= $index + 1 ?>" value="1" required> Oui</label>
                    <label><input type="radio" name="q<?= $index + 1 ?>" value="0"> Non</label>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit">Envoyer mes réponses</button>
    </form>
</div>
</body>
</html>
