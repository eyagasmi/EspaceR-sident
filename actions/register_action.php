<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $code_maison = trim($_POST['code_maison']);
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirm = $_POST['mot_de_passe_confirm'];

    // Vérification simple
    if ($mot_de_passe !== $confirm) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Hachage du mot de passe
    $hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);

    // Insertion
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, code_maison, mot_de_passe) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $code_maison, $hash]);

    // Redirection
    header('Location: ../index.php');
    exit;
}
?>
