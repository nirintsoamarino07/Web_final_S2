<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>

<div class="login-container">
    <h3 class="text-center mb-4 text-primary">Connexion</h3>
    <form action="traitementlogin.php" method="POST">
        <div class="mb-3">
            <input type="email" name="mail" class="form-control" placeholder="<?= isset($_GET['erreur']) ? 'Email incorrect' : 'Email' ?>" required>
        </div>
        <div class="mb-3">
            <input type="password" name="mdp" class="form-control" placeholder="<?= isset($_GET['erreur']) ? 'Mot de passe incorrect' : 'Mot de passe' ?>" required>
        </div>
        <?php if (isset($_GET['erreur'])): ?>
            <div class="text-error">Identifiants incorrects</div>
        <?php endif; ?>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>
    <div class="register-link">
        <a href="inscription.php">Créer un compte</a>
    </div>
</div>
</body>
</html>
