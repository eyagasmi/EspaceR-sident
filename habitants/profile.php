<?php
session_start();
include '../includes/db.php';
include '../includes/navbar.php';

if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'habitant') {
    header('Location: ../index.php');
    exit;
}

$userId = $_SESSION['utilisateur_id'];
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

$photo = $user['photo'] ?? 'image2.webp';
$photo_path = "../images/" . $photo;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <div class="main-content">
        <h1>Mon Profil</h1>

        <div class="card-box user-info-box">
            <div class="profile-container">
                <div class="profile-photo">
                    <img src="../images/<?= htmlspecialchars($user['photo']) ?>" alt="Photo de profil">
                </div>
                <div class="profile-details">
                    <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
                    <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
                </div>
            </div>
        </div>

        <div class="card-box">
            <h2>Modifier mes informations</h2>
            <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

                <label for="photo">Photo de profil</label>
                <input type="file" id="photo" name="photo" accept="image/*">

                <label for="mot_de_passe">Nouveau mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Laisser vide si inchangé">

                <button type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>
</body>
</html>
