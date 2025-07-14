<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../Assets/css/inscri.css">
</head>
<body class="corps">
    <center>
        <div class="boite1">
            <form action="traitement_inscri.php" method="POST">
                <h2>Inscription</h2>
                <div class="boite2">
                    <?php if (isset($_GET['erreur'])): ?>
                        <p style="color:red;">
                            <?= $_GET['erreur'] == 1 ? "Email déjà utilisé." : "Erreur d'insertion." ?>
                        </p>
                    <?php endif; ?>

                    <p>Nom</p>
                    <p><input type="text" name="nom" required></p>
                    <p>Date de naissance</p>
                    <p><input type="date" name="date_naissance" required></p>
                    <p>Email</p>
                    <p><input type="email" name="email" required></p>
                    <p>Mot de passe</p>
                    <p><input type="password" name="mdp" required></p>
                    <p>Ville</p>
                    <p><input type="text" name="ville" required></p>
                    <p>Genre</p>
                    <p>
                        <select name="genre" required>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                    </p>
                    <input class="inscription" type="submit" value="Valider">
                </div>
            </form>
        </div>
    </center>
</body>
</html>
