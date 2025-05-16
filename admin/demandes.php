<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Vérifie que l'utilisateur est bien admin (à adapter selon ton système)
if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Récupérer les demandes avec le nom et prénom de l'utilisateur
$sql = "
    SELECT td.*, u.nom, u.prenom, t.type AS type_demande
    FROM traiter_demandes td
    JOIN utilisateurs u ON td.utilisateur_id = u.id
    JOIN type_demandes t ON td.type_demande_id = t.id
    ORDER BY td.date_demande DESC
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$demandes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demandes des utilisateurs</title>
    <link rel="stylesheet" href="../css/demandes_admin.css">
</head>
<body>
    <div class="main-content">
        <div class="page-title">
        <h1>Demandes reçues</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Type de Demande</th>
                    <th>Adresse</th>
                    <th>Code Maison</th>
                    <th>Commentaire</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($demandes) === 0): ?>
                    <tr><td colspan="7">Aucune demande trouvée.</td></tr>
                <?php else: ?>
                    <?php foreach ($demandes as $demande): ?>
                        <tr>
                            <td><?= htmlspecialchars($demande['nom']) ?></td>
                            <td><?= htmlspecialchars($demande['prenom']) ?></td>
                            <td><?= htmlspecialchars($demande['type_demande']) ?></td> <!-- ou afficher libellé si jointure avec `type_demandes` -->
                            <td><?= htmlspecialchars($demande['adresse']) ?></td>
                            <td><?= htmlspecialchars($demande['code_maison']) ?></td>
                            <td><?= htmlspecialchars($demande['commentaire']) ?></td>
                            <td><?= htmlspecialchars($demande['date_demande']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
