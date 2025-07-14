<?php
function dbconnect() {
    $conn = mysqli_connect("localhost", "root", "", "pret_objets");
    if (!$conn) {
        die("Connexion échouée: " . mysqli_connect_error());
    }
    return $conn;
}
?>