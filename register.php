<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription - Palm Jumeirah</title>
  <link rel="stylesheet" href="css/register.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="background"></div>
  <div class="overlay">
    <div class="card login">
      <h1 class="title">Créer un compte</h1>
      <form action="actions/register_action.php" method="POST" autocomplete="off">
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" name="nom" placeholder="Nom complet" required>
        </div>
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Adresse email" required autocomplete="off">
        </div>
        <div class="input-group">
          <i class="fas fa-home"></i>
          <input type="text" name="code_maison" placeholder="Code maison" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="mot_de_passe" placeholder="Mot de passe" required autocomplete="new-password">
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="mot_de_passe_confirm" placeholder="Confirmer le mot de passe" required>
        </div>
        <button type="submit">Créer le compte</button>
      </form>
      <p class="register">Déjà inscrit ? <a href="index.php">Se connecter</a></p>
    </div>
  </div>
  <script src="js/register.js"></script>

</body>
</html>
