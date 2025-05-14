<?php
session_start();
require_once '../includes/db.php';

$id = $_SESSION['utilisateur_id'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$photo_name = null;

// Gestion de l’image
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['photo']['tmp_name'];
    $original_name = basename($_FILES['photo']['name']);
    $ext = pathinfo($original_name, PATHINFO_EXTENSION);
    $photo_name = uniqid() . '.' . $ext;

    move_uploaded_file($tmp_name, "../images/$photo_name");
}

// Mise à jour dans la base
if ($photo_name) {
    $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ?, photo = ? WHERE id = ?");
    $stmt->execute([$nom, $email, $photo_name, $id]);
} else {
    $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ? WHERE id = ?");
    $stmt->execute([$nom, $email, $id]);
}

header("Location: profile.php");
exit;
?>