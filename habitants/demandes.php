<?php
session_start();
include '../includes/db.php';
include '../includes/navbar.php';

// Récupérer les types de demandes depuis la base
$stmt = $pdo->prepare("SELECT id, type FROM type_demandes ORDER BY type ASC");
$stmt->execute();
$types = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Demande de visite</title>
    <link rel="stylesheet" href="../css/demandes.css">
</head>
<body>

    <!-- Titre de la page -->
    <div class="page-title">
        <h1>Faire une Demande</h1>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <form action="demandes.php" method="post" class="demande-form">
            <label for="type_demande">Type de demande :</label>
            <select name="type_demande" id="type_demande" required>
                <option value="">-- Choisir un type --</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?= htmlspecialchars($type['id']) ?>"><?= htmlspecialchars($type['type']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required>

            <label for="code_maison">Code Maison :</label>
            <input type="text" id="code_maison" name="code_maison" required>

            <label for="commentaire">Commentaire :</label>
            <textarea id="commentaire" name="commentaire" rows="4"></textarea>

            <button type="submit" name="submit">Envoyer la demande</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $type_demande = $_POST['type_demande'];
            $adresse = trim($_POST['adresse']);
            $code_maison = trim($_POST['code_maison']);
            $commentaire = trim($_POST['commentaire']);
            $utilisateur_id = $_SESSION['utilisateur_id'];

            if ($type_demande && $adresse && $code_maison) {
                $insert = $pdo->prepare("INSERT INTO traiter_demandes (type_demande_id, adresse, code_maison, commentaire, utilisateur_id, date_demande) VALUES (?, ?, ?, ?, ?, NOW())");
                $insert->execute([$type_demande, $adresse, $code_maison, $commentaire, $utilisateur_id]);

                echo "<p class='success'>Votre demande a bien été enregistrée.</p>";
            } else {
                echo "<p class='error'>Veuillez remplir tous les champs obligatoires.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
