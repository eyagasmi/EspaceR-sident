<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Palm Jumeirah - Connexion</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background"></div>
    <div class="overlay">
        <div class="card login">
            <h1 class="title">🌴 Palm Jumeirah</h1>
            <h2 class="subtitle">Espace résident</h2>
            <form action="actions/login_action.php" method="POST" autocomplete="off">
                <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 1): ?>
                <div class="error-message">Email ou mot de passe incorrect.</div>
                <?php endif; ?>

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Adresse email" required autocomplete="off">
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required autocomplete="new-password">
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <p class="register">Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
        </div>
    </div>
    <script src="js/index.js"></script>
</body>
</html>

