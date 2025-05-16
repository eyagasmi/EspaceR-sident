<?php
session_start();

//* Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: ../index.php');  
    exit;
}

//* Inclure le fichier de connexion à la base de données
require_once '../includes/db.php';  

//* Vérifier si les données du formulaire sont envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //* Récupérer les données envoyées par le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $num_telephone = $_POST['num_telephone'];

    //* Préparer la requête SQL pour mettre à jour les informations de l'utilisateur
    $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, adresse = ?, num_telephone = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom, $email, $adresse, $num_telephone, $_SESSION['utilisateur_id']]);

    //* Rediriger l'utilisateur vers la page de son compte avec un message de succès
    header('Location: mon_compte.php?update=success');
    exit;
}
?>
