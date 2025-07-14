<?php
session_start();
include('../inc/fonction.php');

if (!isset($_GET['id_membre']) || !is_numeric($_GET['id_membre'])) {
    header('Location: list_objets.php');
    exit();
}

$id_membre = intval($_GET['id_membre']);
$membre = get_membre_par_id($id_membre); 

if (!$membre) {
    echo "Membre introuvable.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche du membre</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-5.3.5-dist/css/bootstrap.css">
</head>
<body class="p-4">
    <a href="list_objets.php" class="btn btn-secondary mb-4">&larr; Retour</a>
    
    <div class="card p-3 shadow">
        <h3 class="card-title"><?= htmlspecialchars($membre['nom']) ?></h3>
        <p><strong>Email :</strong> <?= htmlspecialchars($membre['email']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($membre['telephone'] ?? 'N/A') ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($membre['adresse'] ?? 'N/A') ?></p>
    </div>
</body>
</html>
