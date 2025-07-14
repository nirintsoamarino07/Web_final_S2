<?php
function dbconnect() {
    $conn = mysqli_connect("172.60.0.15", "ETU004322", "5Puq40jP", "db_s2_ETU004322");
    if (!$conn) {
        die("Connexion échouée: " . mysqli_connect_error());
    }
    return $conn;
}
// function dbconnect() {
//     $conn = mysqli_connect("localhost", "root", "", "pret_objets");
//     if (!$conn) {
//         die("Connexion échouée: " . mysqli_connect_error());
//     }
//     return $conn;
// }
?>
