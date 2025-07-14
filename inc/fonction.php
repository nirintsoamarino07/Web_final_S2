<?php
include 'connection.php';
function login($nom, $date_naissance, $genre, $email, $ville, $mdp){
    $requette="SELECT*from pret_objetsS2_membre";
    $data=mysqli_query(dbconnect(), $requette);

    while($donne=mysqli_fetch_assoc($data)){
        if($email==$donne['nom'] && $date_naissance==$donne['date_naissance'] && $genre==$donne['genre']  && $email==$donne['email']  && $ville==$donne['ville'] && $mdp==$donne['mdp'] ){
            $_SESSION['id']=$donne['idmembre'];
            $_SESSION['nom']=$donne['nom'];
            return true;
        }      
    }
    return false;
}

function list_objets() {
    $requete = "SELECT 
            o.nom_objet,
            c.nom_categorie,
            m.nom AS proprietaire,
            e.date_emprunt,
            e.date_retour
        FROM pret_objetsS2_objet o
        JOIN pret_objetsS2_categorie_objet c ON o.id_categorie = c.id_categorie
        JOIN pret_objetsS2_membre m ON o.id_membre = m.id_membre
        LEFT JOIN pret_objetsS2_emprunt e 
            ON o.id_objet = e.id_objet AND e.date_retour IS NULL
        ORDER BY o.nom_objet
    ";

    return mysqli_query(dbconnect(), $requete);
}

?>
