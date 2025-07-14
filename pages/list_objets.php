<?php
session_start();
include('../inc/fonction.php');

$result = list_objets();
$categories =list_categorie();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-5.3.5-dist/css/bootstrap.css">
    <style>
        body {
            background: linear-gradient(135deg, #38b2ac, #3182ce);
            min-height: 100vh;
            padding: 30px;
            font-family: 'Segoe UI', sans-serif;
        }

        h2 {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
        }

        .badge {
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<div class="container">
    
<form action="traitement_ajout_objet.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="nom_objet" placeholder="Nom de l'objet" required>
    <select name="id_categorie" required>
    <option value=""> Choisir une catégorie</option>
    <?php foreach($categories as $list) { ?>
        <option value="<?= $list['id_categorie'] ?>">
            <?= $list['nom_categorie']; ?>
        </option>
    <?php } ?>
</select>

    <input type="file" name="images" multiple accept="image/*">
    <input type="submit" value="Ajouter_objet">
</form>

    <h2>Liste des objets</h2>
    <div class="table-container">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-success">
                <tr>
                    <th>Nom de l'objet</th>
                    <th>Catégorie</th>
                    <th>Propriétaire</th>
                    <th>Statut</th>
                    <th>Images</th>

                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['nom_objet']; ?></td>
                            <td><?= $row['nom_categorie']; ?></td>
                            <td><?= $row['proprietaire']; ?></td>
                            <td>
                                <?php if ($row['date_emprunt'] && is_null($row['date_retour'])): ?>
                                    <span class="badge bg-danger">Emprunté (Retour prévu inconnu)</span>
                                <?php elseif ($row['date_retour']): ?>
                                    <span class="badge bg-success">Disponible (retourné le <?= $row['date_retour']; ?>)</span>
                                <?php else: ?>
                                    <span class="badge bg-primary">Disponible</span>
                                <?php endif; ?>
                            </td>
                            <td><img src="../assets/images/defaut.jpeg" style="width: 100px;"></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Aucun objet trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
