<?php
session_start();
include('../inc/fonction.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: list_objets.php');
    exit();
}

$id_objet = intval($_GET['id']);
$objet = get_fiche_objet($id_objet);
$historique = get_historique_emprunts($id_objet);

$query = "SELECT nom_image FROM pret_objetsS2_images_objet WHERE id_objet = $id_objet";
$images = mysqli_fetch_all(mysqli_query(dbconnect(), $query), MYSQLI_ASSOC);
$default_image = '../assets/images/defaut.jpeg';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de l'objet</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-5.3.5-dist/css/bootstrap.css">
    <style>
        body {
            background: linear-gradient(to right, #38b2ac, #3182ce);
            padding: 40px;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-img-top {
            height: 300px;
            object-fit: cover;
        }
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin: 5px;
            border: 2px solid #ccc;
        }
        .thumbnail:hover {
            border-color: #38b2ac;
        }
    </style>
</head>
<body>
<div class="container bg-white p-4 rounded shadow">
    <a href="list_objets.php" class="btn btn-secondary mb-4">&larr; Retour</a>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <img src="<?= isset($images[0]['nom_image']) ? '../assets/image_upload/' . $images[0]['nom_image'] : $default_image ?>" class="card-img-top" alt="Image principale">
                <div class="card-body">
                    <h5 class="card-title"><?= $objet['nom_objet']; ?></h5>
                    <p class="card-text"><strong>Catégorie :</strong> <?= $objet['nom_categorie']; ?></p>
                    <p class="card-text"><strong>Propriétaire :</strong> <?= $objet['proprietaire']; ?></p>
                </div>
            </div>

            <div class="d-flex flex-wrap">
                <?php foreach ($images as $img): ?>
                    <img src="../assets/image_upload/<?= $img['nom_image'] ?>" class="thumbnail" alt="Image">
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-6">
            <h4>Historique des emprunts</h4>
            <table class="table table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Emprunteur</th>
                        <th>Date d'emprunt</th>
                        <th>Date de retour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($historique) > 0): ?>
                        <?php foreach ($historique as $entry): ?>
                            <tr>
                                <td><?= $entry['nom_emprunteur']; ?></td>
                                <td><?= $entry['date_emprunt']; ?></td>
                                <td><?= $entry['date_retour'] ? $entry['date_retour'] : 'Non retourné'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Aucun emprunt trouvé pour cet objet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
