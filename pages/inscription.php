<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/css/inscri.css">
</head>
<body>

<div class="register-container">
    <h3 class="text-center mb-4 text-primary">Créer un compte</h3>
    <form action="traitement_inscri.php" method="POST">
        <?php if (isset($_GET['erreur'])): ?>
            <div class="text-error">
                <?= $_GET['erreur'] == 1 ? "Email déjà utilisé." : "Erreur d'insertion." ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <input type="text" name="nom" class="form-control" placeholder="Nom" required>
        </div>
        <div class="mb-3">
            <input type="date" name="date_naissance" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>
        </div>
        <div class="mb-3">
            <input type="text" name="ville" class="form-control" placeholder="Ville" required>
        </div>
        <div class="mb-3">
            <select name="genre" class="form-control" required>
                <option value=""> Genre </option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </div>
        <div class="login-link mt-3">
            <a href="index.php">Déjà inscrit ? Connexion</a>
        </div>
    </form>
</div>

</body>
</html>
