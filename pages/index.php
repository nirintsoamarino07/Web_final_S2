<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/css/login.css">
</head>
<body>
<div class="countainer">
    <div class="countctd">
        <div class="coted">
            <form action="traitementlogin.php" method="POST">
                <p>
                    <input type="mail" name="mail" placeholder="<?= isset($_GET['erreur']) ? 'Email incorrect' : 'Email' ?>">
                </p>
                <p>
                    <input type="password" name="mdp" placeholder="<?= isset($_GET['erreur']) ? 'Mot de passe incorrect' : 'Mot de passe' ?>">
                </p>
                <input type="submit" value="Log In">
            </form>
            <button class="boutton"><a href="inscription.php">Créer un compte</a></button>
        </div>
    </div>
</div>
</body>
</html>
