CREATE DATABASE IF NOT EXISTS blog;
USE blog;


DROP TABLE IF EXISTS visiteur;
CREATE TABLE visiteur
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,   
    nom VARCHAR(45) NOT NULL,
    prenom VARCHAR(45) NOT NULL,
    email VARCHAR(70) NOT NULL,
    motDePasse VARCHAR(150) NOT NULL
);

DROP TABLE IF EXISTS administrateur;
CREATE TABLE administrateur
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,   
    nom VARCHAR(45) NOT NULL,
    prenom VARCHAR(45) NOT NULL,
    email VARCHAR(70) NOT NULL,
    motDePasse VARCHAR(150) NOT NULL
);

DROP TABLE IF EXISTS blog;
CREATE TABLE blog
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	titre VARCHAR(150) NOT NULL,
    auteur VARCHAR(150) NOT NULL,
    chapo VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    date DATETIME NOT NULL,
    dateMiseAJour DATETIME,
    administrateur_id INT,
    FOREIGN KEY (administrateur_id) REFERENCES administrateur(id)
);

DROP TABLE IF EXISTS commentaire;
CREATE TABLE commentaire
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    auteur VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    date DATETIME NOT NULL,
    blog_id INT,
    FOREIGN KEY (blog_id) REFERENCES blog(id)
);




INSERT INTO administrateur
SET  nom="BROS", prenom="Jessy", email="j.bros@hotmail.fr", motDepasse="rafalef1";

INSERT INTO visiteur
VALUES (NULL, "CRAFT", "Lea", "lea@hotmail.fr", "leaMdp"),
	   (NULL, "PORSCHE", "Amine", "amine@hotmail.fr", "amineMdp");
       
       
INSERT INTO blog
SET  titre="Naissance d'un développeur", auteur="Jessy BROS", chapo="Comment est-il devenu développeur avec Openclassrooms !", contenu="C'est l'histoire d'un jeune policier, reconvertis en développeur web. <br> Il découvra par hasard des cours de développement. Il étudia et essaya ! Après avoir réussir le parcours de développeur web à l'aide d'un super mentor, il décida de poursuivre sa route et devena un développeur web. Merci !",
 image="image.png", date="2020-04-12 15:37:21", dateMiseAJour="2020-04-12 21:04:42", administrateur_id=(SELECT id FROM administrateur WHERE id="1" )  ;

INSERT INTO commentaire
VALUES (NULL, "Rayan Shiper", "Salut ! Super blog, continue comme ça ;)", "2020-04-13 12h05:59", (SELECT id FROM blog WHERE id="1") ),
	   (NULL, "Alexandre", "Bravo à toi ! Je devrais me lancer...", "2020-04-13 12h05:01", (SELECT id FROM blog WHERE id="1") );
