CREATE DATABASE IF NOT EXISTS jesscmnk_blog;
USE jesscmnk_blog;


DROP TABLE IF EXISTS utilisateur;
CREATE TABLE utilisateur
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,   
    nom VARCHAR(45) NOT NULL,
    prenom VARCHAR(45) NOT NULL,
    email VARCHAR(70) NOT NULL,
    motDePasse VARCHAR(150) NOT NULL,
    administrateur BOOLEAN NOT NULL
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
    utilisateur_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id)
);

DROP TABLE IF EXISTS commentaire;
CREATE TABLE commentaire
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    auteur VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    date DATETIME NOT NULL,
    valider BOOLEAN NOT NULL,
    blog_id INT,
    FOREIGN KEY (blog_id) REFERENCES blog(id)
);




INSERT INTO utilisateur
SET  nom="BROS", prenom="Jessy", email="j.bros@hotmail.fr", motDepasse="$2y$10$5MCRVEvFS2rHDSYOUCvCiuWYZBmNrmpNPj0I3d/oM1f/OtUg5RtIm", administrateur = true;

INSERT INTO utilisateur
VALUES (NULL, "CRAFT", "Lea", "lea@hotmail.fr", "$2y$10$ueqn6ysfNBWPdVhODRUaFOOVY.S69WcXj2.4C9VAHDyQihuDC0irS", false),
	   (NULL, "PORSCHE", "Amine", "amine@hotmail.fr", "$2y$10$FBztksQ1QSVlEcVCEvM7Ie8G/ph./VubmYHD8sj/2dTjV7.T5MEC.", false);
       
       
INSERT INTO blog
SET  titre="Naissance d'un développeur", auteur="Jessy BROS", chapo="Comment est-il devenu développeur avec Openclassrooms !", contenu="C'est l'histoire d'un jeune policier, reconvertis en développeur web. <br> Il découvra par hasard des cours de développement. Il étudia et essaya ! Après avoir réussir le parcours de développeur web à l'aide d'un super mentor, il décida de poursuivre sa route et devena un développeur web. Merci !",
 image="jessy_BROS.jpg", date="2020-04-12 15:37:21", dateMiseAJour="2020-04-12 21:04:42", utilisateur_id=(SELECT id FROM utilisateur WHERE id="1" );
 
 INSERT INTO blog
SET  titre="WebAgency", auteur="Jessy BROS", chapo="Mon tout premier projet !", contenu="Et oui, moi aussi j'ai commencé par là ! ;) <br> Mon premier projet était une simulation d'un projet de cours entièrement codé en HTML et Css.  <br> Un petit projet de chez Openclassrooms et qui m'a pris plus ou moins 3 petites semaines. <br> Je découvrais tout juste le monde des développeurs et ce n'est encore que le début !",
 image="webagency.jpg", date="2020-04-13 09:48:41", dateMiseAJour= NULL, utilisateur_id=(SELECT id FROM utilisateur WHERE id="1" );
 
 INSERT INTO blog
SET  titre="Chalets & Caviar", auteur="Jessy BROS", chapo="Un monde sans code ! Un pur bonheur..", contenu="Je ne vais pas vous faire attendre plus longtemps. Et oui, je vous présente un gros petit projet réalisé avec le célèbre gestion de contenu, WordPress ! Un client qui souhaité mettre ses chalets de luxe en valeur. Comment aurais-je pu fermer les yeux après les avoir vu ! Si vous désirez partir en vacance, n'hésitez plus. J'y ferai surement moi-même un petit tour, qui sait ? ;)",
 image="chalets_et_caviar.jpg", date="2020-04-13 10:12:03", dateMiseAJour="2020-04-13 17:19:40", utilisateur_id=(SELECT id FROM utilisateur WHERE id="1" );
 
 INSERT INTO blog
SET  titre="Le formulaire d'Ovaluo", auteur="Jessy BROS", chapo=" Un CMS que j'aime beaucoup ", contenu="Un projet, fort interessant et enrichissant ! Pour un client, je devais reproduire à partir d'un fichier PDF. Un formulaire fonctionnel ! <br> Pour cela j'ai du apprendre et m'adapter à un nouveau CMS. Non ce n'est pas Wordpress. Mais SHOPIFY ! Il n'a pas toute la puissance et la popularité de Wordpress. Mais ce petit bijoux a été l'un des rares CMS que j'ai apprécié utiliser.",
 image="ovaluo.png", date="2020-04-17 11:58:49", dateMiseAJour= NULL, utilisateur_id=(SELECT id FROM utilisateur WHERE id="1" );
 

 INSERT INTO blog
SET  titre="Je suis un développeur", auteur="Jessy BROS", chapo="Mon quotidien de développeur, la réalité", contenu="Je ne suis encore que neophyte, mais je suis désormais belle et bien un développeur web ! :D <br> J 'ai réalisé ce petit logo à l'occasion pour vous présentez un peu mon quotidien. Qui contrairement aux apparences... Quels apparences ? XD <br> Et oui les amis, les développeurs ont le même quotidien que tous. On travaille sur nos petits écrans fort symapthique. Mais nous avons tous une passion. Enfin moi non mais.. Je rigole ! :D <br> ça peut parraître iréel, mais je mange ! Oui, je vous jure ! <br> Sérieusement, j'en parlerai peut-être de mon quotidien dans un prochaine publication ;)",
 image="logo.png", date="2020-04-19 07:35:32", dateMiseAJour="2020-04-19 08:48:17", utilisateur_id=(SELECT id FROM utilisateur WHERE id="1" );
 
 INSERT INTO blog
SET  titre="L'association Astree", auteur="Jessy BROS", chapo="On ne peut qu'apprecier !", contenu="Comme vous l'aurez compris, cette fois là, j'ai développé pour une petite grande association. Un emailing. <br> Ce sont l'un de mes tout premier client, et de temps en temps je suis là pour répondre à leurs besoins. <br> Travailler pour des projets qui vous tiennent à coeur, qui vous plaisent et amusez-vous ! Enfin restons tout de même profesionnel ! :)",
 image="astree.jpg", date="2020-04-12 15:37:21", dateMiseAJour="2020-04-12 21:04:42", utilisateur_id=(SELECT id FROM utilisateur WHERE id="1" );
 
 INSERT INTO blog
SET  titre="Numero 10 media", auteur="Jessy BROS", chapo=" Qui sont-ils ?", contenu="Non ce n'est pas le dixième média les plus connus. Mais une simple agence marketing qui a fait appel à mes services pour un petite OnePage sur WordPress.  <br> C'est un projet que j'ai particulièrement adoré réaliser. Ils étaient investis et la maquette qu'ils détenaient était un petit challenge et surtout très appréciable visuellement ! Fier du résultat et d'avoir pu contribué à ce magnifique projet ! :)",
 image="numero_10_media.jpg", date="2020-04-27 20:50:00", dateMiseAJour= NULL, utilisateur_id=(SELECT id FROM utilisateur WHERE id="1" );
 
 INSERT INTO blog
SET  titre="Les Films de Plein Air", auteur="Jessy BROS", chapo="Un fête ! Où çà ?", contenu="Oui les amis, je viens de réaliser un projet mouvementé ! Attention, vous êtes tous invités ! Petite soirée du 5 au 8 août, on se pose devant des fims dans une ambiance de folie ! <br> Je vous promet deux choses ! Que les préinscriptions sont fonctionneles  ahah! La deuxieme ? On va s'amusez comme des fous ! <br> Alors venez nombreux ! :O",
 image="les_films_de_plein_air.jpg", date="2020-05-01 9:01:59", dateMiseAJour= NULL, utilisateur_id=(SELECT id FROM utilisateur WHERE id="1" );
 

INSERT INTO commentaire
VALUES (NULL, "Rayan Shiper", "Salut ! Super blog, continue comme ça ;)", "2020-04-13 12:25:59", true, (SELECT id FROM blog WHERE id="1") ),
	   (NULL, "Alexandre", "Bravo à toi ! Je devrais me lancer...", "2020-04-13 17:05:01", false, (SELECT id FROM blog WHERE id="1") ),
	   (NULL, "Pierre DUBASK", "Le designer à fait du bon travail ! Le développeur se débrouille", "2020-04-29 18:34:22", true, (SELECT id FROM blog WHERE id="7") ),
	   (NULL, "Alexis", "Cet été sera de la folie ! ", "2020-05-02 17:02:42", false, (SELECT id FROM blog WHERE id="8") );
