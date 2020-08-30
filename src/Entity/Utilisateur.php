<?php
namespace App\Entity;

use Exception;

class Utilisateur
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $motDePasse;
    private bool $droit_administrateur;

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

    public function getPrenom()
    {
      return $this->prenom;
    }

    public function getEmail()
    {
      return $this->email;
    }

    public function getMotDePasse()
    {
      return $this->motDePasse;
    }

    public function getDate()
    {
      return $this->date;
    }
    public function getDroit_administrateur()
    {
      return $this->droit_administrateur;
    }

    /* SETTER */

    /* ID */
    public function setId(int $id)
    {
      $id = (int) $id;
      if (is_int($id) && $id >= 1) {
        $this->id = $id;
      } else {
        throw new Exception("L'id devrait être un entier supérieur à 0");
      }
    }

    /* NOM */
    public function setNom(string $nom):Utilisateur
    {
      if (is_string($nom)) {
        $this->nom = $nom;
        return $this;
      }
    }

    /* PRENOM */
    public function setPrenom(string $prenom):Utilisateur
    {
        if (is_string($prenom)) {
        $this->prenom = $prenom;
        return $this;
      }
    }
    
    /* EMAIL */
    public function setEmail(string $email):Utilisateur
    {
      if (is_string($email)) {
        $this->email = $email;
        return $this;
      }
    }
      
    /* MOT DE PASSE */
    public function setMotDePasse(string $motDePasse):Utilisateur
    {
      if (is_string($motDePasse)) {
        $this->motDePasse = $motDePasse;
        return $this;
      }
    }

    /* DATE */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /* Administrateur */
    public function setDroit_administrateur(bool $droit_administrateur):Utilisateur
    {
      if (is_bool($droit_administrateur)) {
        $this->droit_administrateur = $droit_administrateur;
        return $this;
      }
    }

}