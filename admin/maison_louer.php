<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adresse = $_POST['adresse'];
    $description = $_POST['description'];
    $nb_chambres = $_POST['nb_chambres'];
    $prix = $_POST['prix'];
    $date_ajout = date('Y-m-d H:i:s');
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image_name = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (getimagesize($_FILES["image"]["tmp_name"])) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $image_name;
            }
        }
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO maison_louer (adresse, description, nb_chambres, image, date_ajout, prix)
            VALUES (:adresse, :description, :nb_chambres, :image, :date_ajout, :prix)
        ");

        $stmt->execute([
            ':adresse' => $adresse,
            ':description' => $description,
            ':nb_chambres' => $nb_chambres,
            ':image' => $image,
            ':date_ajout' => $date_ajout,
            ':prix' => $prix
        ]);

        $_SESSION['success'] = "Maison ajoutée avec succès!";
        header('Location: maison_louer.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
        exit;
    }
}

// Récupération des maisons
$stmt = $pdo->prepare("SELECT * FROM maison_louer ORDER BY date_ajout DESC");
$stmt->execute();
$maisons = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Maisons à Louer</title>
    <link rel="stylesheet" href="../css/maison_louer.css">
</head>
<body class="maison-louer-page">


<div class="main-content">
    <div class="page-header">
    <button class="add-button" id="openModal">+ Ajouter une maison</button>
    </div>
    <h2 class="title-section">Maisons à Louer</h2>


    <!-- Modal -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Ajouter une Maison à Louer</h2>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert success"><?= $_SESSION['success']; ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form action="maison_louer.php" method="POST" enctype="multipart/form-data">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" required>

                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>

                <label for="nb_chambres">Nombre de chambres</label>
                <input type="number" name="nb_chambres" id="nb_chambres" required>

                <label for="prix">Prix (€)</label>
                <input type="number" name="prix" id="prix" step="0.01" required>

                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*">

                <button type="submit">Ajouter la Maison</button>
            </form>
        </div>
    </div>

    <!-- Maisons listées -->
    <div class="maisons-container">
        <?php foreach ($maisons as $maison): ?>
            <div class="maison-card">
                <?php if ($maison['image']): ?>
                    <img src="../uploads/<?= htmlspecialchars($maison['image']) ?>" alt="Maison">
                <?php endif; ?>
                <div class="maison-details">
                    <p><strong>Adresse:</strong> <?= htmlspecialchars($maison['adresse']) ?></p>
                    <p><strong>Description:</strong> <?= htmlspecialchars($maison['description']) ?></p>
                    <p><strong>Chambres:</strong> <?= $maison['nb_chambres'] ?></p>
                    <p><strong>Prix:</strong> <?= number_format($maison['prix'], 2) ?> €</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="../js/louer_maison.js"></script>
</body>
</html>
