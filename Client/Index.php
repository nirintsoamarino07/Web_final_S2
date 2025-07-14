<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
</head>
<body>
    <div style="text-align:center">
        <h3>LISTE DES CLIENTS</h3>
    <form action="succes.php" method="get">
        <h4>Societe <input type="text" name="societe" /><input type="submit" value="Recherche"/></h4>
    </form>
    <form action="result.php" method="get">
        <h4>Code client <input type="text" name="code_client" /><input type="submit" value="Recherche"/></h4>
        <br>
        </form>

<?php
if($bdd=mysqli_connect('localhost', 'root', '', 'Client')){
    echo '<br/>';

}
else{
    echo 'Erreur';
}
?>

<div style="margin-left:300px">
<table width="1000" border="1">
<tr style="background-color:aquamarine">
    <th>Code client</th>
    <th>Societe</th>
    <th>Adresse</th>
    <th>Ville</th>
    <th>Pays</th>

</tr>

<?php $result=mysqli_query($bdd, 'SELECT * FROM CLIENTS'); ?>

<?php while($donnees=mysqli_fetch_assoc($result)){ ?>
<tr>
     <td><a href="result.php?CODE_CLIENT=<?= $donnees['CODE_CLIENT'] ?>"><?=$donnees['CODE_CLIENT'] ?></a></td>
     <td><?php echo $donnees['SOCIETE'] ?></td>
     <td><?php echo $donnees['ADRESSE'] ?></td>
     <td><?php echo $donnees['VILLE'] ?></td>
     <td><?php echo $donnees['PAYS'] ?></td>

<?php } ?>

</tr>
</table>
    </div>
<?php mysqli_free_result($result); ?>
    </div>
</body>
</html>
