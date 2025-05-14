<?php
require_once '../includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $_SESSION['role'] === 'admin') {
    $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}

header('Location: utilisateurs.php');
exit;
