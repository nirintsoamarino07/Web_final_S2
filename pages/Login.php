<?php
include '../inc/fonction.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form action="list_objet.php" method="POST">
    <input name="email" type="email" required><br>
    <input name="mdp" type="password" required><br>
    <button type="submit">Login</button>
</form>
<a href="inscription.php">Sign up</a>
</body>
</html>
