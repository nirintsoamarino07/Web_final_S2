<?php
session_start();
include('../inc/fonction.php');

$conn = dbconnect();
$id_membre = $_SESSION['id'];

$nom_objet = $_POST['nom_objet'];
$id_categorie = $_POST['id_categorie'];


$insert_objet = "INSERT INTO pret_objetsS2_objet (nom_objet, id_categorie, id_membre)
                 VALUES ('$nom_objet', $id_categorie, $id_membre)";
mysqli_query($conn, $insert_objet);
$id_objet = mysqli_insert_id($conn); 


$upload_dir = "../assets/image_upload";
$default_image = "../assets/images/defaut.jpeg";
$images_uploaded = false;

if (!empty($_FILES['images']['name'][0])) {
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $file_name = uniqid() . "_" . basename($_FILES['images']['name'][$key]);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($tmp_name, $target_file)) {
            $images_uploaded = true;
            mysqli_query($conn, "INSERT INTO pret_objetsS2_images_objet (id_objet, nom_image)
                                 VALUES ($id_objet, '$file_name')");
        }
    }
}

if (!$images_uploaded) {
    mysqli_query($conn, "INSERT INTO pret_objetsS2_images_objet (id_objet, nom_image)
                         VALUES ($id_objet, '$default_image')");
}

header("Location: list_objets.php");
