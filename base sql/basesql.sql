

CREATE TABLE pret_objetsS2_membre(
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre ENUM('Homme', 'Femme'),
    email VARCHAR(100) UNIQUE,
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);

CREATE TABLE pret_objetsS2_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);


CREATE TABLE pret_objetsS2_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES pret_objetsS2_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES pret_objetsS2_membre(id_membre)
);


CREATE TABLE pret_objetsS2_images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES pret_objetsS2_objet(id_objet)
);


CREATE TABLE pret_objetsS2_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES pret_objetsS2_objet(id_objet)
);

INSERT INTO pret_objetsS2_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1990-05-12', 'Femme', 'alice@mail.com', 'Antananarivo', 'alice123', NULL),
('Bob', '1985-08-23', 'Homme', 'bob@mail.com', 'Toamasina', 'bob123', NULL),
('Claire', '1992-01-14', 'Femme', 'claire@mail.com', 'Fianarantsoa', 'claire123', NULL),
('David', '1988-11-02', 'Homme', 'david@mail.com', 'Mahajanga', 'david123', NULL);


INSERT INTO pret_objetsS2_categorie_objet(nom_categorie) VALUES
('bricolage'),
('mecanique'),
('cuisine'),
('esthetique');

INSERT INTO pret_objetsS2_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Trousse maquillage', 1, 1),
('Lime à ongles électrique', 1, 1),
('Tournevis', 2, 1),
('Marteau', 2, 1),
('Scie manuelle', 2, 1),
('Pompe à vélo', 3, 1),
('Clé plate', 3, 1),
('Mixeur', 4, 1),
('Grille-pain', 4, 1);

INSERT INTO pret_objetsS2_objet (nom_objet, id_categorie, id_membre) VALUES
('Crème visage', 1, 2),
('Rasoir électrique', 1, 2),
('Pinceau maquillage', 1, 2),
('Perceuse', 2, 2),
('Échelle pliante', 2, 2),
('Pistolet à colle', 2, 2),
('Pneu de secours', 3, 2),
('Pompe électrique', 3, 2),
('Casserole inox', 4, 2),
('Mixeur plongeant', 4, 2);

INSERT INTO pret_objetsS2_objet (nom_objet, id_categorie, id_membre) VALUES
('Fer à lisser', 1, 3),
('Trousse beauté', 1, 3),
('Appareil manucure', 1, 3),
('Clé à molette', 2, 3),
('Tournevis multifonction', 2, 3),
('Pince universelle', 2, 3),
('Compresseur', 3, 3),
('Cric hydraulique', 3, 3),
('Mixeur blender', 4, 3),
('Poêle antiadhésive', 4, 3);

INSERT INTO pret_objetsS2_objet (nom_objet, id_categorie, id_membre) VALUES
('Gel coiffant', 1, 4),
('Peigne chauffant', 1, 4),
('Brosse lissante', 1, 4),
('Pince coupante', 2, 4),
('Cutter', 2, 4),
('Perceuse-visseuse', 2, 4),
('Roue de secours', 3, 4),
('Démonte-pneu', 3, 4),
('Four micro-ondes', 4, 4),
('Cocotte-minute', 4, 4);


INSERT INTO pret_objetsS2_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-05'),   
(2, 2, '2025-07-10', NULL);

INSERT INTO pret_objetsS2_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(11, 3, '2025-06-25', '2025-07-01'), 
(13, 3, '2025-07-08', NULL),          
(14, 3, '2025-07-05', '2025-07-12');

INSERT INTO pret_objetsS2_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(21, 4, '2025-07-01', '2025-07-06'),
(22, 4, '2025-07-10', NULL),      
(24, 4, '2025-07-09', NULL);

INSERT INTO pret_objetsS2_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(31, 1, '2025-07-02', NULL),           
(34, 1, '2025-07-03', '2025-07-10');

