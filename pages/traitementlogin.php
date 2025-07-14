<?php
session_start();
include("../inc/connection.php");

$email = $_POST["mail"];
$mdp = $_POST['mdp'];

$conn = dbconnect();
$result = mysqli_query($conn, "SELECT * FROM pret_objetsS2_membre WHERE email = '$email'");

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($mdp, $row['mdp'])) {
        $_SESSION['id'] = $row['id_membre'];
        $_SESSION['nom'] = $row['nom'];
        header("Location: list_objets.php");
        exit();
    }
}

header("Location: index.php?erreur=1");
?>
