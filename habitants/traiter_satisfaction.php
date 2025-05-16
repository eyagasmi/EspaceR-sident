<?php
session_start();
include '../includes/db.php';

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'habitant') {
    header('Location: ../index.php');
    exit;
}

// Récupère l'ID de l'utilisateur
$userId = $_SESSION['utilisateur_id'];

// Vérifie que toutes les réponses sont envoyées
if (isset($_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'], $_POST['q5'], $_POST['q6'], $_POST['q7'], $_POST['q8'], $_POST['q9'], $_POST['q10'])) {
    
    // Récupère les réponses
    $responses = [];
    for ($i = 1; $i <= 10; $i++) {
        $responses['q' . $i] = $_POST['q' . $i];
    }

    // Calcule le score (somme des réponses où "oui" = 1, "non" = 0)
    $score = array_sum($responses);

    // Détermine si l'utilisateur est satisfait ou non (si 5 réponses ou plus sont "oui", alors satisfait)
    $satisfait = ($score >= 5) ? 'Satisfait' : 'Non satisfait';

    // Prépare la requête SQL pour insérer les données dans la base
    $stmt = $pdo->prepare("
        INSERT INTO satisfaction (utilisateur_id, score, satisfait, date_soumission)
        VALUES (:utilisateur_id, :score, :satisfait, NOW())
    ");

    // Exécute la requête avec les données du formulaire
    $stmt->execute([
        ':utilisateur_id' => $userId,
        ':score' => $score,
        ':satisfait' => $satisfait
    ]);

    // Redirige avec un message de succès en utilisant la session
    $_SESSION['success'] = "Merci pour votre participation ! Votre enquête de satisfaction a bien été envoyée.";

    // Redirection vers la même page avec un message d'alerte
    header('Location: satisfaction.php');
    exit;
} else {
    // Si les réponses sont incomplètes, redirige vers la page de l'enquête
    header('Location: satisfaction.php?erreur=1');
    exit;
}

?>
