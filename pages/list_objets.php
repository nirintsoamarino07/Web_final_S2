<?php
session_start();
include('../inc/fonction.php');

$nom_objet = $_GET['nom_objet'] ?? '';
$id_categorie = $_GET['id_categorie'] ?? '';
$disponible = isset($_GET['disponible']);

$categories = list_categorie();
$result = search_objets($nom_objet, $id_categorie, $disponible);
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
        .emprunt-form {
            display: inline-block;
            margin-left: 10px;
        }
    </style>
    <script>
        function showEmpruntForm(id) {

            document.querySelectorAll('.emprunt-form').forEach(f => f.style.display = 'none');

            const form = document.getElementById('emprunt-form-' + id);
            if (form) {
                form.style.display = 'inline-block';
            }
        }

        function validerEmprunt(id) {
            const joursInput = document.getElementById('jours-' + id);
            const jours = parseInt(joursInput.value);
            if (isNaN(jours) || jours <= 0) {
                alert("Veuillez saisir un nombre de jours valide (>0).");
                return;
            }
         
            const dateDispo = new Date();
            dateDispo.setDate(dateDispo.getDate() + jours);
            const options = { day: '2-digit', month: 'long', year: 'numeric' };
            const dateFormatee = dateDispo.toLocaleDateString('fr-FR', options);

            document.getElementById('dispo-le-' + id).textContent = dateFormatee;


            document.getElementById('emprunt-form-' + id).style.display = 'none';
        }

        function imprimer() {
            window.print();
        }
    </script>
</head>
<body>

<h2>Formulaire de recherche</h2>
<div class="container mb-4">
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label text-white">Nom de l'objet</label>
            <input type="text" name="nom_objet" class="form-control" value="<?= htmlspecialchars($nom_objet) ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label text-white">Catégorie</label>
            <select name="id_categorie" class="form-select">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id_categorie'] ?>" <?= ($id_categorie == $cat['id_categorie']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom_categorie']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 form-check">
            <input class="form-check-input" type="checkbox" name="disponible" id="disponible" <?= $disponible ? 'checked' : '' ?>>
            <label class="form-check-label text-white" for="disponible">Disponible uniquement</label>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-light w-100">Rechercher</button>
        </div>
    </form>
</div>

<h2>Liste des objets</h2>
<div class="container table-container">
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-success">
            <tr>
                <th>Nom de l'objet</th>
                <th>Catégorie</th>
                <th>Propriétaire</th>
                <th>Statut</th>
                <th>Disponible le</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <a href="fiche_objet.php?id=<?= $row['id_objet']; ?>" class="text-decoration-none text-primary fw-bold">
                            <?= htmlspecialchars($row['nom_objet']); ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($row['nom_categorie']); ?></td>
                    <td><?= htmlspecialchars($row['proprietaire']); ?></td>
                    <td>
                        <?php if ($row['date_emprunt'] && is_null($row['date_retour'])): ?>
                            <span class="badge bg-danger">Emprunté</span>
                        <?php elseif ($row['date_retour']): ?>
                            <span class="badge bg-success">Disponible (retourné le <?= $row['date_retour']; ?>)</span>
                        <?php else: ?>
                            <span class="badge bg-primary">Disponible</span>
                        <?php endif; ?>
                    
                    </td>
                    <td id="dispo-le-<?= $row['id_objet']; ?>">-</td>
                    <td><img src="../assets/images/defaut.jpeg" style="width: 100px;" alt="Image"></td>
                    <td>
                        
                      <button class="btn btn-sm btn-warning" onclick="showEmpruntForm(<?= $row['id_objet']; ?>)">Emprunter</button>
                      <div id="emprunt-form-<?= $row['id_objet']; ?>" class="emprunt-form" style="display:none;">

                            <input type="number" id="jours-<?= $row['id_objet']; ?>" min="1" placeholder="Jours" style="width: 70px;">
                            <button class="btn btn-sm btn-success" onclick="validerEmprunt(<?= $row['id_objet']; ?>)">Valider</button>
                      </div>  
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">Aucun objet trouvé.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
