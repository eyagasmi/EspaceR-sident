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

    // Calcule le score (somme des réponses)
    $score = array_sum($responses);

    // Prépare la requête SQL pour insérer les données dans la base
    $stmt = $pdo->prepare("
        INSERT INTO satisfaction (utilisateur_id, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, score)
        VALUES (:utilisateur_id, :q1, :q2, :q3, :q4, :q5, :q6, :q7, :q8, :q9, :q10, :score)
    ");

    // Exécute la requête avec les données du formulaire
    $stmt->execute([
        ':utilisateur_id' => $userId,
        ':q1' => $responses['q1'],
        ':q2' => $responses['q2'],
        ':q3' => $responses['q3'],
        ':q4' => $responses['q4'],
        ':q5' => $responses['q5'],
        ':q6' => $responses['q6'],
        ':q7' => $responses['q7'],
        ':q8' => $responses['q8'],
        ':q9' => $responses['q9'],
        ':q10' => $responses['q10'],
        ':score' => $score,
    ]);

    // Redirige l'utilisateur vers une page de confirmation ou vers son profil
    header('Location: confirmation.php'); // Tu peux rediriger vers une page de confirmation
    exit;
} else {
    // Si les réponses sont incomplètes, redirige vers la page de l'enquête
    header('Location: satisfaction.php?erreur=1');
    exit;
}
?>
