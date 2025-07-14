<?php
session_start();
include('../inc/connection.php');

$nom = $_POST['nom'];
$date_naissance = $_POST['date_naissance'];
$genre = $_POST['genre'];
$email = $_POST['email'];
$ville = $_POST['ville'];
$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

$conn = dbconnect();


$verif = mysqli_query($conn, "SELECT * FROM pret_objetsS2_membre WHERE email = '$email'");
if (mysqli_num_rows($verif) > 0) {
    header("Location: inscription.php?erreur=1");
    exit();
}


$sql = "INSERT INTO pret_objetsS2_membre (nom, date_naissance, genre, email, ville, mdp) 
        VALUES ('$nom', '$date_naissance', '$genre', '$email', '$ville', '$mdp')";
if (mysqli_query($conn, $sql)) {
    header("Location: index.php?success=1");
} else {
    header("Location: inscription.php?erreur=2");
}
?>
