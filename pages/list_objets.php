<?php
session_start();
include('../inc/fonction.php');

$conn = dbconnect();
$result = list_objets($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<h2>Liste des objets</h2>

<table>
    <tr>
        <th>Nom de l'objet</th>
        <th>Catégorie</th>
        <th>Propriétaire</th>
        <th>Statut</th>
    </tr>
    <?php if (mysqli_num_rows($result) > 0) { ?>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['nom_objet']; ?></td>
            <td><?= $row['nom_categorie']; ?></td>
            <td><?= $row['proprietaire']; ?></td>
            <td>
                <?php if ($row['date_emprunt']) { ?>
                    Emprunté (Retour : <?= $row['date_retour']; ?>)
                <?php } 
                else { ?>
                    Disponible
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr><td colspan="4">Aucun objet trouvé.</td></tr>
<?php } ?>

</table>
</body>
</html>
