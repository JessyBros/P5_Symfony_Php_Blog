<?php
namespace App\Entity;

use Exception;

class Blog
{
    private int $id;
    private string $titre;
    private string $auteur;
    private string $chapo;
    private string $contenu;
    private string $image;
    private $date;
    private $dateMiseAJour;
    private  $utilisateur_id;

    /* CONSTRUCTEUR */
    public function __construct(array $data){
      $this -> hydrate($data);
    }

    /* HYDRATATION */
    public function hydrate(array $data)
    {
      foreach ($data as $key => $value)
      {
          // On récupère le nom du setter correspondant à l'attribut.
          $method = 'set'.ucfirst($key);
              
          // Si le setter correspondant existe.
          if (method_exists($this, $method))
          {
          // On appelle le setter.
          $this->$method($value);
          }
      }
    }
    

    /* GETTER */
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function getChapo()
    {
        return $this->chapo;
    }
    //:?string peut être null
    public function getContenu():string
    {
        return $this->contenu;
    }

    public function getImage()
    {
       return $this->image;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDateMiseAJour()
    {
       return $this->dateMiseAJour;
    }

    public function getUtilisateur_id()
    {
        return $this->utilisateur_id;
    }
    
    /* SETTER */

    /* ID */
      public function setId($id)
    {
      $id = (int) $id;
      if (is_int($id) && $id >= 1)
      {
        $this->id = $id;
      } else {
        throw new Exception("L'id devrait être un entier supérieur à 0");
      }
    }
 
    /* NOM */
    public function setNom(string $nom):Blog
    {
      if (is_string($nom))
      {
        $this->nom = $nom;
        return $this;
      }
    }

    /* TITRE */
    public function setTitre(string $titre):Blog
    {
        if (is_string($titre))
        {
          $this->titre = $titre;
          return $this;
        }
    }

    /* AUTEUR */ 
    public function setAuteur(string $auteur):Blog
    {
        if (is_string($auteur))
      {
        $this->auteur = $auteur;
        return $this;
      }
    }
    
    /* CHAPO */
    public function setChapo(string $chapo):Blog
    {
        if (is_string($chapo))
        {
          $this->chapo = $chapo;
          return $this;
        }
    }

    /* CONTENU */
    public function setContenu(string $contenu):Blog
    { 
      if (is_string($contenu))
        {
          $this->contenu = $contenu;
          return $this;
        }
    }

    /* IMAGE */
    public function setImage(string $image):Blog
    {
      if (is_string($image))
        {
          $this->image = $image;
          return $this;
        }
    } 

    /* DATE */
    public function setDate($date)// dire date time
    {
      $this->date = $date;
      return $this;
    }

    /* DATE MISE A JOUR */
    public function setDateMiseAJour($dateMiseAJour)
    {
      $this->dateMiseAJour = $dateMiseAJour;
      return $this;
    }

    /* UTILISATEUR_ID */
    public function setUtilisateur_id( $utilisateur_id)
    {
        $this->utilisateur_id = $utilisateur_id;
        return $this;
    }
}