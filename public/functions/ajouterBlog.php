<?php

if ( isset($_POST["submit"]) )
{
    $titre  = isset($_POST['titre']) ? $_POST['titre'] : NULL;
    $auteur  = isset($_POST['auteur']) ? $_POST['auteur'] : NULL;
    $chapo  = isset($_POST['chapo']) ? $_POST['chapo'] : NULL;
    $contenu  = isset($_POST['contenu']) ? $_POST['contenu'] : NULL;
	$image  = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : NULL;
	
	if(isset($_FILES["image"]) &&  $_FILES['image']['name'] != "")
	{ 
    
	$move = "/../images/blogs/";
	$nom_fichier = $_FILES['image']['name'];
	$source = $_FILES['image']['tmp_name'];
	$type_fichier = $_FILES['image']['type'];
	$taille_fichier = $_FILES['image']['size'];
   	move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.$move. $_FILES["image"]['name']);
				
		if($nom_fichier != ".htaccess")
		{ 
			if($type_fichier == "image/jpeg" 
				|| $type_fichier == "image/jpg" 
				|| $type_fichier == "image/png")
			{ 
				
				if ($taille_fichier <= 2097152)
				{ 
					$tabRemplacement = array("é"=>"e", "è"=>"e", "à"=>"a"); //Changing special characters
					
					$handle = fopen("public/images/blogs/".$nom_fichier, 'r'); //ouverture du fichier
					$content = fread($handle, $taille_fichier); //lecture du fichier
					$encoded_content = chunk_split(base64_encode($content)); //Encoding
					$f = fclose($handle); //File closing

					$ajouterBlog = $ajouterBlogManager -> ajouterBlog($titre, $auteur, $chapo, $contenu, $image);

						if( $ajouterBlog )
						{
							$messageServeur ="Le blog a bien été enregistré avec succès !";
						}
						else
						{
							$messageServeur = "Erreur lors de l'ajout du blog !";
						}
				}
				else
				{
					$messageServeur = "Taille de l'image ne doit pas dépassé 2MB.";
				}
			}
			else
			{
				$messageServeur = "L'image doit être au format jpeg, jpg ou png. ";
			}
		}
		else{
			$messageServeur = "L'image ne peut pas être un fichier htaccess !";
		}
	}
	else
	{
		$messageServeur = "Erreur lors de l'ajout de l'image'!";

	}
		

}
else{
	$messageServeur ="";
}

