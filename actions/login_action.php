<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $user['id'];
        $_SESSION['nom'] = $user['nom']; // si la table utilisateurs a bien une colonne 'nom'
        $_SESSION['role'] = $user['role'];

        // Redirige selon le rôle
        if ($user['role'] === 'admin') {
            header('Location: ../dashboard.php');
            exit;
        } elseif ($user['role'] === 'habitant') {
            header('Location: ../habitants/profile.php');
            exit;
        } else {
            header('Location: ../index.php?erreur=1');
            exit;
        }
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>