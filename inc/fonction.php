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
    $requete = "SELECT o.nom_objet, c.nom_categorie, m.nom AS proprietaire,
       e.date_emprunt, e.date_retour,
       io.nom_image,o.id_objet
FROM pret_objetsS2_objet o
JOIN pret_objetsS2_categorie_objet c ON o.id_categorie = c.id_categorie
JOIN pret_objetsS2_membre m ON o.id_membre = m.id_membre
LEFT JOIN pret_objetsS2_emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL
LEFT JOIN (
    SELECT id_objet, MIN(nom_image) AS nom_image
    FROM pret_objetsS2_images_objet
    GROUP BY id_objet
) io ON o.id_objet = io.id_objet
ORDER BY o.nom_objet";

    return mysqli_query(dbconnect(), $requete);
}

function list_categorie(){
    $requete="SELECT id_categorie, nom_categorie FROM pret_objetsS2_categorie_objet";
    $query=mysqli_query(dbconnect(), $requete);
    return $query;
}

function get_fiche_objet($id_objet) {
    $query = "SELECT o.nom_objet, c.nom_categorie, m.nom AS proprietaire
              FROM pret_objetsS2_objet o
              JOIN pret_objetsS2_categorie_objet c ON o.id_categorie = c.id_categorie
              JOIN pret_objetsS2_membre m ON o.id_membre = m.id_membre
              WHERE o.id_objet = $id_objet";
    return mysqli_fetch_assoc(mysqli_query(dbconnect(), $query));
}

function get_historique_emprunts($id_objet) {
    $query = "SELECT m.nom AS nom_emprunteur, e.date_emprunt, e.date_retour
              FROM pret_objetsS2_emprunt e
              JOIN pret_objetsS2_membre m ON e.id_membre = m.id_membre
              WHERE e.id_objet = $id_objet
              ORDER BY e.date_emprunt DESC";
    $result = mysqli_query(dbconnect(), $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function search_objets($nom_objet = "", $id_categorie = "", $disponible = false) {
    $conn = dbconnect();

    $query = "SELECT o.id_objet, o.nom_objet, c.nom_categorie, m.nom AS proprietaire,
                     e.date_emprunt, e.date_retour, i.nom_image
              FROM pret_objetsS2_objet o
              JOIN pret_objetsS2_categorie_objet c ON o.id_categorie = c.id_categorie
              JOIN pret_objetsS2_membre m ON o.id_membre = m.id_membre
              LEFT JOIN pret_objetsS2_emprunt e 
                ON o.id_objet = e.id_objet AND e.date_retour IS NULL
              LEFT JOIN pret_objetsS2_images_objet i ON o.id_objet = i.id_objet
              WHERE 1=1";

    if (!empty($nom_objet)) {
        $nom_objet = mysqli_real_escape_string($conn, $nom_objet);
        $query .= " AND o.nom_objet LIKE '%$nom_objet%'";
    }

    if (!empty($id_categorie)) {
        $query .= " AND o.id_categorie = $id_categorie";
    }

    if ($disponible) {
        $query .= " AND (e.date_emprunt IS NULL)";
    }

    $query .= " GROUP BY o.id_objet ORDER BY o.nom_objet ASC";

    return mysqli_query($conn, $query);
}

function get_membre_par_id($id) {
    $conn = dbconnect();
    $stmt = $conn->prepare("SELECT * FROM pret_objetsS2_membre WHERE id_membre = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


?>
