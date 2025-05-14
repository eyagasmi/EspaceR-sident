<?php
require_once '../includes/db.php';
session_start();

// Vérifie si admin
if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// Récupérer les habitants
$stmt = $pdo->query("SELECT * FROM utilisateurs WHERE role = 'habitant'");
$habitants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des habitants</title>
  <link rel="stylesheet" href="../css/utilisateurs.css">
  <link rel="stylesheet" href="../css/style.css"> <!-- Lien vers ton fichier CSS -->

</head>
<body>
  <?php include '../includes/header.php'; ?>
  
  <div class="main-content">
    <h1>Utilisateurs - Habitants</h1>

    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($habitants as $habitant): ?>
        <tr>
          <td><?= htmlspecialchars($habitant['nom']) ?></td>
          <td><?= htmlspecialchars($habitant['prenom']) ?></td>
          <td><?= htmlspecialchars($habitant['email']) ?></td>
          <td>
            <button class="btn-edit" 
              data-id="<?= $habitant['id'] ?>"
              data-nom="<?= $habitant['nom'] ?>"
              data-prenom="<?= $habitant['prenom'] ?>"
              data-email="<?= $habitant['email'] ?>"
              data-adresse="<?= $habitant['adresse'] ?>"
              data-telephone="<?= $habitant['num_telephone'] ?>">
              ✏️ Modifier
            </button>
            <button class="btn-delete" data-id="<?= $habitant['id'] ?>" data-nom="<?= $habitant['nom'] ?>">
              🗑️ Supprimer
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Modal de suppression -->
  <div id="deleteModal" class="modal hidden">
    <div class="modal-content">
      <p id="deleteText"></p>
      <form method="POST" action="supprimer_utilisateur.php">
        <input type="hidden" name="id" id="deleteUserId">
        <button type="submit" class="btn-confirm">Confirmer</button>
        <button type="button" class="btn-cancel" onclick="closeModal()">Annuler</button>
      </form>
    </div>
  </div>

  <!-- Modal de modification -->
  <div id="editModal" class="modal hidden">
    <div class="modal-content">
      <form method="POST" action="modifier_utilisateur.php">
        <input type="hidden" name="id" id="editUserId">
        <label>Nom : <input type="text" name="nom" id="editNom"></label>
        <label>Prénom : <input type="text" name="prenom" id="editPrenom"></label>
        <label>Email : <input type="email" name="email" id="editEmail"></label>
        <label>Adresse : <input type="text" name="adresse" id="editAdresse"></label>
        <label>Téléphone : <input type="text" name="num_telephone" id="editTelephone"></label>
        <label>Nouveau mot de passe (laisser vide si inchangé) : <input type="password" name="mot_de_passe"></label>
        <button type="submit" class="btn-confirm">Mettre à jour</button>
        <button type="button" class="btn-cancel" onclick="closeEditModal()">Annuler</button>
      </form>
    </div>
  </div>

  <script src="../js/utilisateurs.js"></script>
</body>
</html>
