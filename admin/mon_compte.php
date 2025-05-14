<?php
session_start();
require_once '../includes/db.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: index.php'); // Redirection si non connecté
    exit;
}

// Récupérer l'utilisateur connecté
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$_SESSION['utilisateur_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../css/mon_compte.css"> 
    <link rel="stylesheet" href="../css/style.css"> <!-- Lien vers ton fichier CSS -->
</head>
<body>
    <!-- Inclure le navbar -->
    <?php include '../includes/header.php'; ?>

    <!-- Contenu principal de la page -->
    
    <div class="main-content">
        
        <h1>Mon Compte</h1>
        <div class="card-box user-info">
            <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Adresse :</strong> <?= htmlspecialchars($user['adresse']) ?></p>
            <p><strong>Numéro de téléphone :</strong> <?= htmlspecialchars($user['num_telephone']) ?></p>
            <p><strong>Code Maison :</strong> <?= htmlspecialchars($user['code_maison']) ?></p>
        </div>

        <!-- Formulaire pour modifier les informations -->
        <form class="card-box" action="update_profile.php" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>

            <label for="email">Email :</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" value="<?= htmlspecialchars($user['adresse']) ?>" required>

            <label for="num_telephone">Numéro de téléphone :</label>
            <input type="text" name="num_telephone" value="<?= htmlspecialchars($user['num_telephone']) ?>" required>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>

    <!-- Fichier JS si nécessaire -->
    <script src="js/main.js"></script>
</body>
</html>
