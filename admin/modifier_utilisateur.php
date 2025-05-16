<?php
require_once '../includes/db.php';
session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $_SESSION['role'] === 'admin') {
    $id         = $_POST['id'];
    $nom        = $_POST['nom'];
    $prenom     = $_POST['prenom'];
    $email      = $_POST['email'];
    $adresse    = $_POST['adresse'];
    $telephone  = $_POST['num_telephone'];
    

    if (!empty($_POST['mot_de_passe'])) {
        $mdp = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE utilisateurs SET nom=?, prenom=?, email=?, adresse=?, num_telephone=?, mot_de_passe=? WHERE id=?");
        $stmt->execute([$nom, $prenom, $email, $adresse, $telephone, $mdp, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE utilisateurs SET nom=?, prenom=?, email=?, adresse=?, num_telephone=? WHERE id=?");
        $stmt->execute([$nom, $prenom, $email, $adresse, $telephone, $id]);
    }
}

header('Location: utilisateurs.php');
exit;
